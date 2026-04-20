<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

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
        'is_read',
        'status',
    ];

    // --- Relationships ---

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Review::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Review::class, 'parent_id');
    }

    // --- AI/Bad word check logic ---

    protected static function booted()
    {
        static::creating(function ($review) {
            $badWords = [
                'stupid', 'idiot', 'hate', 'damn', 'sex', 
                'xxx', 'spam', 'http', 'www',
            ];

            $comment = strtolower($review->comment ?? '');

            foreach ($badWords as $word) {
                if (str_contains($comment, $word)) {
                    $review->status = 'hidden';
                    return;
                }
            }

            $review->status = 'visible';
        });
    }
}