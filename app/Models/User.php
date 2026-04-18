<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Review;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'profile_picture',
        'first_name',
        'last_name',
        'user_name',
        'email',
        'tel',
        'password',
        'postal_code',
        'address',
        'country',
        'rank',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }


    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function purchased(): HasMany
    {
        return $this->hasMany(Purchased::class);
    }

    // public function visited():HasMany
    // {
    //     return $this->hasMany(Visited::class);
    // }


    public function favorite_restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'favorite_restaurants');
    }

 
    public function favorite_kits()
{
    return $this->belongsToMany(
        Product::class,    
        'favorites',
        'user_id',         
        'product_id'      
    )->withTimestamps();
}

    public function coupons()
    {
        return $this->belongsToMany(\App\Models\Coupon::class, 'user_coupons')
                    ->withPivot('is_used', 'used_at')
                    ->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
