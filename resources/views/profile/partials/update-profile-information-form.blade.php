<div class="card card-body">
    <h2>{{ __('Profile Information') }}</h2>

    <p>{{ __("Update your account's profile information and email address.") }}</p>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <x-input label="{{ __('Name') }}" name="name" value="{{ $user->name }}"/>
        <x-input label="{{ __('Email') }}" name="email" value="{{ $user->email }}"/>

        <x-form-submit>{{ __('Save') }}</x-form-submit>
    </form>
</div>
