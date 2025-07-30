@php
    $user = Auth::user();
@endphp

@if($user)
    <div class="flex gap-2">
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                <x-profile.avatar :user="$user" :showUsername="false" :navigateToProfile="false"/>
            </div>
            <ul
                tabindex="0"
                class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                <li><a href="{{ route('profile.show', $user) }}">{{ __('Profile') }}</a></li>
                <li><a href="{{ route('profile.edit') }}">{{ __('Settings') }}</a></li>
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
