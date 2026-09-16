<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css'])
    <script>
        (function () {
            var theme = localStorage.getItem('theme');
            if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    <script>
        function toggleTheme() {
            var root = document.documentElement;
            root.classList.toggle('dark');
            localStorage.setItem('theme', root.classList.contains('dark') ? 'dark' : 'light');
        }
    </script>
</head>
<body class="antialiased leading-none">
<div class="relative min-h-screen flex items-center justify-center overflow-hidden px-6">
    <!-- decorative orbs -->
    <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-indigo-300/40 dark:bg-indigo-700/25 blur-3xl"></div>
    <div class="absolute top-1/3 -right-32 w-[28rem] h-[28rem] rounded-full bg-blue-300/40 dark:bg-blue-700/25 blur-3xl"></div>
    <div class="absolute -bottom-32 left-1/3 w-96 h-96 rounded-full bg-purple-300/30 dark:bg-purple-700/20 blur-3xl"></div>

    <button type="button" id="theme-toggle" title="Toggle dark/light theme"
            onclick="toggleTheme()"
            class="absolute top-5 right-5 inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl border border-white/60 dark:border-white/10 shadow-sm text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 dark:text-slate-300 dark:hover:text-indigo-300 dark:hover:bg-white/10 transition z-10">
        <svg class="hidden dark:block w-5 h-5" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
        </svg>
        <svg class="block dark:hidden w-5 h-5" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>
        </svg>
    </button>

    <div class="relative w-full max-w-md text-center">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-700 shadow-lg shadow-indigo-500/30 mb-8">
            <svg viewBox="0 0 16 16" class="w-10 h-10 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"></path>
                <path d="M7.468 7.667c0 .92-.776 1.666-1.734 1.666S4 8.587 4 7.667C4 6.747 4.776 6 5.734 6s1.734.746 1.734 1.667z"></path>
                <path fill-rule="evenodd" d="M6.157 6.936a.438.438 0 0 1-.56.293.413.413 0 0 1-.274-.527c.08-.23.23-.44.477-.546a.891.891 0 0 1 .698.014c.387.16.72.545.923.997.428.948.393 2.377-.942 3.706a.446.446 0 0 1-.612.01.405.405 0 0 1-.011-.59c1.093-1.087 1.058-2.158.77-2.794-.152-.336-.354-.514-.47-.563zm-.035-.012h-.001.001z"></path>
                <path d="M11.803 7.667c0 .92-.776 1.666-1.734 1.666-.957 0-1.734-.746-1.734-1.666 0-.92.777-1.667 1.734-1.667.958 0 1.734.746 1.734 1.667z"></path>
                <path fill-rule="evenodd" d="M10.492 6.936a.438.438 0 0 1-.56.293.413.413 0 0 1-.274-.527c.08-.23.23-.44.477-.546a.891.891 0 0 1 .698.014c.387.16.72.545.924.997.428.948.392 2.377-.942 3.706a.446.446 0 0 1-.613.01.405.405 0 0 1-.011-.59c1.093-1.087 1.058-2.158.77-2.794-.152-.336-.354-.514-.469-.563zm-.034-.012h-.002.002z"></path>
            </svg>
        </div>

        <h1 class="text-5xl md:text-6xl font-bold tracking-tight mb-4 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent">
            {{ config('app.name', 'Laravel') }}
        </h1>

        <p class="mb-10 text-slate-600 dark:text-slate-300 text-lg font-sans leading-relaxed">
            Enjoy chatting with your friends.
        </p>

        @auth
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ url('/home') }}" class="btn-primary px-8 py-3 rounded-full">
                    {{ __('Home') }}
                </a>
                <a href="{{ route('logout') }}"
                   class="inline-flex items-center justify-center px-8 py-3 rounded-full font-semibold text-rose-600 bg-white/80 border-2 border-rose-400 hover:bg-rose-50 dark:text-rose-400 dark:bg-slate-800/80 dark:border-rose-500 dark:hover:bg-slate-800 backdrop-blur transition"
                   onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    {{ csrf_field() }}
                </form>
            </div>
        @else
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('login') }}" class="btn-primary px-8 py-3 rounded-full">
                    {{ __('Login') }}
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 rounded-full font-semibold text-blue-700 bg-white/80 border-2 border-blue-400 hover:bg-blue-50 dark:text-blue-400 dark:bg-slate-800/80 dark:border-blue-500 dark:hover:bg-slate-800 backdrop-blur transition">
                        {{ __('Register') }}
                    </a>
                @endif
            </div>
        @endauth
    </div>
</div>
</body>
</html>