<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrefectureStamp extends Model
{
    use HasFactory;

    protected $table = 'prefecture_stamps';

    protected $fillable = [
        'user_id',
        'prefecture',
        'earned_at',
    ];

    protected $casts = [
        'earned_at' => 'datetime',
    ];
}