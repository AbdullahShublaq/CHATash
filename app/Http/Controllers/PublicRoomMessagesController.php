<?php

namespace App\Http\Controllers;

use App\Events\PublicRoomMessageCreated;
use App\Events\PublicRoomMessageDeleted;
use App\Http\Resources\MessageResource;
use App\Models\PublicRoomMessage;
use App\Services\RoomKeyService;
use Illuminate\Http\Request;

class PublicRoomMessagesController extends Controller
{
    private const int PAGE_SIZE = 100;

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(Request $request)
    {
        //
        $result = [];
        $data = PublicRoomMessage::with('user')
            ->when($request->filled('before'), function ($query) use ($request) {
                $query->where('created_at', '<', $request->input('before'));
            })
            ->latest()
            ->limit(self::PAGE_SIZE)
            ->get()
            ->reverse()
            ->values();
        foreach ($data as $row) {
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
            'message' => 'required|string|max:5000',
            'reply_to_id' => 'nullable|exists:public_room_messages,id'
        ]);

        $replyTo = null;
        if (!empty($data['reply_to_id'])) {
            $replied = PublicRoomMessage::with('user')->find($data['reply_to_id']);
            $replyTo = [
                'id' => $replied->id,
                'user_name' => $replied->user->name,
                'message' => $replied->message,
            ];
        }

        $message = PublicRoomMessage::create([
            'user_id' => auth()->id(),
            'message' => $data['message'],
            'reply_to_id' => $data['reply_to_id'] ?? null,
            'reply_to' => $replyTo,
            'key_version' => app(RoomKeyService::class)->version(),
        ]);

        event(new PublicRoomMessageCreated(MessageResource::make($message)));
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
        $message = PublicRoomMessage::findOrFail($id);

        if ($message->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, 'You are not allowed to delete this message.');
        }

        $message->delete();

        event(new PublicRoomMessageDeleted($message->id));
    }
}
