@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center w-full px-4 py-12">
        <div class="w-full max-w-md">
            @if (session('status'))
                <div class="flex items-start gap-3 bg-green-50/80 backdrop-blur border border-green-200 text-green-700 text-sm rounded-xl px-4 py-3 mb-6 shadow-sm" role="alert">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5z"></path>
                    </svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <div class="card overflow-hidden">
                <div class="card-header">
                    <h2 class="text-center text-xl font-semibold text-white">{{ __('Reset Password') }}</h2>
                </div>

                <form class="p-8" method="POST" action="{{ route('password.email') }}">
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

                    <div class="flex flex-col items-center gap-4">
                        <button type="submit" class="btn-primary w-full">
                            {{ __('Send Password Reset Link') }}
                        </button>

                        <p class="text-sm text-center text-slate-600">
                            <a class="font-medium text-indigo-600 hover:text-indigo-800" href="{{ route('login') }}">
                                {{ __('Back to login') }}
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection