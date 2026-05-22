<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RoomCategoryController extends Controller
{
    public function index()
    {
        $categories = RoomCategory::latest()->paginate(12);

        return view('admin.room-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.room-categories.create');
    }

    public function store(Request $request)
    {
        $allowedTypes = ['STANDARD', 'DELUXE', 'SUITE', 'PRESIDENTIAL'];
        
        $validated = $request->validate([
            'name' => 'required|string|in:' . implode(',', $allowedTypes),
            'price_per_night' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $existing = RoomCategory::where('name', $validated['name'])->first();
        if ($existing) {
            return back()->withInput()->withErrors([
                'name' => 'This room category already exists.',
            ]);
        }

        // Set predefined ranges based on type
        $ranges = [
            'STANDARD' => ['start' => '101', 'end' => '110'],
            'DELUXE' => ['start' => '201', 'end' => '210'],
            'SUITE' => ['start' => '301', 'end' => '305'],
            'PRESIDENTIAL' => ['start' => 'PS1', 'end' => 'PS6'],
        ];

        $range = $ranges[$validated['name']] ?? null;
        if (!$range) {
            return back()->withInput()->withErrors([
                'name' => 'Invalid room category type.',
            ]);
        }

        $category = RoomCategory::create(array_merge($validated, [
            'range_start' => $range['start'],
            'range_end' => $range['end'],
        ]));
        $category->syncRooms();

        return redirect()->route('admin.room-categories.index')
            ->with('success', 'Room category created and room numbers synced successfully.');
    }

    public function edit(RoomCategory $roomCategory)
    {
        return view('admin.room-categories.edit', compact('roomCategory'));
    }

    public function update(Request $request, RoomCategory $roomCategory)
    {
        $allowedTypes = ['STANDARD', 'DELUXE', 'SUITE', 'PRESIDENTIAL'];
        
        $validated = $request->validate([
            'name' => 'required|string|in:' . implode(',', $allowedTypes),
            'price_per_night' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $existing = RoomCategory::where('name', $validated['name'])
            ->where('id', '!=', $roomCategory->id)
            ->first();
        if ($existing) {
            return back()->withInput()->withErrors([
                'name' => 'This room category already exists.',
            ]);
        }

        // Set predefined ranges based on type
        $ranges = [
            'STANDARD' => ['start' => '101', 'end' => '110'],
            'DELUXE' => ['start' => '201', 'end' => '210'],
            'SUITE' => ['start' => '301', 'end' => '305'],
            'PRESIDENTIAL' => ['start' => 'PS1', 'end' => 'PS6'],
        ];

        $range = $ranges[$validated['name']] ?? null;
        if (!$range) {
            return back()->withInput()->withErrors([
                'name' => 'Invalid room category type.',
            ]);
        }

        $roomCategory->update(array_merge($validated, [
            'range_start' => $range['start'],
            'range_end' => $range['end'],
        ]));
        $roomCategory->syncRooms();

        return redirect()->route('admin.room-categories.index')
            ->with('success', 'Room category updated and room numbers synced successfully.');
    }

    public function destroy(RoomCategory $roomCategory)
    {
        $roomCategory->rooms()->update(['active' => false]);
        $roomCategory->delete();

        return redirect()->route('admin.room-categories.index')
            ->with('success', 'Room category removed and rooms retired from booking.');
    }
}
