@props([
    'user' => null,
    'showUsername' => true,
    'navigateToProfile' => true,
    'variant' => 'small',
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
                    <div @class([
                            'text-neutral-content font-bold rounded-full',
                            $bg_color,
                            'w-10' => $variant === 'small',
                            'w-16 text-2xl' => $variant === 'big',
                        ])
                    >
                        <span>{{ $avatar_placeholder }}</span>
                    </div>
                </div>
                @if($showUsername) <p @class(['text-2xl font-medium' => $variant === 'big'])>{{ $username }}</p> @endif
            </div>
        @if($navigateToProfile) </a> @endif
    </div>
@endif
