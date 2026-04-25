<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Restaurant;
use App\Models\User;

class Reservation extends Model
{
    use HasFactory;

    // --- Status Constants ---
    const STATUS_PENDING   = 'pending';   // Waiting for approval
    const STATUS_CONFIRMED = 'confirmed'; // Reservation booked
    const STATUS_CANCELLED = 'cancelled'; // Cancelled by user or restaurant
    const STATUS_COMPLETED = 'completed'; // Visited / Finished
    const STATUS_NOSHOW    = 'no_show';   // User did not show up

    protected $fillable = [
        'restaurant_id',
        'user_id',
        'reservation_date',
        'reservation_time',
        'reserved_at',
        'number_of_people',
        'full_name',
        'phone',
        'email',
        'special_requests',
        'status',
        'visited_at',
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'reservation_time' => 'datetime:H:i',
        'reserved_at'      => 'datetime',
        'visited_at'       => 'datetime',
    ];

    // --- Relationships ---

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // --- Helpers (Optional but useful) ---

    /**
     * Check if the reservation is completed (visited).
     */
    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Get a human-friendly label for the status.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING   => 'Pending',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_COMPLETED => 'Visited',
            self::STATUS_NOSHOW    => 'No-show',
            default                => 'Unknown',
        };
    }
}
