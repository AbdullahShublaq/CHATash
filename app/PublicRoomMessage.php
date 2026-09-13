<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PublicRoomMessage extends Model
{
    //
    protected $fillable = ['user_id', 'message'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
