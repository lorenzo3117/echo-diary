@extends('base')

@section('content')
    <div class="center">
        <div class="card w-md">
            <div class="card-body">
                <h2 class="card-title">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </h2>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <x-input type="password" label="{{ __('Password') }}" name="password" fullWidth/>

                    <x-form-submit fullWidth>
                        {{ __('Confirm') }}
                    </x-form-submit>
                </form>
            </div>
        </div>
    </div>
@endsection
