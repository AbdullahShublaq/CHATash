<?php

namespace App\Http\Controllers;

use App\Events\PrivateRoomMessageCreated;
use App\Events\PrivateRoomMessageDeleted;
use App\Http\Resources\MessageResource;
use App\Models\PrivateRoom;
use App\Models\PrivateRoomMessage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PrivateRoomMessagesController extends Controller
{
    private const int PAGE_SIZE = 100;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        //
        $data = $request->validate([
            'private_room_id' => 'required|exists:private_rooms,id'
        ]);

        $room = PrivateRoom::findOrFail($data['private_room_id']);
        $this->ensureUserCanAccessRoom($room);

        $result = [];
        $messages = PrivateRoomMessage::where('private_room_id', $request->private_room_id)
            ->with('user')
            ->when($request->filled('before'), function ($query) use ($request) {
                $query->where('created_at', '<', $request->input('before'));
            })
            ->latest()
            ->limit(self::PAGE_SIZE)
            ->get()
            ->reverse()
            ->values();
        foreach ($messages as $row) {
            array_push($result, MessageResource::make($row));
        }

        return response($result)->header('X-Has-More', count($result) === self::PAGE_SIZE ? 'true' : 'false');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'private_room_id' => 'required|exists:private_rooms,id',
            'message' => 'required|string|max:1000',
            'reply_to_id' => ['nullable', Rule::exists('private_room_messages', 'id')->where(function ($query) use ($request) {
                $query->where('private_room_id', $request->input('private_room_id'));
            })],
        ]);

        $room = PrivateRoom::findOrFail($data['private_room_id']);
        $this->ensureUserCanAccessRoom($room);

        $replyTo = null;
        if (!empty($data['reply_to_id'])) {
            $replied = PrivateRoomMessage::with('user')->find($data['reply_to_id']);
            $replyTo = [
                'id' => $replied->id,
                'user_name' => $replied->user->name,
                'message' => $replied->message,
            ];
        }

        $message = PrivateRoomMessage::create([
            'private_room_id' => $room->id,
            'user_id' => auth()->id(),
            'message' => $data['message'],
            'reply_to_id' => $data['reply_to_id'] ?? null,
            'reply_to' => $replyTo,
        ]);

        event(new PrivateRoomMessageCreated(MessageResource::make($message)));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $message = PrivateRoomMessage::findOrFail($id);

        $this->ensureUserCanAccessRoom($message->private_room);

        if ($message->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, 'You are not allowed to delete this message.');
        }

        $message->delete();

        event(new PrivateRoomMessageDeleted($message->id, $message->private_room_id));
    }

    private function ensureUserCanAccessRoom(PrivateRoom $room): void
    {
        if (!auth()->user()->accessiblePrivateRooms()->contains('id', $room->id)) {
            abort(403, 'You are not allowed to access this room.');
        }
    }
}
