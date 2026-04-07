<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchased extends Model
{
    use HasFactory;

    protected $table = 'purchased';

    protected $fillable = [
        'user_id',
        'meal_kit_id',
        'quantity',
        'total_price',
        'ordered_at',
        'status'
    ];

    // public function meal_kit()
    // {
    //     return $this->belongsTo(MealKit::class, 'meal_kit_id');
    // }
}