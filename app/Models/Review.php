<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'rating',
        'comment',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    protected static function booted()
    {
        static::creating(function ($review) {
            $badWords = [
                'stupid',
                'idiot',
                'hate',
                'damn',
                'sex',
                'xxx',
                'spam',
                'http',
                'www',
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