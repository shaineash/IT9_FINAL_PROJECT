<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class RoomCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'range_start',
        'range_end',
        'price_per_night',
        'capacity',
        'description',
        'image',
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class, 'room_category_id');
    }

    public function getRoomNumbersAttribute(): array
    {
        return self::generateRoomNumbers($this->range_start, $this->range_end);
    }

    public static function generateRoomNumbers(string $start, string $end): array
    {
        if (! preg_match('/^([A-Za-z]*)(\d+)$/', $start, $startMatches)) {
            return [];
        }

        if (! preg_match('/^([A-Za-z]*)(\d+)$/', $end, $endMatches)) {
            return [];
        }

        if ($startMatches[1] !== $endMatches[1]) {
            return [];
        }

        $prefix = $startMatches[1];
        $startIndex = (int) $startMatches[2];
        $endIndex = (int) $endMatches[2];

        if ($startIndex > $endIndex) {
            return [];
        }

        $pad = strlen($startMatches[2]);
        $roomNumbers = [];

        for ($index = $startIndex; $index <= $endIndex; $index++) {
            $roomNumbers[] = $prefix . str_pad((string) $index, $pad, '0', STR_PAD_LEFT);
        }

        return $roomNumbers;
    }

    public function syncRooms(): void
    {
        DB::transaction(function () {
            $currentRooms = $this->rooms()->get()->keyBy('room_number');
            $roomNumbers = $this->room_numbers;

            foreach ($roomNumbers as $roomNumber) {
                $attributes = [
                    'room_category_id' => $this->id,
                    'type' => $this->name,
                    'name' => $this->name . ' ' . $roomNumber,
                    'price_per_night' => $this->price_per_night,
                    'capacity' => $this->capacity,
                    'active' => true,
                ];

                if ($currentRooms->has($roomNumber)) {
                    $room = $currentRooms->get($roomNumber);
                    $room->update(array_merge($attributes, [
                        'status' => $room->status,
                    ]));
                    continue;
                }

                Room::create(array_merge($attributes, [
                    'room_number' => $roomNumber,
                    'description' => $this->description,
                    'status' => 'available',
                ]));
            }

            $this->rooms()->whereNotIn('room_number', $roomNumbers)->update(['active' => false]);
        });
    }
}
