<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

<<<<<<< HEAD
=======
// クラス名をコントローラーの呼び出し（Purchased）に合わせる
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

>>>>>>> 775594f6f8b2f6e3709b9bd2ceddaaa2c756ab32
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
