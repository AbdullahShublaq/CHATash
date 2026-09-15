@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center w-full px-4 py-12">
        <div class="w-full max-w-md">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <h2 class="text-center text-xl font-semibold text-white">{{ __('Reset Password') }}</h2>
                </div>

                <form class="p-8" method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-2">
                            {{ __('E-Mail Address') }}:
                        </label>

                        <input id="email" type="email" class="input @error('email') border-red-500 focus:ring-red-500/30 @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-2">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password" class="input @error('password') border-red-500 focus:ring-red-500/30 @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password-confirm" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-2">
                            {{ __('Confirm Password') }}:
                        </label>

                        <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn-primary w-full">
                        {{ __('Reset Password') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection