<?php

namespace App\Http\Controllers;

use App\Events\PublicRoomMessageCreated;
use App\Events\PublicRoomMessageDeleted;
use App\Http\Resources\MessageResource;
use App\Models\PublicRoomMessage;
use Illuminate\Http\Request;

class PublicRoomMessagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        //
        $result = [];
        $data = PublicRoomMessage::with('user')->get();
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
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);

        $message = PublicRoomMessage::create([
            'user_id' => $data['user_id'],
            'message' => $data['message']
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
