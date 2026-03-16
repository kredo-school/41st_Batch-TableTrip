<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable =[
        'user_id', 
        'card_number', 
        'card_name', 
        'expiry_date', 
        'security_code', 
        'is_default'
    ];
    // encrypted
    protected $casts =[
        'card_number' => 'encrypted',
        'security_code' => 'encrypted',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

}

