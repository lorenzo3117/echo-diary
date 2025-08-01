@php
    $user = Auth::user();
@endphp

@if($user)
    <div class="flex gap-2">
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                <x-profile.avatar :user="$user" :showUsername="false" :navigateToProfile="false"/>
            </div>
            <ul tabindex="0" class="dropdown-content">
                <li><x-link href="{{ route('profile.show', $user) }}">{{ __('Profile') }}</x-link></li>
                <li><x-link href="{{ route('profile.edit') }}">{{ __('Settings') }}</x-link></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="link no-underline" type="submit">{{ __('Logout') }}</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

@endif
