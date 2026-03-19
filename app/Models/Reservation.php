<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Restaurant;

class Reservation extends Model
{
    protected $fillable = [ 
        'restaurants_id',
        'user_id',
        'reservation_date',
        'reservation_time',
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
        'visited_at' => 'datetime',
    ];

    // : BelongsTo -> IDE補完・laravel推奨・型安全　
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
