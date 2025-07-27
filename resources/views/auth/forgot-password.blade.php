@extends('base')

@section('content')
    <div class="center">
        <div class="card w-md">
            <div class="card-body">
                <h2 class="card-title">
                    {{ __('Forgot your password?') }}
                </h2>

                <p>{{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to create a new one.') }}</p>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <x-input type="email" label="{{ __('Email') }}" name="email" fullWidth autofocus/>

                    <x-form-submit fullWidth>
                        {{ __('Email password reset link') }}
                    </x-form-submit>
                </form>
            </div>
        </div>
    </div>
@endsection

