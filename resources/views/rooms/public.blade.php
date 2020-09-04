@extends('layouts.app')

@section('content')
    <div id="body" class="flex flex-wrap h-full" style="height: calc(100vh - 56px)">
        {{--start-activatedUser-side--}}
        <div class="flex flex-col w-full lg:w-1/4">
            <div id="activated-header" class="flex items-center justify-start text-blue-500 shadow-lg w-full py-4 px-4">
                <div class="flex items-center w-full justify-between">
                    <div class="flex items-center pl-4">
                        <svg viewBox="0 0 16 16" color="#63b3ed" class="w-6 h-6 bi bi-globe opacity-20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"></path>
                        </svg>
                        <h1 class="text-xl font-semibold font-mono ml-2">
                            Current
                            <span class="rounded-full p-2 text-xs bg-blue-400 text-white">100</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div id="activated-body" class="overflow-y-scroll py-2 px-2" style="height: calc(100vh - 56px - 57px); max-height: calc(100vh - 56px - 57px)">
                <div class="flex flex-col rounded-lg shadow-lg items-start bg-white p-2 text-blue-500">
                    <div class="flex items-center my-2 w-full pb-2 pl-2 border-b">
                        <img class="w-10 h-10 rounded-full"
                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                             alt="avatar">
                        <span class="text-lg pr-4 ml-2 break-words">
                            {{ Auth::user()->name }}
                        </span>
                    </div>
                    <div class="flex items-center my-2 w-full pb-2 pl-2 border-b">
                        <img class="w-10 h-10 rounded-full"
                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                             alt="avatar">
                        <span class="text-lg pr-4 ml-2 break-words">
                            {{ Auth::user()->name }}
                        </span>
                    </div>
                    <div class="flex items-center my-2 w-full pb-2 pl-2 border-b">
                        <img class="w-10 h-10 rounded-full"
                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                             alt="avatar">
                        <span class="text-lg pr-4 ml-2 break-words">
                            {{ Auth::user()->name }}
                        </span>
                    </div>
                    <div class="flex items-center my-2 w-full pb-2 pl-2 border-b">
                        <img class="w-10 h-10 rounded-full"
                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                             alt="avatar">
                        <span class="text-lg pr-4 ml-2 break-words">
                            {{ Auth::user()->name }}
                        </span>
                    </div>
                    <div class="flex items-center my-2 w-full pb-2 pl-2 border-b">
                        <img class="w-10 h-10 rounded-full"
                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                             alt="avatar">
                        <span class="text-lg pr-4 ml-2 break-words">
                            {{ Auth::user()->name }}
                        </span>
                    </div>
                    <div class="flex items-center my-2 w-full pb-2 pl-2 border-b">
                        <img class="w-10 h-10 rounded-full"
                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                             alt="avatar">
                        <span class="text-lg pr-4 ml-2 break-words">
                            {{ Auth::user()->name }}
                        </span>
                    </div>
                    <div class="flex items-center my-2 w-full pb-2 pl-2 border-b">
                        <img class="w-10 h-10 rounded-full"
                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                             alt="avatar">
                        <span class="text-lg pr-4 ml-2 break-words">
                            {{ Auth::user()->name }}
                        </span>
                    </div>
                    <div class="flex items-center my-2 w-full pb-2 pl-2 border-b">
                        <img class="w-10 h-10 rounded-full"
                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                             alt="avatar">
                        <span class="text-lg pr-4 ml-2 break-words">
                            {{ Auth::user()->name }}
                        </span>
                    </div>
                    <div class="flex items-center my-2 w-full pb-2 pl-2 border-b">
                        <img class="w-10 h-10 rounded-full"
                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                             alt="avatar">
                        <span class="text-lg pr-4 ml-2 break-words">
                            {{ Auth::user()->name }}
                        </span>
                    </div>
                    <div class="flex items-center my-2 w-full pb-2 pl-2 border-b">
                        <img class="w-10 h-10 rounded-full"
                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                             alt="avatar">
                        <span class="text-lg pr-4 ml-2 break-words">
                            {{ Auth::user()->name }}
                        </span>
                    </div>
                    <div class="flex items-center my-2 w-full pb-2 pl-2 border-b">
                        <img class="w-10 h-10 rounded-full"
                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                             alt="avatar">
                        <span class="text-lg pr-4 ml-2 break-words">
                            {{ Auth::user()->name }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        {{--end-activatedUser-side--}}

        {{--start-messages-side--}}
        <div class="flex flex-col w-full lg:w-3/4">
            <div id="room-header" class="flex items-center justify-between bg-blue-400 z-10 shadow-lg w-full py-4 px-6">
                <div class="flex items-center">
                    <svg viewBox="0 0 16 16" color="#FFF" class="w-6 h-6 bi bi-globe opacity-20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4H2.255a7.025 7.025 0 0 1 3.072-2.472 6.7 6.7 0 0 0-.597.933c-.247.464-.462.98-.64 1.539zm-.582 3.5h-2.49c.062-.89.291-1.733.656-2.5H3.82a13.652 13.652 0 0 0-.312 2.5zM4.847 5H7.5v2.5H4.51A12.5 12.5 0 0 1 4.846 5zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5H7.5V11H4.847a12.5 12.5 0 0 1-.338-2.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12H7.5v2.923c-.67-.204-1.335-.82-1.887-1.855A7.97 7.97 0 0 1 5.145 12zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11H1.674a6.958 6.958 0 0 1-.656-2.5h2.49c.03.877.138 1.718.312 2.5zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12h2.355a7.967 7.967 0 0 1-.468 1.068c-.552 1.035-1.218 1.65-1.887 1.855V12zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5h-2.49A13.65 13.65 0 0 0 12.18 5h2.146c.365.767.594 1.61.656 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4H8.5V1.077c.67.204 1.335.82 1.887 1.855.173.324.33.682.468 1.068z"></path>
                    </svg>
                    <h1 class="text-xl text-white font-mono ml-2">Public Room</h1>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center rounded rounded-lg font-semibold text-sm text-white bg-red-500 px-2 py-1">
                        Leave
                        <svg viewBox="0 0 16 16" class="ml-1 w-4 h-4 bi bi-globe opacity-20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div id="room-messages" class="overflow-auto bg-white" style="height: calc(100vh - 56px - 56px - 58px); max-height: calc(100vh - 56px - 56px - 58px)">
                <div class="flex flex-col p-2">
                    <div class="flex justify-start my-2">
                        <img class="w-10 h-10 rounded-full"
                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                             alt="avatar"
                             title="{{ Auth::user()->name }}">
                        <div class="flex flex-col rounded-tl-none rounded-lg w-full md:w-auto md:max-w-lg ml-2 bg-gray-200 p-4">
                            <p class="leading-normal text-sm mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur corporis delectus dicta, dolore exercitationem iure labore laudantium omnis, quasi sapiente, tempora unde? Aperiam cum earum expedita id laborum mollitia odit?</p>
                            <span class="text-xs text-gray-600 font-light">3 mins ago</span>
                        </div>
                    </div>
                    <div class="flex justify-start my-2">
                        <img class="w-10 h-10 rounded-full"
                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                             alt="avatar"
                             title="{{ Auth::user()->name }}">
                        <div class="flex flex-col rounded-tl-none rounded-lg w-full md:w-auto md:max-w-lg ml-2 bg-gray-200 p-4">
                            <p class="leading-normal text-sm mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur corporis delectus dicta, dolore exercitationem iure labore laudantium omnis, quasi sapiente, tempora unde? Aperiam cum earum expedita id laborum mollitia odit?</p>
                            <span class="text-xs text-gray-600 font-light">3 mins ago</span>
                        </div>
                    </div>
                    <div class="flex justify-end my-2">
                        <div class="flex flex-col rounded-tr-none rounded-lg w-full md:w-auto md:max-w-lg ml-2 bg-blue-500 p-4">
                            <p class="leading-normal text-sm text-white mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur corporis delectus dicta, dolore exercitationem iure labore laudantium omnis, quasi sapiente, tempora unde? Aperiam cum earum expedita id laborum mollitia odit?</p>
                            <span class="text-xs text-gray-300 font-light">3 mins ago</span>
                        </div>
                    </div>
                    <div class="flex justify-start my-2">
                        <img class="w-10 h-10 rounded-full"
                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                             alt="avatar"
                             title="{{ Auth::user()->name }}">
                        <div class="flex flex-col rounded-tl-none rounded-lg w-full md:w-auto md:max-w-lg ml-2 bg-gray-200 p-4">
                            <p class="leading-normal text-sm mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur corporis delectus dicta, dolore exercitationem iure labore laudantium omnis, quasi sapiente, tempora unde? Aperiam cum earum expedita id laborum mollitia odit?</p>
                            <span class="text-xs text-gray-600 font-light">3 mins ago</span>
                        </div>
                    </div>
                    <div class="flex justify-start my-2">
                        <img class="w-10 h-10 rounded-full"
                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                             alt="avatar"
                             title="{{ Auth::user()->name }}">
                        <div class="flex flex-col rounded-tl-none rounded-lg w-full md:w-auto md:max-w-lg ml-2 bg-gray-200 p-4">
                            <p class="leading-normal text-sm mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur corporis delectus dicta, dolore exercitationem iure labore laudantium omnis, quasi sapiente, tempora unde? Aperiam cum earum expedita id laborum mollitia odit?</p>
                            <span class="text-xs text-gray-600 font-light">3 mins ago</span>
                        </div>
                    </div>
                    <div class="flex justify-end my-2">
                        <div class="flex flex-col rounded-tr-none rounded-lg w-full md:w-auto md:max-w-lg ml-2 bg-blue-500 p-4">
                            <p class="leading-normal text-sm text-white mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur corporis delectus dicta, dolore exercitationem iure labore laudantium omnis, quasi sapiente, tempora unde? Aperiam cum earum expedita id laborum mollitia odit?</p>
                            <span class="text-xs text-gray-300 font-light">3 mins ago</span>
                        </div>
                    </div>
                    <div class="flex justify-start my-2">
                        <img class="w-10 h-10 rounded-full"
                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                             alt="avatar"
                             title="{{ Auth::user()->name }}">
                        <div class="flex flex-col rounded-tl-none rounded-lg w-full md:max-w-1/2 md:w-auto ml-2 bg-gray-200 p-4">
                            <p class="leading-normal text-sm mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <span class="text-xs text-gray-600 font-light">3 mins ago</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="room-footer" class="flex items-center justify-between bg-gray-300 w-full py-2 px-6">
                <textarea class="rounded rounded-lg w-full px-4 py-2 form-input" name="message" rows="1" placeholder="Enter your message..."></textarea>
                <button class="flex items-center rounded rounded-lg text-white text-sm font-semibold font-mono ml-16 bg-blue-500 py-2 px-4">
                    Send
                    <svg viewBox="0 0 16 16" class="ml-1 w-3 h-3 bi bi-globe opacity-20" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"></path>
                        <path fill-rule="evenodd"
                              d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"></path>
                    </svg>
                </button>
            </div>
        </div>
        {{--end-messages-side--}}
    </div>
@endsection