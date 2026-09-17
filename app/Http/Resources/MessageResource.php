<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'user_avatar' => $this->user->avatar,
            'message' => $this->message,
            'reply_to' => $this->reply_to,
            'key_version' => $this->key_version,
            'time' => $this->created_at->diffForHumans(),
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
