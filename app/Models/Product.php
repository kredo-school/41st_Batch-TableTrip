<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    protected $fillable = ['image', 'name', 'category_id', 'restaurant_name', 'location', 'price', 'ingredients', 'allergens', 'description', 'badge', 'tag'];

    public function category(){
        return $this->hasMany(Category::class);
    }

    public function images(){
        return $this->hasMany(AbleImage::class,'target_id')
        ->where('target_type','product')
        ->orderBy('display_order');
    }
}
 