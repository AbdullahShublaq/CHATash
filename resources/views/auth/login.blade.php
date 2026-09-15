@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center w-full px-4 py-12">
        <div class="w-full max-w-md">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <h2 class="text-center text-xl font-semibold text-white">{{ __('Login') }}</h2>
                </div>

                <form class="p-8" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                            {{ __('E-Mail Address') }}:
                        </label>

                        <input id="email" type="email" class="input @error('email') border-red-500 focus:ring-red-500/30 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password" class="input @error('password') border-red-500 focus:ring-red-500/30 @enderror" name="password" required>

                        @error('password')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center mb-6">
                        <label class="inline-flex items-center text-sm text-slate-700" for="remember">
                            <input type="checkbox" name="remember" id="remember" class="form-checkbox h-4 w-4 text-indigo-600 rounded border-gray-300" {{ old('remember') ? 'checked' : '' }}>
                            <span class="ml-2">{{ __('Remember Me') }}</span>
                        </label>
                    </div>

                    <div class="flex flex-col items-center gap-4">
                        <button type="submit" class="btn-primary w-full">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('register'))
                            <p class="text-sm text-center text-slate-600 mt-2">
                                {{ __("Don't have an account?") }}
                                <a class="text-indigo-600 hover:text-indigo-800 font-medium" href="{{ route('register') }}">
                                    {{ __('Register') }}
                                </a>
                            </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection