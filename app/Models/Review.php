<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'restaurant_id',
        'user_id',
        'product_id',
        'parent_id',
        'author_type',
        'comment_type',
        'rating',
        'comment',
        'is_approved',
        'ai_score',
        'is_read'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Review::class, 'parent_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
