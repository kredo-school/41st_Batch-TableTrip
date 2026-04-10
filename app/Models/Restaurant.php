<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Reservation;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Restaurant extends Authenticatable
{
    protected $fillable = [
        'restaurant_name',
        'email',
        'phone',
        'prefecture',
        'city',
        'address_line',
        'opening_hours',
        'description',
        'category_id',
        'reservation_limit',
        'approval_status',
        'approved_at',
        'password',
    ];

     protected $hidden = [
        'password',
        'remember_token',
    ];

     protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->morphMany(AbleImage::class, 'target');
    }
}
