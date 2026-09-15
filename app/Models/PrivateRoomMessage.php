<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivateRoomMessage extends Model
{
    //
    protected $fillable = ['user_id', 'private_room_id', 'message'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function private_room(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PrivateRoom::class);
    }
}
