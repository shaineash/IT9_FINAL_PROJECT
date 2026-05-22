<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
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

        if (! empty($validated['room_category_id'])) {
            $category = RoomCategory::find($validated['room_category_id']);
            // No room_number to validate since we're generating them automatically
            // The category validation for room numbers happens during room creation
            
            $validated['type'] = $category->name;
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('rooms', 'public');
        }

        if (! array_key_exists('active', $validated)) {
            $validated['active'] = true;
        }

        // If admin provided a count of rooms, create multiple sequential room records
        if (! empty($validated['rooms_available'])) {
            $count = (int) $validated['rooms_available'];

            // Determine prefix based on type (floor mapping)
            $type = $validated['type'];
            $prefix = null;
            $isNumericFloor = false;

            switch (strtolower($type)) {
                case 'standard':
                    $prefix = '1';
                    $isNumericFloor = true;
                    break;
                case 'deluxe':
                    $prefix = '2';
                    $isNumericFloor = true;
                    break;
                case 'suite':
                    $prefix = '3';
                    $isNumericFloor = true;
                    break;
                case 'presidential':
                    $prefix = 'PS';
                    $isNumericFloor = false;
                    break;
                default:
                    // fallback to floor 1 numbering
                    $prefix = '1';
                    $isNumericFloor = true;
            }

            
            
            // find existing highest index for this prefix
            if ($isNumericFloor) {
                $like = $prefix . '%';
                $existing = Room::where('room_number', 'like', $like)->pluck('room_number')->all();
                $maxIndex = 0;
                foreach ($existing as $rn) {
                    if (preg_match('/^' . preg_quote($prefix, '/') . '(\d+)$/', $rn, $m)) {
                        $idx = (int) $m[1];
                        if ($idx > $maxIndex) $maxIndex = $idx;
                    }
                }
                $startIndex = $maxIndex + 1;
                $pad = 2;
            } else {
                $like = $prefix . '%';
                $existing = Room::where('room_number', 'like', $like)->pluck('room_number')->all();
                $maxIndex = 0;
                foreach ($existing as $rn) {
                    if (preg_match('/^' . preg_quote($prefix, '/') . '(\d+)$/', $rn, $m)) {
                        $idx = (int) $m[1];
                        if ($idx > $maxIndex) $maxIndex = $idx;
                    }
                }
                $startIndex = $maxIndex + 1;
                $pad = 2;
            }

            // ensure category range check if category provided
            $category = null;
            if (! empty($validated['room_category_id'])) {
                $category = RoomCategory::find($validated['room_category_id']);
            }

            
            
            
            
            
            
            
            
            foreach (range(0, $count - 1) as $i) {
                $index = $startIndex + $i;
                $suffix = str_pad((string) $index, $pad, '0', STR_PAD_LEFT);
                $roomNumber = $isNumericFloor ? ($prefix . $suffix) : ($prefix . $suffix);

                // if category defined, ensure generated room number is allowed
                if ($category) {
                    if (! in_array($roomNumber, $category->room_numbers, true)) {
                        return back()->withInput()->withErrors(['rooms_available' => "Generated room number $roomNumber is outside the selected category range."]);
                    }
                }

                if (Room::where('room_number', $roomNumber)->exists()) {
                    return back()->withInput()->withErrors(['rooms_available' => "Generated room number $roomNumber already exists. Please adjust rooms available or rename existing rooms."]);
                }

                $attributes = array_merge($validated, [
                    'room_number' => $roomNumber,
                    'name' => $validated['name'] . ' ' . $roomNumber,
                    'description' => $validated['description'] ?? null,
                    'status' => $validated['status'] ?? 'available',
                ]);

                if ($request->hasFile('image')) {
                    $attributes['image'] = $request->file('image')->store('rooms', 'public');
                }

                Room::create($attributes);
            }

            return redirect()->route('admin.rooms.index')
                ->with('success', 'Rooms created successfully.');
        }

        // (rooms are created above in the loop). Should not reach here.
        return redirect()->route('admin.rooms.index')
            ->with('success', 'Rooms created successfully.');
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
