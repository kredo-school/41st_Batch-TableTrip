<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchased extends Model
{
    use HasFactory;

    protected $table = 'purchased';

    protected $fillable = [
        'id',
        'order_id',
        'user_id',
        'meal_kit_id',
        'quantity',
        'price_at_purchased',
        'ordered_at',
    ];
}