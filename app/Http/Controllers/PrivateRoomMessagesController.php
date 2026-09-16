<?php

namespace App\Http\Controllers;

use App\Events\PrivateRoomMessageCreated;
use App\Events\PrivateRoomMessageDeleted;
use App\Http\Resources\MessageResource;
use App\Models\PrivateRoomMessage;
use Illuminate\Http\Request;

class PrivateRoomMessagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        //
        $result = [];
        $data = PrivateRoomMessage::where('private_room_id', $request->private_room_id)->with('user')->get();
        foreach ($data as $row) {
            array_push($result, MessageResource::make($row));
        }

        return $result;
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
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'reply_to_id' => 'nullable|exists:private_room_messages,id'
        ]);

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
            'private_room_id' => $data['private_room_id'],
            'user_id' => $data['user_id'],
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

        if ($message->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, 'You are not allowed to delete this message.');
        }

        $message->delete();

        event(new PrivateRoomMessageDeleted($message->id, $message->private_room_id));
    }
}
