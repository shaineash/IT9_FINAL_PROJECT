<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Booking;

class RoomBrowseController extends Controller
{
    public function index()
    {
        // Group all active rooms by type — works whether or not categories exist
        $roomGroups = Room::active()
            ->orderByRaw("CASE upper(type)
                WHEN 'STANDARD' THEN 1
                WHEN 'DELUXE' THEN 2
                WHEN 'SUITE' THEN 3
                WHEN 'PRESIDENTIAL' THEN 4
                ELSE 5 END")
            ->orderBy('room_number')
            ->get()
            ->groupBy(fn ($room) => Room::normalizeType($room->type));

        // Attach category metadata if it exists, otherwise derive from rooms
        $roomTypes = $roomGroups->map(function ($rooms, $typeName) {
            $category = RoomCategory::whereRaw('upper(name) = ?', [$typeName])->first();
            $representative = $rooms->first();

            return (object) [
                'type'            => $typeName,
                'label'           => ucfirst(strtolower($typeName)),
                'category'        => $category,
                'rooms'           => $rooms,
                'available_rooms' => $rooms->where('status', 'available'),
                'first_available' => $rooms->firstWhere('status', 'available'),
                'representative'  => $representative,
                'price_per_night' => $category?->price_per_night ?? $representative->price_per_night,
                'capacity'        => $category?->capacity ?? $representative->capacity,
                'description'     => $category?->description ?? $representative->description,
                'image'           => $category?->image ?? $representative->image,
            ];
        });

        return view('user.rooms.browse', compact('roomTypes'));
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
