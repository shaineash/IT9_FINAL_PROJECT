<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\User;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of all bookings.
     */
    public function index(Request $request)
    {
        $allowedStatuses = ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'];
        $query = Booking::with(['user', 'room']);

        if ($request->filled('status') && in_array($request->status, $allowedStatuses, true)) {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->paginate(15)->withQueryString();

        $totalCheckinsToday = Booking::whereDate('check_in', today())
            ->whereIn('status', ['confirmed', 'checked_in'])
            ->count();
        $totalBookings = Booking::count();
        $pendingCount = Booking::where('status', 'pending')->count();
        $checkedInCount = Booking::where('status', 'checked_in')->count();
        $cancelledCount = Booking::where('status', 'cancelled')->count();
        $confirmedCount = Booking::where('status', 'confirmed')->count();
        $checkedOutCount = Booking::where('status', 'checked_out')->count();
        $revenue = Booking::where('status', '!=', 'cancelled')->sum('total_price');

        return view('admin.bookings.index', compact('bookings', 'totalCheckinsToday', 'totalBookings', 'pendingCount', 'confirmedCount', 'checkedInCount', 'checkedOutCount', 'cancelledCount', 'revenue'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create()
    {
        $rooms = Room::available()
            ->whereNotNull('type')
            ->orderBy('id')
            ->get()
            ->groupBy(function ($room) {
                return Str::title(trim($room->type));
            });

        $roomCategories = RoomCategory::select('id', 'name', 'price_per_night')->get();

        if ($roomCategories->isEmpty()) {
            $roomCategories = Room::available()
                ->whereNotNull('type')
                ->select('type as name', 'price_per_night')
                ->groupBy('type', 'price_per_night')
                ->get();
        }

        $availableRoomRecords = Room::available()
            ->orderBy('room_number')
            ->get(['id', 'room_number', 'type', 'room_category_id', 'price_per_night']);

        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->get();

        return view('admin.bookings.create', compact('rooms', 'roomCategories', 'availableRoomRecords', 'users'));
    }

    /**
     * Display the specified booking details.
     */
    public function show(Booking $booking)
    {
        $booking->load(['user', 'room', 'payment']);

        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Store a newly created booking from admin dashboard.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'          => 'nullable|exists:users,id',
            'guest_name'       => 'required|string|max:255',
            'guest_email'      => 'nullable|email|max:255',
            'room_type'        => 'required|string|max:100',
            'room_number'      => 'required|string|max:50',
            'contact_number'   => 'nullable|string|max:50',
            'breakfast_offer'  => 'nullable|string|in:no_breakfast,with_breakfast',
            'check_in'         => 'required|date|after_or_equal:today',
            'check_out'        => 'required|date|after:check_in',
            'number_of_guests' => 'required|integer|min:1',
            'special_request'  => 'nullable|string|max:500',
        ]);

        $room = Room::active()
            ->where('room_number', $validated['room_number'])
            ->where('type', $validated['room_type'])
            ->where('status', 'available')
            ->first();

        if (! $room) {
            return back()->withInput()->with('error', 'The selected room is not available or does not match the specified type.');
        }

        if ($validated['number_of_guests'] > $room->capacity) {
            return back()->withInput()->with('error', 'Number of guests exceeds the room capacity.');
        }

        $existingBooking = Booking::where('room_id', $room->id)
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

        if ($existingBooking) {
            return back()->withInput()->with('error', 'This room is already booked for the selected dates.');
        }

        $nights = Carbon::parse($validated['check_in'])->diffInDays(Carbon::parse($validated['check_out']));
        $totalPrice = $room->price_per_night * max($nights, 1);

        $userId = $validated['user_id'] ?? auth()->id();
        $booking = Booking::create([
            'user_id'          => $userId,
            'room_id'          => $room->id,
            'guest_name'       => $validated['guest_name'],
            'guest_email'      => $validated['guest_email'] ?? auth()->user()->email,
            'contact_number'   => $validated['contact_number'] ?? null,
            'check_in'         => $validated['check_in'],
            'check_out'        => $validated['check_out'],
            'number_of_guests' => $validated['number_of_guests'],
            'total_price'      => $totalPrice,
            'status'           => 'confirmed',
            'special_requests' => $validated['special_request'] ?? null,
        ]);

        $room->update(['status' => 'booked']);

        return redirect()->route('admin.bookings.index', ['status' => 'checked_in'])
            ->with('success', 'Reservation created successfully.');
    }

    /**
     * Update the status of a booking.
     */
    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
        ]);

        $oldStatus = $booking->status;
        $booking->update($validated);

        // Update room occupancy based on new status
        if ($booking->room) {
            if ($booking->status === 'checked_in') {
                // mark room as booked/occupied
                $booking->room->update(['status' => 'booked']);
            } elseif ($booking->status === 'checked_out') {
                // mark room as available again
                $booking->room->update(['status' => 'available']);
            }
        }

        return back()->with('success', 'Booking status updated successfully.');
    }

    /**
     * Show bookings that are ready for check-in (confirmed).
     */
    public function checkins()
    {
        $bookings = Booking::with(['user', 'room', 'payment'])
            ->where('status', 'confirmed')
            ->orderBy('check_in')
            ->paginate(20);

        $totalCheckinsToday = Booking::whereDate('check_in', today())->count();
        $pendingCount = Booking::where('status', 'pending')->count();
        $completedCount = Booking::where('status', 'checked_out')->count();
        $revenue = Booking::where('status', '!=', 'cancelled')->sum('total_price');

        return view('admin.bookings.checkins', compact('bookings', 'totalCheckinsToday', 'pendingCount', 'completedCount', 'revenue'));
    }

    /**
     * Show active checked-in bookings (for check-out management).
     */
    public function checkouts()
    {
        $bookings = Booking::with(['user', 'room', 'payment'])
            ->where('status', 'checked_in')
            ->orderBy('check_out')
            ->paginate(20);

        $totalCheckoutsToday = Booking::whereDate('check_out', today())->count();
        $pendingCount = Booking::where('status', 'pending')->count();
        $completedCount = Booking::where('status', 'checked_out')->count();
        $revenue = Booking::where('status', '!=', 'cancelled')->sum('total_price');

        return view('admin.bookings.checkouts', compact('bookings', 'totalCheckoutsToday', 'pendingCount', 'completedCount', 'revenue'));
    }

    /**
     * Cancel a booking.
     */
    public function cancel(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking cancelled successfully.');
    }

    /**
     * Show the form for editing the specified booking.
     */
    public function edit(Booking $booking)
    {
        $booking->load(['user', 'room', 'payment']);
        return view('admin.bookings.edit', compact('booking'));
    }

    /**
     * Update the specified booking.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'number_of_guests' => 'required|integer|min:1|max:' . $booking->room->capacity,
            'status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
            'special_requests' => 'nullable|string',
        ]);

        // Check room availability for the new dates (excluding current booking)
        if ($validated['status'] !== 'cancelled') {
            $existingBooking = Booking::where('room_id', $booking->room_id)
                ->where('id', '!=', $booking->id)
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
                return back()->with('error', 'Room is not available for the selected dates.');
            }
        }

        // Recalculate total price
        $nights = \Carbon\Carbon::parse($validated['check_in'])->diffInDays(\Carbon\Carbon::parse($validated['check_out']));
        $validated['total_price'] = $booking->room->price_per_night * $nights;

        $booking->update($validated);

        return redirect()->route('admin.bookings.show', $booking)
            ->with('success', 'Booking updated successfully.');
    }
}
