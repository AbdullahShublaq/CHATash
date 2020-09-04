<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
<div id="app">
    <nav id="nav" class="bg-blue-900 shadow py-3">
        <div class="container mx-auto px-6 md:px-0">
            <div class="flex items-center justify-center">
                <div class="mr-6">
                    <a href="{{ url('/') }}" class="flex text-lg font-semibold text-gray-100 no-underline">
                        {{ config('app.name', 'Laravel') }}
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-quote" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"></path>
                            <path d="M7.468 7.667c0 .92-.776 1.666-1.734 1.666S4 8.587 4 7.667C4 6.747 4.776 6 5.734 6s1.734.746 1.734 1.667z"></path>
                            <path fill-rule="evenodd"
                                  d="M6.157 6.936a.438.438 0 0 1-.56.293.413.413 0 0 1-.274-.527c.08-.23.23-.44.477-.546a.891.891 0 0 1 .698.014c.387.16.72.545.923.997.428.948.393 2.377-.942 3.706a.446.446 0 0 1-.612.01.405.405 0 0 1-.011-.59c1.093-1.087 1.058-2.158.77-2.794-.152-.336-.354-.514-.47-.563zm-.035-.012h-.001.001z"></path>
                            <path d="M11.803 7.667c0 .92-.776 1.666-1.734 1.666-.957 0-1.734-.746-1.734-1.666 0-.92.777-1.667 1.734-1.667.958 0 1.734.746 1.734 1.667z"></path>
                            <path fill-rule="evenodd"
                                  d="M10.492 6.936a.438.438 0 0 1-.56.293.413.413 0 0 1-.274-.527c.08-.23.23-.44.477-.546a.891.891 0 0 1 .698.014c.387.16.72.545.924.997.428.948.392 2.377-.942 3.706a.446.446 0 0 1-.613.01.405.405 0 0 1-.011-.59c1.093-1.087 1.058-2.158.77-2.794-.152-.336-.354-.514-.469-.563zm-.034-.012h-.002.002z"></path>
                        </svg>
                    </a>
                </div>
                <div class="flex-1 text-right">
                    @guest
                        <a class="no-underline hover:underline text-gray-300 text-sm p-3"
                           href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="no-underline hover:underline text-gray-300 text-sm p-3"
                               href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <div class="flex justify-end">
                            <dropdown align="right" width="">
                                <template v-slot:trigger>
                                    <div class="flex justify-end items-center">
                                        <img class="w-8 h-8 rounded-full"
                                             src="https://avatars.dicebear.com/v2/gridy/{{crypt(Auth::user()->email,'st')}}.svg"
                                             alt="avatar">
                                        <span class="text-gray-300 text-sm pr-4 ml-2">
                                        {{ Auth::user()->name }}
                                        </span>
                                    </div>
                                </template>

                                <a href="{{ route('logout') }}"
                                   class="block text-default no-underline text-sm leading-loose px-4 hover:bg-gray-300"
                                   onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    {{ csrf_field() }}
                                </form>
                            </dropdown>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    @yield('content')
</div>
</body>

@stack('script')

</html>
