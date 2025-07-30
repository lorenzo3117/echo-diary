@props([
    'user' => null,
    'showUsername' => true,
    'navigateToProfile' => true,
])

@php
    $username = $user->username;
    $avatar_placeholder = strtoupper(mb_substr($username, 0, 2));

    $bg_colors = [
        'bg-primary',
        'bg-secondary',
        'bg-neutral',
        'bg-error',
    ];
    $bg_color = $bg_colors[array_rand($bg_colors)];
@endphp

@if($user)
    <div>
        @if($navigateToProfile) <a href="{{ route('profile.show', $user) }}" class="block"> @endif
            <div class="hstack gap-2">
                <div class="avatar avatar-placeholder">
                    <div class="{{ $bg_color }} text-neutral-content w-8 rounded-full">
                        <span>{{ $avatar_placeholder }}</span>
                    </div>
                </div>
                @if($showUsername) <p>{{ $username }}</p> @endif
            </div>
        @if($navigateToProfile) </a> @endif
    </div>
@endif
