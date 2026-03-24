<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

// class Order extends Model
// {
//     protected $fillable = [
//         'user_id',
//         'restaurant_id',
//         'total_price',
//         'status',
//         'created_at'
//     ];
// }
