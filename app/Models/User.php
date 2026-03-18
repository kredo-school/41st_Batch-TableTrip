<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// 大事：これがないと reservations(): HasMany でエラーになります
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * 開発中のDB設計に合わせた fillable 設定
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'user_name',
        'email',
        'tel',
        'password',
        'postal_code',
        'address',
        'country',
        'profile_picture',
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

    // --- 以下、ダッシュボードに必要なリレーション群 ---

    /**
     * カートアイテムとの連携
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * 予約履歴との連携
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class); 
    }


    public function purchased(): HasMany
    {
        return $this->hasMany(Purchased::class);
    }


    public function favorite_restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'favorite_restaurants');
    }

    // public function favorite_kits()
    // {
  
    //     return $this->belongsToMany(Product::class, 'favorite_kits', 'user_id', 'meal_kit_id')->withTimestamps();
    // }
}