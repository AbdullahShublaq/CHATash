@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center w-full px-4 py-12">
        <div class="w-full max-w-md">
            @if (session('resent'))
                <div class="flex items-start gap-3 bg-green-50/80 backdrop-blur border border-green-200 text-green-700 text-sm rounded-xl px-4 py-3 mb-6 shadow-sm" role="alert">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5z"></path>
                    </svg>
                    <span>{{ __('A fresh verification link has been sent to your email address.') }}</span>
                </div>
            @endif

            <div class="card overflow-hidden">
                <div class="card-header">
                    <h2 class="text-center text-xl font-semibold text-white">{{ __('Verify Your Email Address') }}</h2>
                </div>

                <div class="p-8">
                    <p class="text-sm leading-relaxed text-slate-700 dark:text-slate-300">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                    </p>

                    <p class="text-sm leading-relaxed text-slate-700 dark:text-slate-300 mt-6">
                        {{ __('If you did not receive the email') }},
                        <a class="font-medium text-indigo-600 hover:text-indigo-800 cursor-pointer" onclick="event.preventDefault(); document.getElementById('resend-verification-form').submit();">{{ __('click here to request another') }}</a>.
                    </p>

                    <form id="resend-verification-form" method="POST" action="{{ route('verification.resend') }}" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection