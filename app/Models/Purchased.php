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
        'product_id',
        'quantity',
        'price_at_purchased',
        'ordered_at',
        'status',
        'order_id'
    ];

    protected $casts = [
        'ordered_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');

        return $this->belongsTo(Product::class, 'product_id');
    }
}
