<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{

    use HasFactory;

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
