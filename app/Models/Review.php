<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\Product;

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
