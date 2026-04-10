<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerInquiry extends Model
{
    protected $table = 'inquiries';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];

    public function replies()
    {
        return $this->hasMany(Reply::class, 'inquiry_id');
    }
}
