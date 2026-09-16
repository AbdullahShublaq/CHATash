<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

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
        'is_admin' => 'boolean',
    ];

    protected $appends = ['avatar', 'active'];
    public function getAvatarAttribute(): string
    {
        return "https://api.dicebear.com/10.x/pixel-art/svg?seed=".urlencode($this->name);
    }
    public function getActiveAttribute(): false
    {
        return false;
    }

    public function rooms()
    {
        return $this->hasMany(PrivateRoom::class, 'owner_id');
    }

    public function accessiblePrivateRooms()
    {
        if ($this->is_admin) {
            return PrivateRoom::all();
        }

        return PrivateRoom::where('owner_id', $this->id)
            ->orWhereHas('participants', function ($query) {
                $query->where('user_id', $this->id);
            })->get();
    }
}