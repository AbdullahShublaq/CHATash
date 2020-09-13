<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivateRoomMessage extends Model
{
    //
    protected $fillable = ['user_id', 'private_room_id', 'message'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function private_room(){
        return $this->belongsTo(PrivateRoom::class);
    }
}
