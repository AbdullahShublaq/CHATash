<?php

namespace App\Http\Controllers;

use App\Models\PublicRoomMessage;
use Illuminate\Http\Request;

class PublicRoomController extends Controller
{
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PublicRoomMessage $publicRoom
     * @return \Illuminate\Http\Response
     */
    public function show(PublicRoomMessage $publicRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PublicRoomMessage $publicRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(PublicRoomMessage $publicRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\PublicRoomMessage $publicRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PublicRoomMessage $publicRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PublicRoomMessage $publicRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(PublicRoomMessage $publicRoom)
    {
        //
    }
}
