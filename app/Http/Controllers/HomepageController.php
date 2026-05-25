<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RoomCategory;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function index()
    {
        $roomCategories = RoomCategory::whereIn(DB::raw('upper(name)'), ['STANDARD', 'DELUXE', 'SUITE', 'PRESIDENTIAL'])
            ->orderByRaw(
                "CASE upper(name) WHEN 'STANDARD' THEN 1 WHEN 'DELUXE' THEN 2 WHEN 'SUITE' THEN 3 WHEN 'PRESIDENTIAL' THEN 4 ELSE 5 END"
            )
            ->get();

        return view('welcome', compact('roomCategories'));
    }
}
