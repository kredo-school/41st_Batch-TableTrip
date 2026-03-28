<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inquiry extends Model
{
    use HasFactory;
    protected $table = 'inquiry';

    protected $fillable = [
        'thread_id',
        'sender_id',
        'sender_type',
        'recipient_id',
        'recipient_type',
        'subject',
        'message',
        'status',
        'order_id',
        'reservation_id',
    ];
}
