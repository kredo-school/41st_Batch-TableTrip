<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchased extends Model
{
    use HasFactory;

    protected $table = 'purchased';


    protected $table = 'purchased';

    protected $fillable = [
        'user_id',
        'meal_kit_id',
        'quantity',
        'total_price',
        'ordered_at',
        'status'
    ];

    protected $casts = [
        'ordered_at' => 'datetime',
    ];

    
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
        'price_at_purchased',
        'ordered_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'meal_kit_id');
    }
}
