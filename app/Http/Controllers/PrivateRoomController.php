<?php

namespace App\Http\Controllers;

use App\PrivateRoom;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PrivateRoomController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rooms = auth()->user()->accessiblePrivateRooms();
        return view('rooms.private.index', compact('rooms'));
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
     * @return array
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' => 'required|string|max:15',
        ]);

        $room = auth()->user()->rooms()->create([
            'name' => $data['name'],
//            'slug' => Str::slug($data['name'])
        ]);

        $room->participants()->attach(auth()->user());

        if ($request->wantsJson()) {
            return ['message' => $room->path()];
        }

        return redirect($room->path());
    }

    public function addParticipant(Request $request)
    {
        $data = $request->validate([
            'private_room_id' => 'required|exists:private_rooms,id',
            'email' => 'required|string|email',
        ]);

        $user = User::where('email', $data['email'])->first();
        $room = PrivateRoom::where('id', $data['private_room_id'])->first();
        $room->participants()->attach($user);

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param PrivateRoom $privateRoom
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(PrivateRoom $privateRoom)
    {
        //
        $this->authorize('view', $privateRoom);
        return view('rooms.private.show', compact('privateRoom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
