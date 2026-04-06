<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchased extends Model
{
    use HasFactory;

    protected $table = 'purchased';

    protected $fillable = [
        'order_id',
        'user_id',
        'meal_kit_id',
        'quantity',
        'price_at_purchased',
        'ordered_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'meal_kit_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
