<div class="card card-body">
    <h2>{{ __('Update Password') }}</h2>

    <p>{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <x-input type="password" label="{{ __('Current password') }}" name="current_password"/>
        <x-input type="password" label="{{ __('New password') }}" name="password"/>
        <x-input type="password" label="{{ __('Confirm password') }}" name="password_confirmation"/>

        <x-form-submit>
            {{ __('Save') }}
        </x-form-submit>
    </form>
</div>
