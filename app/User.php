<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['avatar'];
    public function getAvatarAttribute() {
        return "https://avatars.dicebear.com/v2/gridy/".crypt($this->email, 'st').".svg";
    }

    public function rooms()
    {
        return $this->hasMany(PrivateRoom::class, 'owner_id');
    }

    public function accessiblePrivateRooms()
    {
        return PrivateRoom::where('owner_id', $this->id)
            ->orWhereHas('participants', function ($query) {
                $query->where('user_id', $this->id);
            })->get();
    }
}
