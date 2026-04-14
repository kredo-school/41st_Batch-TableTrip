<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Reservation;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Review;
use App\Models\Category;
use App\Models\Menu;
use App\Models\AbleImage;
use App\Models\Notification;

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

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
  
    public function images()
    {
        return $this->morphMany(AbleImage::class, 'target');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'restaurant_id');
    }

    public function heroImage()
    {
        return $this->hasOne(AbleImage::class, 'target_id')
        ->where('target_type', 'restaurant')
        ->where('display_order', 1);
    }

    public function galleryImage1()
    {
        return $this->hasOne(AbleImage::class, 'target_id')
        ->where('target_type', 'restaurant')
        ->where('display_order', 2);
    }

    public function galleryImage2()
    {
        return $this->hasOne(AbleImage::class, 'target_id')
        ->where('target_type', 'restaurant')
        ->where('display_order', 3);
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'recipient');
    }
}
