<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class PrivateRoom extends Model
{
    use Sluggable;
    //
    protected $fillable = ['name', 'slug'];

    public function path()
    {
        return "/private/{$this->slug}";
    }

    public function participants() {
        return $this->hasMany(PrivateRoomParticipant::class);
    }

    public function messages(){
        return $this->hasMany(PrivateRoomMessage::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
