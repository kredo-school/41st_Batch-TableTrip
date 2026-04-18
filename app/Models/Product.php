<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Restaurant;

class Product extends Model
{
    protected $fillable = ['image', 'name', 'category_id', 'restaurant_name', 'location', 'price', 'ingredients', 'allergens', 'description', 'badge', 'tag'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images(){
        return $this->hasMany(AbleImage::class,'target_id')
        ->where('target_type','product')
        ->orderBy('display_order');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
 