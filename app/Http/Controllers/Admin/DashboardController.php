<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use App\Models\RoomCategory;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function index()
    {
        $totalRooms = Room::count();
        $availableRooms = Room::where('status', 'available')->count();
        $occupiedRooms = Room::where('status', 'booked')->count();
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $totalUsers = User::where('role', 'user')->count();
        $totalStaff = User::where('role', 'staff')->count();
        
        $recentBookings = Booking::with(['user', 'room'])
            ->latest()
            ->take(5)
            ->get();

        $roomCategories = RoomCategory::select('id', 'name', 'price_per_night')
            ->orderBy('id')
            ->get();

        if ($roomCategories->isEmpty()) {
            $roomCategories = Room::available()
                ->whereNotNull('type')
                ->select('type as name', 'price_per_night')
                ->groupBy('type', 'price_per_night')
                ->orderByRaw('MIN(id)')
                ->get();
        }

        $availableRoomRecords = Room::available()
            ->orderBy('id')
            ->get(['id', 'room_number', 'type', 'room_category_id', 'price_per_night']);

        $revenue = Booking::where('status', '!=', 'cancelled')
            ->sum('total_price');

        return view('admin.dashboard', compact(
            'totalRooms',
            'availableRooms',
            'occupiedRooms',
            'totalBookings',
            'pendingBookings',
            'totalUsers',
            'totalStaff',
            'recentBookings',
            'revenue',
            'roomCategories',
            'availableRoomRecords'
        ));
    }
}
