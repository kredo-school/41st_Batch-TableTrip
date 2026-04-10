<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbleImage extends Model
{
    protected $fillable = [
        'target_id',
        'target_type',
        'image_url',
        'display_order',
    ];
    
    public function target()
    {
        return $this->morphTo();
    }
}
