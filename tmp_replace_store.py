from pathlib import Path
path = Path('app/Http/Controllers/Admin/RoomController.php')
text = path.read_text(encoding='utf-8')
start = text.index('    public function store(Request $request)')
end = text.index('    /**\n     * Display the specified room.')
replacement = '''    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|string|max:50',
            'bed_type' => 'nullable|string|max:100',
            'room_category_id' => 'nullable|exists:room_categories,id',
            'price_per_night' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'rooms_available' => 'required|integer|min:1',
            'status' => 'nullable|in:available,maintenance,booked',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $validated['status'] = $validated['status'] ?? 'available';

        $category = null;
        if (! empty($validated['room_category_id'])) {
            $category = RoomCategory::find($validated['room_category_id']);
            $validated['type'] = $category->name;
        }

        if (! array_key_exists('active', $validated)) {
            $validated['active'] = true;
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('rooms', 'public');
        }

        $count = (int) ($validated['rooms_available'] ?? 1);

        try {
            $roomNumbers = $this->generateRoomNumbers($validated['type'], $count, $category);
        } catch (\\RuntimeException $exception) {
            return back()->withInput()->withErrors(['rooms_available' => $exception->getMessage()]);
        }

        DB::transaction(function () use ($roomNumbers, $validated) {
            foreach ($roomNumbers as $roomNumber) {
                $attributes = array_merge($validated, [
                    'room_number' => $roomNumber,
                    'name' => $validated['name'] . ' ' . $roomNumber,
                    'description' => $validated['description'] ?? null,
                    'status' => $validated['status'] ?? 'available',
                ]);

                Room::create($attributes);
            }
        });

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Rooms created successfully.');
    }

    /**
     * Display the specified room.
'''
text = text[:start] + replacement + text[end:]
path.write_text(text, encoding='utf-8')
print('patched')
