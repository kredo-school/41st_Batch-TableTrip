<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\CartItem;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;


/**
     * The attributes that are mass  assignable.
     *
     * @var list<string>
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }


    public function favorite_restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'favorite_restaurants');
    }
    public function favorite_kits()
    {
    return $this->belongsToMany(\App\Models\Product::class, 'favorite_kits', 'user_id', 'meal_kit_id')->withTimestamps();
    }

 public function reservations()
{
    return $this->hasMany(Reservation::class);
}}



    