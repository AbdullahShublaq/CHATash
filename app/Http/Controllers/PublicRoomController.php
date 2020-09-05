<?php

namespace App\Http\Controllers;

use App\Events\PublicRoomMessageCreated;
use App\PublicRoom;
use Illuminate\Http\Request;

class PublicRoomController extends Controller
{
    public function FormateMessage($message)
    {
        $temp = [];
        $temp['user_id'] = $message->user_id;
        $temp['user_name'] = $message->user->name;
        $temp['user_avatar'] = $message->user->avatar;
        $temp['message'] = $message->message;
        $temp['time'] = $message->created_at->diffForHumans();
        return $temp;
    }

    public function messages()
    {
        $result = [];
        $data = PublicRoom::with('user')->get();
        foreach ($data as $row) {
            array_push($result, $this->FormateMessage($row));
        }

        return $result;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('rooms.public');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);

        $message = PublicRoom::create([
            'user_id' => $data['user_id'],
            'message' => $data['message']
        ]);

        event(new PublicRoomMessageCreated($this->FormateMessage($message)));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PublicRoom $publicRoom
     * @return \Illuminate\Http\Response
     */
    public function show(PublicRoom $publicRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PublicRoom $publicRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(PublicRoom $publicRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\PublicRoom $publicRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PublicRoom $publicRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PublicRoom $publicRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(PublicRoom $publicRoom)
    {
        //
    }
}
