<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Restaurant;

class Reservation extends Model
{
    use HasFactory;
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