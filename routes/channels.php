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

$userPayload = fn ($user) => [
    'id' => $user->id,
    'name' => $user->name,
    'avatar' => $user->avatar,
];

Broadcast::channel('messages', function ($user) use ($userPayload) {
//    return (int) $user->id === (int) $id;
    return ['user' => $userPayload($user)];
});

Broadcast::channel('messages.{roomId}', function ($user, $id) use ($userPayload) {
//    return (int) $user->id === (int) $id;
    if ($user->is_admin || $user->accessiblePrivateRooms()->contains('id', $id)) {
        return ['user' => $userPayload($user)];
    }

    abort(403, 'You are not allowed to access this room.');
});
