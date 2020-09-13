@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap mx-auto px-4 md:mx-64">
        <div class="flex items-center my-12 w-full">
            <div class="flex justify-between w-full items-end">
                <h2 class="text-gray-600 text-lg font-semibold">My PrivateRooms</h2>
                <a href="/projects/create" class="bg-blue-400 text-white rounded-lg py-2 px-4"
                   @click.prevent="$modal.show('new-room')">Create room</a>
            </div>
        </div>
        <div class="flex justify-between flex-wrap border border-gray-400 rounded-lg w-full p-4 overflow-auto mb-8"
             style="max-height: calc(100vh - 56px - 80px - 80px)">
            @forelse($rooms as $room)
                <a href="{{$room->path()}}">
                    <div class="flex m-4 flex-col bg-white rounded-lg py-8 px-12 items-center shadow-lg border hover:border-blue-900">
                        <h3 class="font-light font-mono text-lg text-blue-900">{{$room->name}}</h3>
                        <div class="flex justify-center w-full mt-3">
                            <div class="flex items-center mx-2">
                                <svg viewBox="0 0 16 16" color="#2a4365" class="w-5 h-5 bi bi-globe opacity-50"
                                     fill="currentColor"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"></path>
                                </svg>
                                <span class="font-semibold font-mono text-blue-900 ml-1">{{$room->participants()->count()}}</span>
                            </div>
                            <div class="flex items-center mx-2">
                                <svg viewBox="0 0 16 16" class="text-green-500 w-5 h-5 bi bi-globe" fill="currentColor"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                                </svg>
                                <span class="font-semibold font-mono text-green-500 ml-1">0</span>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <h1 class="text-center w-full text-sm font-mono text-blue-900 font-semibold">There no rooms</h1>
            @endforelse
        </div>
    </div>

    <new-room-modal></new-room-modal>

@endsection