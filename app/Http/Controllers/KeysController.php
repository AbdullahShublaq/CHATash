<?php

namespace App\Http\Controllers;

use App\Models\PrivateRoom;
use App\Models\User;
use App\Services\RoomKeyService;
use Illuminate\Http\Request;

class KeysController extends Controller
{
    public function publish(Request $request)
    {
        $data = $request->validate([
            'public_key' => 'required|string|max:200|regex:/^[A-Za-z0-9+\/]+={0,2}$/',
        ]);

        $user = auth()->user();
        $user->public_key = $data['public_key'];
        $user->save();

        return ['ok' => true];
    }

    public function publicRoomKey(RoomKeyService $keys)
    {
        $current = $keys->current();
        return ['key' => $current['key'], 'version' => (int) $current['version']];
    }

    public function publicRoomKeyHistory(RoomKeyService $keys)
    {
        return $keys->history();
    }

    public function rotatePublicRoomKey(Request $request, RoomKeyService $keys)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Only admins can rotate the public room key.');
        }

        $current = $keys->rotate();
        return ['key' => $current['key'], 'version' => (int) $current['version']];
    }

    public function directory(Request $request)
    {
        $data = $request->validate([
            'private_room_id' => 'required|exists:private_rooms,id',
        ]);

        $room = PrivateRoom::findOrFail($data['private_room_id']);

        if (!auth()->user()->accessiblePrivateRooms()->contains('id', $room->id)) {
            abort(403, 'You are not allowed to access this room.');
        }

        $ids = $room->participants()->pluck('users.id')
            ->push($room->owner_id)
            ->merge(User::where('is_admin', true)->pluck('id'))
            ->unique()
            ->values()
            ->all();

        return User::whereIn('id', $ids)->get(['id', 'public_key']);
    }
}