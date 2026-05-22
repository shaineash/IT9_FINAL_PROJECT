<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\RoomCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'bed_type',
        'price_per_night',
        'capacity',
        'description',
        'image',
        'status',
        'room_number',
        'room_category_id',
        'active',
    ];

    public function roomCategory(): BelongsTo
    {
        return $this->belongsTo(RoomCategory::class, 'room_category_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public static function normalizeType(string $type): string
    {
        return strtoupper(trim($type));
    }

    public static function roomNumbersForType(string $type): array
    {
        $category = RoomCategory::whereRaw('upper(name) = ?', [self::normalizeType($type)])->first();

        return $category ? $category->room_numbers : [];
    }

    public static function hasRoomNumbersForType(string $type): bool
    {
        return RoomCategory::whereRaw('upper(name) = ?', [self::normalizeType($type)])->exists();
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available')
            ->where(function ($query) {
                $query->where('active', true)
                    ->orWhereNull('active');
            });
    }

    public function scopeActive($query)
    {
        return $query->where(function ($query) {
            $query->where('active', true)
                ->orWhereNull('active');
        });
    }

    public function scopeOfType($query, string $type)
    {
        return $query->whereRaw('upper(type) = ?', [self::normalizeType($type)]);
    }
}
