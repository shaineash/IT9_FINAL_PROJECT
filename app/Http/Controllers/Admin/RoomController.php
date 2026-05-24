<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of rooms.
     */
    public function index()
    {
        $roomTypes = Room::selectRaw(
            'type, ' .
            'count(*) as room_count, ' .
            'MIN(price_per_night) as min_price, ' .
            'MAX(price_per_night) as max_price, ' .
            'MIN(capacity) as min_capacity, ' .
            'MAX(capacity) as max_capacity'
        )
        ->groupBy('type')
        ->orderBy('type')
        ->paginate(10);

        return view('admin.rooms.index', compact('roomTypes'));
    }

    /**
     * Show the form for creating a new room.
     */
    public function create()
    {
        $categories = RoomCategory::orderBy('name')->get();

        return view('admin.rooms.create', compact('categories'));
    }

    /**
     * Store a newly created room.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|string|max:50',
            'bed_type' => 'nullable|string|max:100',
            'room_category_id' => 'nullable|exists:room_categories,id',
            'price_per_night' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'rooms_available' => 'required|integer|min:1',
            'status' => 'nullable|in:available,maintenance,booked',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $validated['status'] = $validated['status'] ?? 'available';

        $category = null;
        if (! empty($validated['room_category_id'])) {
            $category = RoomCategory::find($validated['room_category_id']);
            $validated['type'] = $category->name;
        }

        if (! array_key_exists('active', $validated)) {
            $validated['active'] = true;
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('rooms', 'public');
        }

        $count = (int) ($validated['rooms_available'] ?? 1);

        try {
            $roomNumbers = $this->generateRoomNumbers($validated['type'], $count, $category);
        } catch (\RuntimeException $exception) {
            return back()->withInput()->withErrors(['rooms_available' => $exception->getMessage()]);
        }

        DB::transaction(function () use ($roomNumbers, $validated) {
            foreach ($roomNumbers as $roomNumber) {
                $attributes = array_merge($validated, [
                    'room_number' => $roomNumber,
                    'name' => $validated['name'] . ' ' . $roomNumber,
                    'description' => $validated['description'] ?? null,
                    'status' => $validated['status'] ?? 'available',
                ]);

                Room::create($attributes);
            }
        });

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Rooms created successfully.');
    }

    /**
     * Generate sequential room numbers for the requested type.
     */
    private function generateRoomNumbers(string $type, int $count, ?RoomCategory $category = null): array
    {
        $prefix = $this->determineRoomPrefix($type);
        $existing = Room::where('room_number', 'like', $prefix . '%')->pluck('room_number')->all();

        $maxIndex = 0;
        foreach ($existing as $roomNumber) {
            if (preg_match('/^' . preg_quote($prefix, '/') . '(\d+)$/', $roomNumber, $matches)) {
                $index = (int) $matches[1];
                if ($index > $maxIndex) {
                    $maxIndex = $index;
                }
            }
        }

        $roomNumbers = [];
        $nextIndex = $maxIndex + 1;

        while (count($roomNumbers) < $count) {
            $suffix = str_pad((string) $nextIndex, 2, '0', STR_PAD_LEFT);
            $roomNumber = $prefix . $suffix;

            if ($category && ! in_array($roomNumber, $category->room_numbers, true)) {
                throw new \RuntimeException("Generated room number {$roomNumber} is outside the selected category range.");
            }

            if (Room::where('room_number', $roomNumber)->exists()) {
                $nextIndex++;
                continue;
            }

            $roomNumbers[] = $roomNumber;
            $nextIndex++;
        }

        return $roomNumbers;
    }

    private function determineRoomPrefix(string $type): string
    {
        switch (strtolower(trim($type))) {
            case 'standard':
                return '1';
            case 'deluxe':
                return '2';
            case 'suite':
                return '3';
            case 'presidential':
                return 'PS';
            default:
                return '1';
        }
    }

    /**
     * Display the specified room.
     */
    public function show(Room $room)
    {
        return view('admin.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified room.
     */
    public function edit(Room $room)
    {
        $categories = RoomCategory::orderBy('name')->get();

        return view('admin.rooms.edit', compact('room', 'categories'));
    }

    /**
     * Update the specified room.
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|string|max:50',
            'bed_type' => 'nullable|string|max:100',
            'room_category_id' => 'nullable|exists:room_categories,id',
            'price_per_night' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'room_number' => 'required|string|unique:rooms,room_number,' . $room->id,
            'status' => 'required|in:available,maintenance,booked',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if (! empty($validated['room_category_id'])) {
            $category = RoomCategory::find($validated['room_category_id']);
            if ($category && ! in_array($validated['room_number'], $category->room_numbers, true)) {
                return back()->withInput()->withErrors(['room_number' => 'Room number must fall within the selected category range.']);
            }

            $validated['type'] = $category->name;
        }

        if ($request->hasFile('image')) {
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $validated['image'] = $request->file('image')->store('rooms', 'public');
        }

        if (! array_key_exists('active', $validated) && $room->active === null) {
            $validated['active'] = true;
        }

        $room->update($validated);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified room or rooms by type.
     */
    public function destroy(Request $request, ?Room $room = null)
    {
        // Handle deletion by room type (custom endpoint)
        if ($request->has('room_type')) {
            return $this->destroyByType($request);
        }
        
        // Handle single room deletion (via route model binding)
        if ($room) {
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $room->delete();

            return redirect()->route('admin.rooms.index')
                ->with('success', 'Room deleted successfully.');
        }
        
        // If we get here, the route model binding failed (invalid ID)
        // but we're not deleting by type, so show an error
        return redirect()->route('admin.rooms.index')
            ->with('error', 'Invalid room ID provided for deletion.');
    }

    /**
     * Delete all rooms of a specific type.
     */
    public function destroyByType(Request $request)
    {
        $request->validate([
            'room_type' => 'required|string|max:50',
        ]);

        $roomType = $request->input('room_type');
        
        // Get all rooms of this type
        $rooms = Room::where('type', $roomType)->get();
        
        if ($rooms->isEmpty()) {
            return redirect()->route('admin.rooms.index')
                ->with('error', "No rooms found for type: {$roomType}");
        }
        
        // Delete each room
        foreach ($rooms as $room) {
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $room->delete();
        }
        
        return redirect()->route('admin.rooms.index')
            ->with('success', "All {$rooms->count()} rooms of type {$roomType} deleted successfully.");
    }
}
