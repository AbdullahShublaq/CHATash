<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicRoomMessage extends Model
{
    //
    protected $fillable = ['user_id', 'message'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
