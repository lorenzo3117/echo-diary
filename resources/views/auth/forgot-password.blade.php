@extends('base')

@section('content')
    <div class="center">
        <div class="card">
            <div class="card-body w-md">
                <h2>{{ __('Forgot your password?') }}</h2>

                <p>{{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to create a new one.') }}</p>

                <form method="POST" action="{{ route('password.email') }}" class="vstack">
                    @csrf

                    <x-form.input type="email" label="{{ __('Email') }}" name="email" fullWidth autofocus/>

                    <x-form.submit-button fullWidth>
                        {{ __('Email password reset link') }}
                    </x-form.submit-button>
                </form>
            </div>
        </div>
    </div>
@endsection

