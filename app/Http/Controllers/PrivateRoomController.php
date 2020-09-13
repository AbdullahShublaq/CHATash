<?php

namespace App\Http\Controllers;

use App\PrivateRoom;
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

        if ($request->wantsJson()) {
            return ['message' => $room->path()];
        }

        return redirect($room->path());
    }

    /**
     * Display the specified resource.
     *
     * @param PrivateRoom $privateRoom
     * @return void
     */
    public function show(PrivateRoom $privateRoom)
    {
        //
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
