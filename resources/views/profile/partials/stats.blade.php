@props([
    'user' => null,
])

@php
    $stats = [
        [
            'title' => __('Posts'),
            'value' => $user->posts->count(),
        ],
        [
            'title' => __('Followers'),
            'value' => $user->followers->count(),
        ],
        [
            'title' => __('Following'),
            'value' => $user->followings->count(),
        ],
    ];
@endphp

@if($user)
    <x-stats.list :stats="$stats"/>
@endif
