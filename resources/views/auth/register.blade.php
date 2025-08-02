@extends('base')

@section('content')
    <div class="center">
        <div class="card">
            <div class="card-body w-md">
                <h2>{{ __('Register your account') }}</h2>

                <form method="POST" action="{{ route('register') }}" class="vstack">
                    @csrf

                    <x-form.input label="{{ __('Username') }}" name="username" fullWidth autofocus/>
                    <x-form.input type="email" label="{{ __('Email') }}" name="email" fullWidth/>
                    <x-form.input type="password" label="{{ __('Password') }}" name="password" fullWidth/>
                    <x-form.input type="password" label="{{ __('Confirm Password') }}" name="password_confirmation"
                             fullWidth/>

                    <x-form.submit-button fullWidth>
                        {{ __('Register') }}
                    </x-form.submit-button>
                </form>

                <div class="divider my-0"></div>

                <x-link href="{{ route('login') }}" asButton>
                    {{ __('Already registered? Login here!') }}
                </x-link>
            </div>
        </div>
    </div>
@endsection
