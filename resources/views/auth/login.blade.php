@extends('base')

@section('content')
    <div class="center">
        <div class="card">
            <div class="card-body w-md">
                <h2>{{ __('Login to your account') }}</h2>

                <form method="POST" action="{{ route('login') }}" class="vstack">
                    @csrf

                    <x-form.input type="email" label="{{ __('Email') }}" name="email" fullWidth autofocus/>
                    <x-form.input type="password" label="{{ __('Password') }}" name="password" fullWidth/>
                    <x-form.checkbox label="{{ __('Remember me') }}" name="remember"/>

                    <x-form.submit fullWidth>
                        {{ __('Log in') }}
                    </x-form.submit>
                    <x-link href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </x-link>
                </form>

                <div class="divider my-0"></div>

                <x-link href="{{ route('register') }}" asButton>
                    {{ __('No account? Create one here!') }}
                </x-link>
            </div>
        </div>
    </div>
@endsection
