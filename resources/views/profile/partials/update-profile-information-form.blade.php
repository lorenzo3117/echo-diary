<div class="card card-body">
    <h2>{{ __('Profile Information') }}</h2>

    <p>{{ __("Update your account's profile information and email address.") }}</p>

    <form method="post" action="{{ route('profile.update') }}" class="vstack">
        @csrf
        @method('patch')

        <x-input label="{{ __('Username') }}" name="username" value="{{ $user->username }}"/>
        <x-input label="{{ __('Email') }}" name="email" value="{{ $user->email }}"/>

        <div>
            <x-form-submit>{{ __('Save') }}</x-form-submit>
        </div>
    </form>
</div>
