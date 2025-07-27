<div class="card">
    <div class="card-body">
        <h2 class="card-title">{{ __('Profile Information') }}</h2>

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
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <x-form-submit form="send-verification">
                            {{ __('Click here to re-send the verification email.') }}
                        </x-form-submit>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif

            <x-form-submit>{{ __('Save') }}</x-form-submit>
        </form>
    </div>
</div>
