@extends('base')

@section('content')
    <div class="center">
        <div class="card w-md">
            <div class="card-body">
                <h2 class="card-title">{{ __('Login to your account') }}</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <x-input type="email" label="{{ __('Email') }}" name="email" fullWidth autofocus />
                    <x-input type="password" label="{{ __('Password') }}" name="password" fullWidth />
                    <x-checkbox label="{{ __('Remember me') }}" name="remember" />

                    <div class="vstack">
                        <x-form-submit fullWidth>
                            {{ __('Log in') }}
                        </x-form-submit>

                        <x-link href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </x-link>
                    </div>
                </form>

                <div class="divider my-0"></div>

                <x-link href="{{ route('register') }}" asButton>
                    {{ __('No account? Create one here!') }}
                </x-link>
            </div>
        </div>
    </div>
@endsection
