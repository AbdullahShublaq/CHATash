<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class PrivateRoom extends Model
{
    use Sluggable;
    //
    protected $fillable = ['name', 'slug'];
    protected $appends = ['path', 'participants', 'participantsCount'];

    public function getPathAttribute(): string
    {
        return $this->path();
    }
    public function getParticipantsAttribute(){
//        $users = [];
//        foreach ($participants as $participant){
//            array_push($users, $participant->user()->first());
//        }
        return $this->participants()->get();
    }
    public function getParticipantsCountAttribute(): int
    {
        return $this->participants()->count();
    }

    public function path(): string
    {
        return "/private/{$this->slug}";
    }

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function participants(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'private_room_participants');
    }

    public function messages(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
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
