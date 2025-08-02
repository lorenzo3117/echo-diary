@php
    $unreadNotifications = $unreadNotifications ?? Auth::user()->unreadNotifications()->limit(5)->get();
@endphp

@auth
    <div class="dropdown dropdown-end">
        @if($unreadNotifications->isEmpty())
            <x-button tabindex="0" role="button" isCircle>
                <x-phosphor-bell/>
            </x-button>
        @else
            <div class="mr-2">
                <x-indicator :value="$unreadNotifications->count()">
                    <x-button tabindex="0" role="button" isCircle>
                        <x-phosphor-bell-ringing/>
                    </x-button>
                </x-indicator>
            </div>
        @endif
        <ul tabindex="0" class="dropdown-content w-80">
            @include('notifications.partials.menu-list-items', [
                'notifications' => $unreadNotifications
            ])

            @if($unreadNotifications->isNotEmpty())
                <div class="divider my-0"></div>
                <li>
                    <x-link href="{{ route('notification.index') }}">{{ __('View all notifications') }}</x-link>
                </li>
            @endif
        </ul>
    </div>
@endauth
