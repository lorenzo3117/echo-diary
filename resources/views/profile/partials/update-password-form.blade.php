<div class="card card-body">
    <h2>{{ __('Update Password') }}</h2>

    <p>{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>

    <form method="post" action="{{ route('password.update') }}" class="vstack">
        @csrf
        @method('put')

        <x-form.input type="password" label="{{ __('Current password') }}" name="current_password"/>
        <x-form.input type="password" label="{{ __('New password') }}" name="password"/>
        <x-form.input type="password" label="{{ __('Confirm password') }}" name="password_confirmation"/>

        <div>
            <x-form.submit-button>{{ __('Save') }}</x-form.submit-button>
        </div>
    </form>
</div>
