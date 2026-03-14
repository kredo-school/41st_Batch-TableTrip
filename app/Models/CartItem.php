<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class CartItem extends Model
{
    protected $table = 'cart_items'; 

    protected $fillable = ['user_id', 'product_id', 'quantity'];
}