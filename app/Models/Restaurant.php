<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Reservation;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Category;
use App\Models\AbleImage;
use App\Models\Menu;

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
        'status',
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
        return $this->hasMany(AbleImage::class, 'target_id')
            ->where('target_type', 'restaurant')
            ->orderBy('display_order');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
