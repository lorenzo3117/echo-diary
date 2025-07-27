<div class="card card-body">
    <h2>{{ __('Profile Information') }}</h2>

    <p>{{ __("Update your account's profile information and email address.") }}</p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="hidden">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <x-input label="{{ __('Name') }}" name="name" value="{{ $user->name }}"/>
        <x-input label="{{ __('Email') }}" name="email" value="{{ $user->email }}"/>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p>
                    {{ __('Your email address is unverified.') }}

                    <x-form-submit form="send-verification">
                        {{ __('Click here to re-send the verification email.') }}
                    </x-form-submit>
                </p>
            </div>
        @endif

        <x-form-submit>{{ __('Save') }}</x-form-submit>
    </form>
</div>
