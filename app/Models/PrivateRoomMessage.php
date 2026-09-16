<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PrivateRoomMessage extends Model
{
    use HasUuids;
    //
    protected $fillable = ['user_id', 'private_room_id', 'message', 'reply_to_id', 'reply_to'];
    protected $casts = ['reply_to' => 'array'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function private_room(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PrivateRoom::class);
    }
}
