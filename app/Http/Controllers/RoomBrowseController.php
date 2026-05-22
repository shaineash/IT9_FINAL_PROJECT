<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Booking;

class RoomBrowseController extends Controller
{
    public function index()
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

        return view('user.rooms.browse', [
            'roomCategories' => $roomCategories,
            'uncategorizedRooms' => $uncategorizedRooms,
            'roomTypes' => $roomTypes,
        ]);
    }

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
