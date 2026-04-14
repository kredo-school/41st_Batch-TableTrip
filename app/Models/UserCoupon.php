<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserCoupon extends Model
{
    use HasFactory;

    protected $table = 'user_coupons';

    protected $fillable = [
        'user_id',
        'coupon_id',
        'is_used',
        'used_at',
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}