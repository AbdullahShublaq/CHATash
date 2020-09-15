<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('messages', function ($user) {
//    return (int) $user->id === (int) $id;
    return ['user' => $user];
});

Broadcast::channel('messages.{roomId}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
    if($user->accessiblePrivateRooms()->contains($id)){
        return ['user' => $user];
    }
});
