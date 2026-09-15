@extends('layouts.app')

@section('content')
    <div class="relative w-full mx-auto px-4 md:px-8 lg:px-16 py-10 md:py-14">
        <div class="text-center mb-10 md:mb-14">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold tracking-tight">Welcome,
                <span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent">{{ auth()->user()->name }}</span>
            </h1>
        </div>
        <div class="flex flex-wrap justify-center gap-6 md:gap-8 w-full">
            <div class="w-full sm:w-80">
                <a href="/public" class="block h-full group">
                    <div class="flex flex-col card p-8 items-center text-center h-full transition group-hover:-translate-y-1 group-hover:shadow-2xl group-hover:shadow-indigo-950/10">
                        <div class="w-20 h-20 md:w-24 md:h-24 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 shadow-lg shadow-indigo-500/30 flex items-center justify-center">
                            <svg viewBox="0 0 16 16" class="w-10 h-10 md:w-12 md:h-12 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4H2.255a7.025 7.025 0 0 1 3.072-2.472 6.7 6.7 0 0 0-.597.933c-.247.464-.462.98-.64 1.539zm-.582 3.5h-2.49c.062-.89.291-1.733.656-2.5H3.82a13.652 13.652 0 0 0-.312 2.5zM4.847 5H7.5v2.5H4.51A12.5 12.5 0 0 1 4.846 5zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5H7.5V11H4.847a12.5 12.5 0 0 1-.338-2.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12H7.5v2.923c-.67-.204-1.335-.82-1.887-1.855A7.97 7.97 0 0 1 5.145 12zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11H1.674a6.958 6.958 0 0 1-.656-2.5h2.49c.03.877.138 1.718.312 2.5zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12h2.355a7.967 7.967 0 0 1-.468 1.068c-.552 1.035-1.218 1.65-1.887 1.855V12zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5h-2.49A13.65 13.65 0 0 0 12.18 5h2.146c.365.767.594 1.61.656 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4H8.5V1.077c.67.204 1.335.82 1.887 1.855.173.324.33.682.468 1.068z"></path>
                            </svg>
                        </div>
                        <h2 class="font-semibold font-mono text-2xl mt-6 text-slate-800">Public Rooms</h2>
                        <span class="text-sm mt-2 text-slate-500 font-light">Join the public chat room</span>
                    </div>
                </a>
            </div>
            <div class="w-full sm:w-80">
                <a href="/private" class="block h-full group">
                    <div class="flex flex-col card p-8 items-center text-center h-full transition group-hover:-translate-y-1 group-hover:shadow-2xl group-hover:shadow-indigo-950/10">
                        <div class="w-20 h-20 md:w-24 md:h-24 rounded-2xl bg-gradient-to-br from-indigo-600 to-purple-600 shadow-lg shadow-indigo-500/30 flex items-center justify-center">
                            <svg viewBox="0 0 16 16" class="w-10 h-10 md:w-12 md:h-12 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
                            </svg>
                        </div>
                        <h2 class="font-semibold font-mono text-2xl mt-6 text-slate-800">Private Rooms</h2>
                        <span class="text-sm mt-2 text-slate-500 font-light">Create or join private chat rooms</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection