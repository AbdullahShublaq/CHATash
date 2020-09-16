<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class PrivateRoom extends Model
{
    use Sluggable;
    //
    protected $fillable = ['name', 'slug'];
    protected $appends = ['path', 'participants', 'participantsCount'];

    public function getPathAttribute(){
        return $this->path();
    }
    public function getParticipantsAttribute(){
        $participants = $this->participants()->get();
//        $users = [];
//        foreach ($participants as $participant){
//            array_push($users, $participant->user()->first());
//        }
        return $participants;
    }
    public function getParticipantsCountAttribute(){
        return $this->participants()->count();
    }

    public function path()
    {
        return "/private/{$this->slug}";
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'private_room_participants');
    }

    public function messages()
    {
        return $this->belongsToMany(User::class, 'private_room_messages');
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
