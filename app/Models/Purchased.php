<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchased extends Model
{
    protected $table = 'purchased';

    protected $fillable = [
        'user_id',
        'meal_kit_id',
        'quantity',
        'price_at_purchased',
        'ordered_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'meal_kit_id');
    }
}
