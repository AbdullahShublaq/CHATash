<?php

namespace App\Http\Controllers;

use App\Events\PrivateRoomMessageCreated;
use App\Http\Resources\MessageResource;
use App\PrivateRoomMessage;
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
            'message' => 'required|string'
        ]);

        $message = PrivateRoomMessage::create([
            'private_room_id' => $data['private_room_id'],
            'user_id' => $data['user_id'],
            'message' => $data['message']
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
    }
}
