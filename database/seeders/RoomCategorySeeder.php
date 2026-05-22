<?php

namespace Database\Seeders;

use App\Models\RoomCategory;
use Illuminate\Database\Seeder;

class RoomCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'STANDARD',
                'range_start' => '101',
                'range_end' => '110',
                'price_per_night' => 150.00,
                'capacity' => 2,
                'description' => 'Comfortable standard rooms with essential amenities for a pleasant stay.',
            ],
            [
                'name' => 'DELUXE',
                'range_start' => '201',
                'range_end' => '210',
                'price_per_night' => 250.00,
                'capacity' => 3,
                'description' => 'Spacious deluxe rooms with premium amenities and city views.',
            ],
            [
                'name' => 'SUITE',
                'range_start' => '301',
                'range_end' => '305',
                'price_per_night' => 400.00,
                'capacity' => 4,
                'description' => 'Luxurious suites with separate living areas and premium services.',
            ],
            [
                'name' => 'PRESIDENTIAL',
                'range_start' => 'PS1',
                'range_end' => 'PS6',
                'price_per_night' => 800.00,
                'capacity' => 6,
                'description' => 'Exclusive presidential suites with panoramic views and VIP services.',
            ],
        ];

        foreach ($categories as $category) {
            $existing = RoomCategory::where('name', $category['name'])->first();
            if (!$existing) {
                $cat = RoomCategory::create($category);
                $cat->syncRooms();
            }
        }
    }
}