@extends('base')

@section('content')
    <div class="center">
        <div class="card">
            <div class="card-body w-md">
                <h2>
                    {{ __('Thanks for signing up!') }}
                </h2>
                <p>
                    {{ __('Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>

                @if (session('status') == 'verification-link-sent')
                    <p>
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </p>
                @endif

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <x-form-submit type="default" fullWidth>
                        {{ __('Resend verification email') }}
                    </x-form-submit>
                </form>
            </div>
        </div>
    </div>
@endsection
