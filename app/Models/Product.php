<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['image', 'name', 'category_id', 'restaurant_name', 'location', 'price', 'ingredients', 'allergens', 'description', 'badge', 'tag'];
}
 