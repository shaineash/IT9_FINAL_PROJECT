<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;


class HomeController extends Controller
{
    /**
     * Display user dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $upcomingBookings = $user->bookings()
            ->whereIn('status', ['pending', 'confirmed'])
            ->with('room')
            ->latest()
            ->take(3)
            ->get();

        $pastBookings = $user->bookings()
            ->whereIn('status', ['checked_out', 'cancelled'])
            ->with('room')
            ->latest()
            ->take(3)
            ->get();

        return view('user.home', compact(
            'user',
            'upcomingBookings',
            'pastBookings'
        ));
    }
}