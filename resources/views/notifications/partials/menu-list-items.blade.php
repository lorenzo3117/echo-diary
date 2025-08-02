@props([
    'notifications' => [],
])

@php
    use App\Models\User;
    use App\Notifications\PostPublishedNotification;
@endphp

@if($notifications->isNotEmpty())
    @foreach($unreadNotifications as $notification)
        @php
            $user = User::find($notification->data['user_id']);
        @endphp

        <li>
            <x-link href="{{ route('notification.read', $notification) }}">
                @switch($notification->type)
                    @case(PostPublishedNotification::class)
                        @include('notifications.partials.post-published', [
                            'notification' => $notification,
                            'user' => $user,
                        ])
                        @break
                @endswitch
            </x-link>
        </li>
    @endforeach
@else
    <p class="text-center py-2 px-8">No notifications</p>
@endif
