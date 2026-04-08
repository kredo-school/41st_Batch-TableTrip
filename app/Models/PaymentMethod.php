<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'paymentmethod';

    protected $fillable = [
    'user_id',
    'stripe_id',
    'gateway_token',
    'brand',
    'last4',
    'exp_month',
    'exp_year',
    'is_default',
];
public function user()
{
    return $this->belongsTo(User::class);
}

}
