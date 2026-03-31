<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

        protected $table = 'purchased';

    protected $fillable = [
        'user_id', 
        'meal_kit_id', 
        'quantity', 
        'price_at_purchased', 
        'ordered_at'
    ];

    public function product()
    {
        
        return $this->belongsTo(Product::class, 'meal_kit_id');
    }
}

//     protected $fillable = [
//         'user_id',
//         'restaurant_id',
//         'total_price',
//         'status',
//         'created_at'
//     ];
// }
