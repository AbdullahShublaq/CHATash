@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap mx-auto px-4 md:mx-64">
        <div class="items-center my-12 w-full">
            <div class="justify-start mb-2">
                <a href="/home" class="flex items-center text-blue-500 font-semibold font-mono">
                    <svg viewBox="0 0 16 16" class="w-5 h-5 bi bi-globe" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
                    </svg>
                    back
                </a>
            </div>
            <div class="flex justify-between w-full items-end">
                <h2 class="text-gray-600 text-lg font-semibold">My PrivateRooms</h2>
                <a href="/projects/create" class="bg-blue-400 text-white rounded-lg py-2 px-4"
                   @click.prevent="$modal.show('new-room')">Create room</a>
            </div>
        </div>
        <div class="flex justify-between flex-wrap border border-gray-400 rounded-lg w-full p-4 overflow-auto mb-8"
             style="max-height: calc(100vh - 56px - 80px - 80px)">
            @forelse($rooms as $room)
                <private-room-card :room="{{$room}}"></private-room-card>
            @empty
                <h1 class="text-center w-full text-sm font-mono text-blue-900 font-semibold">There no rooms</h1>
            @endforelse
        </div>
    </div>

    <new-room-modal></new-room-modal>

@endsection