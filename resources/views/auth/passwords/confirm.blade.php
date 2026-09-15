@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center w-full px-4 py-12">
        <div class="w-full max-w-md">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <h2 class="text-center text-xl font-semibold text-white">{{ __('Confirm Password') }}</h2>
                </div>

                <form class="p-8" method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <p class="text-sm leading-relaxed text-slate-700">
                        {{ __('Please confirm your password before continuing.') }}
                    </p>

                    <div class="my-6">
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password" class="input @error('password') border-red-500 focus:ring-red-500/30 @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap items-center gap-4">
                        <button type="submit" class="btn-primary w-full sm:w-auto px-6">
                            {{ __('Confirm Password') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-indigo-600 hover:text-indigo-800 font-medium sm:ml-auto" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection