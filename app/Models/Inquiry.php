<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    use HasFactory;
    protected $table = 'inquiry';

    protected $fillable = [
        'thread_id',
        'sender_id',
        'sender_type',//distinguish user,admin,restaurant
        'recipient_id',
        'recipient_type',
        'subject',
        'message',
        'status',
        'order_id',
        'reservation_id',
    ];
    public function recipient(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'recipient_id');
    }
}
