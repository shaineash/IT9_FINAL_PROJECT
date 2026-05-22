<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of rooms for authenticated users.
     */
    public function index(Request $request)
    {
        $roomTypes = ['STANDARD', 'DELUXE', 'SUITE', 'PRESIDENTIAL'];

        $roomCategories = RoomCategory::with(['rooms' => function ($query) {
            $query->available()->orderBy('room_number');
        }])
        ->whereHas('rooms', function ($query) {
            $query->available();
        })
        ->whereRaw('upper(name) in (?, ?, ?, ?)', $roomTypes)
        ->orderByRaw("FIELD(upper(name), 'STANDARD', 'DELUXE', 'SUITE', 'PRESIDENTIAL')")
        ->get()
        ->keyBy(fn ($category) => strtoupper($category->name))
        ->only($roomTypes)
        ->values();

        $uncategorizedRooms = Room::available()
            ->whereNull('room_category_id')
            ->orderBy('type')
            ->orderBy('room_number')
            ->get()
            ->groupBy(fn ($room) => Room::normalizeType($room->type))
            ->map(fn ($group) => $group->first())
            ->values();

        return view('user.rooms.index', [
            'roomCategories' => $roomCategories,
            'uncategorizedRooms' => $uncategorizedRooms,
            'roomTypes' => $roomTypes,
        ]);
    }

    /**
     * Display the specified room.
     */
    public function show(Room $room)
    {
        $category = $room->roomCategory;

        if ($category) {
            $typeRooms = Room::where('room_category_id', $category->id)
                ->active()
                ->orderBy('room_number')
                ->get()
                ->keyBy('room_number');
        } else {
            $typeRooms = Room::ofType($room->type)
                ->active()
                ->orderBy('room_number')
                ->get()
                ->keyBy('room_number');
        }

        $roomNumbers = $typeRooms->keys()->all();
        $roomIds = $typeRooms->pluck('id')->toArray();

        $bookings = Booking::whereIn('room_id', $roomIds)
            ->whereNotIn('status', ['cancelled'])
            ->get();

        $defaultRoom = $room;
        if (! $room->active || $room->status !== 'available') {
            $defaultRoom = $typeRooms->firstWhere('status', 'available');
        }

        $selectedRoomId = old('selected_room_id', $defaultRoom?->id);

        return view('user.rooms.show', compact('room', 'roomNumbers', 'typeRooms', 'bookings', 'selectedRoomId'));
    }
}
