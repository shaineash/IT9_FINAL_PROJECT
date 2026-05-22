<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display booking form for a specific room.
     */
    public function create(Room $room)
    {
        if (! $room->active) {
            return redirect()->route('user.rooms.index')
                ->with('error', 'This room is not available for booking.');
        }

        $roomType = Room::normalizeType($room->type);
        $category = RoomCategory::whereRaw('upper(name) = ?', [$roomType])->first();

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

        if ($typeRooms->isEmpty()) {
            return redirect()->route('user.rooms.index')
                ->with('error', 'No rooms are currently configured for this category.');
        }

        $roomNumbers = $typeRooms->keys()->all();
        $roomIds = $typeRooms->pluck('id')->toArray();

        $bookings = Booking::whereIn('room_id', $roomIds)
            ->whereNotIn('status', ['cancelled'])
            ->get();

        $assignedRoom = $typeRooms->firstWhere('status', 'available');
        $hasAvailable = ! empty($assignedRoom);

        return view('user.bookings.create', compact('room', 'roomNumbers', 'typeRooms', 'bookings', 'assignedRoom', 'hasAvailable'));
    }

    /**
     * Store a new booking.
     */
    public function store(Request $request, Room $room)
    {
        $validated = $request->validate([
            'guest_name' => 'required|string|max:150',
            'guest_email' => 'required|email|max:150',
            'contact_number' => 'required|string|max:40',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'number_of_guests' => 'required|integer|min:1|max:' . $room->capacity,
            'room_number' => 'nullable|string',
            'special_requests' => 'nullable|string|max:500',
        ]);

        $roomQuery = Room::where('room_category_id', $room->room_category_id);
        if (! $room->room_category_id) {
            $roomQuery = Room::ofType($room->type);
        }

        // If user selected a specific room number, validate that it's available for the requested dates
        if (! empty($validated['room_number'])) {
            $selectedRoom = $roomQuery->where('room_number', $validated['room_number'])->active()->first();
            if (! $selectedRoom) {
                return back()->withInput()->with('error', 'Selected room number is not valid for this category.');
            }

            $existingBooking = Booking::where('room_id', $selectedRoom->id)
                ->where(function ($query) use ($validated) {
                    $query->whereBetween('check_in', [$validated['check_in'], $validated['check_out']])
                        ->orWhereBetween('check_out', [$validated['check_in'], $validated['check_out']])
                        ->orWhere(function ($q) use ($validated) {
                            $q->where('check_in', '<=', $validated['check_in'])
                                ->where('check_out', '>=', $validated['check_out']);
                        });
                })
                ->whereNotIn('status', ['cancelled'])
                ->exists();

            if ($existingBooking) {
                return back()->withInput()->with('error', 'This room number is already booked for the selected dates.');
            }
        } else {
            // auto-select next available room that has no overlapping bookings
            $selectedRoom = $roomQuery
                ->active()
                ->where('status', 'available')
                ->orderBy('room_number')
                ->get()
                ->first(function ($candidate) use ($validated) {
                    return ! Booking::where('room_id', $candidate->id)
                        ->whereNotIn('status', ['cancelled'])
                        ->where(function ($query) use ($validated) {
                            $query->whereBetween('check_in', [$validated['check_in'], $validated['check_out']])
                                ->orWhereBetween('check_out', [$validated['check_in'], $validated['check_out']])
                                ->orWhere(function ($q) use ($validated) {
                                    $q->where('check_in', '<=', $validated['check_in'])
                                        ->where('check_out', '>=', $validated['check_out']);
                                });
                        })
                        ->exists();
                });
        }

        if (! $selectedRoom) {
            return back()->withInput()->with('error', 'No available rooms for this type.');
        }

        $existingBooking = Booking::where('room_id', $selectedRoom->id)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('check_in', [$validated['check_in'], $validated['check_out']])
                    ->orWhereBetween('check_out', [$validated['check_in'], $validated['check_out']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('check_in', '<=', $validated['check_in'])
                            ->where('check_out', '>=', $validated['check_out']);
                    });
            })
            ->whereNotIn('status', ['cancelled'])
            ->exists();

        if ($existingBooking) {
            return back()->withInput()->with('error', 'This room number is already booked for the selected dates.');
        }

        $nights = Carbon::parse($validated['check_in'])->diffInDays(Carbon::parse($validated['check_out']));
        $totalPrice = $selectedRoom->price_per_night * max($nights, 1);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $selectedRoom->id,
            'guest_name' => $validated['guest_name'],
            'guest_email' => $validated['guest_email'],
            'contact_number' => $validated['contact_number'],
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'number_of_guests' => $validated['number_of_guests'],
            'total_price' => $totalPrice,
            'status' => 'pending',
            'special_requests' => $validated['special_requests'] ?? null,
        ]);

        $selectedRoom->update(['status' => 'booked']);

        return redirect()->route('user.bookings.payment.create', $booking)
            ->with('success', 'Booking saved. Please complete payment to confirm your stay.');
    }

    /**
     * Display user's bookings.
     */
    public function index()
    {
        $bookings = Auth::user()->bookings()
            ->with('room')
            ->latest()
            ->paginate(10);

        return view('user.bookings.index', compact('bookings'));
    }

    /**
     * Display a specific booking.
     */
    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->load(['room']);

        return view('user.bookings.show', compact('booking'));
    }

    /**
     * Cancel a booking.
     */
    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id() || ! in_array($booking->status, ['pending', 'confirmed'])) {
            abort(403);
        }

        $booking->update(['status' => 'cancelled']);

        $hasActiveBookings = $booking->room->bookings()
            ->where('id', '!=', $booking->id)
            ->whereNotIn('status', ['cancelled'])
            ->exists();

        if (! $hasActiveBookings) {
            $booking->room->update(['status' => 'available']);
        }

        return back()->with('success', 'Booking cancelled successfully.');
    }
}
