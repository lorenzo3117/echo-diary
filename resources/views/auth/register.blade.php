@extends('base')

@section('content')
    <div class="center">
        <div class="card w-md">
            <div class="card-body">
                <h2 class="card-title">{{ __('Register your account') }}</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <x-input label="{{ __('Name') }}" name="name" fullWidth autofocus/>
                    <x-input type="email" label="{{ __('Email') }}" name="email" fullWidth/>
                    <x-input type="password" label="{{ __('Password') }}" name="password" fullWidth/>
                    <x-input type="password" label="{{ __('Confirm Password') }}" name="password_confirmation"
                             fullWidth/>

                    <x-form-submit fullWidth>
                        {{ __('Register') }}
                    </x-form-submit>
                </form>

                <div class="divider my-0"></div>

                <x-link href="{{ route('login') }}" asButton>
                    {{ __('Already registered? Login here!') }}
                </x-link>
            </div>
        </div>
    </div>
@endsection
