@extends('base')

@section('content')
    <div class="center">
        <div class="card">
            <div class="card-body w-md">
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <x-input-token :request="$request"/>
                    <x-input type="email" label="{{ __('Email') }}" name="email" fullWidth autofocus/>
                    <x-input type="password" label="{{ __('Password') }}" name="password" fullWidth/>
                    <x-input type="password" label="{{ __('Confirm Password') }}" name="password_confirmation"
                             fullWidth/>

                    <x-form-submit fullWidth>
                        {{ __('Reset password') }}
                    </x-form-submit>
                </form>
            </div>
        </div>
    </div>
@endsection
