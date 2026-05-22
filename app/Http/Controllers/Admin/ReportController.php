<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $userQuery = User::query();
        if ($search) {
            $userQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $userQuery->latest()->paginate(15)->withQueryString();

        $monthlyReports = Booking::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month")
            ->selectRaw('COUNT(*) as bookings')
            ->selectRaw('SUM(total_price) as revenue')
            ->where('status', '!=', 'cancelled')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();

        return view('admin.reports.index', compact('users', 'monthlyReports', 'search'));
    }
}
