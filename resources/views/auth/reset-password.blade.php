@extends('base')

@section('content')
    <div class="center">
        <div class="card">
            <div class="card-body w-md">
                <form method="POST" action="{{ route('password.store') }}" class="vstack">
                    @csrf

                    <x-form.input-token :request="$request"/>
                    <x-form.input type="email" label="{{ __('Email') }}" name="email" fullWidth autofocus/>
                    <x-form.input type="password" label="{{ __('Password') }}" name="password" fullWidth/>
                    <x-form.input type="password" label="{{ __('Confirm Password') }}" name="password_confirmation"
                             fullWidth/>

                    <x-form.submit-button>
                        {{ __('Reset password') }}
                    </x-form.submit-button>
                </form>
            </div>
        </div>
    </div>
@endsection
