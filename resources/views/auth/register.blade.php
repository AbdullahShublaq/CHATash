@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center w-full px-4 py-12">
        <div class="w-full max-w-md">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <h2 class="text-center text-xl font-semibold text-white">{{ __('Register') }}</h2>
                </div>

                <form class="p-8" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                            {{ __('Name') }}:
                        </label>

                        <input id="name" type="text" class="input @error('name') border-red-500 focus:ring-red-500/30 @enderror" name="name" value="{{ old('name') }}" maxlength="16" required autocomplete="name" autofocus>

                        @error('name')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                            {{ __('E-Mail Address') }}:
                        </label>

                        <input id="email" type="email" class="input @error('email') border-red-500 focus:ring-red-500/30 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password" class="input @error('password') border-red-500 focus:ring-red-500/30 @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password-confirm" class="block text-sm font-medium text-slate-700 mb-2">
                            {{ __('Confirm Password') }}:
                        </label>

                        <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="flex flex-col items-center gap-4">
                        <button type="submit" class="btn-primary w-full">
                            {{ __('Register') }}
                        </button>

                        <p class="text-sm text-center text-slate-600 mt-2">
                            {{ __('Already have an account?') }}
                            <a class="text-indigo-600 hover:text-indigo-800 font-medium" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection