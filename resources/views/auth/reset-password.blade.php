@extends('base')

@section('content')
    <div class="center">
        <div class="card w-md">
            <div class="card-body">
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <x-input-token/>
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
