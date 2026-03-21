<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Restaurant;

class Reservation extends Model
{
    protected $fillable = [ 
        'restaurant_id',    // 'restaurants_id' から修正（単数形が一般的）
        'user_id',
        'reserved_at',
        'number_of_people', // もしDBが number_of_guests ならそちらに合わせてください
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

 
    public function restaurant(): BelongsTo
    {

        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

  
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}