@extends('base')

@section('content')
    <div class="center">
        <div class="card">
            <div class="card-body w-md">
                <h2>
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </h2>

                <form method="POST" action="{{ route('password.confirm') }}" class="vstack">
                    @csrf

                    <x-form.input type="password" label="{{ __('Password') }}" name="password" fullWidth/>

                    <x-form.submit>
                        {{ __('Confirm') }}
                    </x-form.submit>
                </form>
            </div>
        </div>
    </div>
@endsection
