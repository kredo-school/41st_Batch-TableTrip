<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
        'price',
        'image',
    ];

     public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
