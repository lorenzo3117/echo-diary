@props([
    'user' => null,
    'postsCount' => 0,
])

@php
    $stats = [
        [
            'title' => __('Posts'),
            'value' => $postsCount,
        ],
        [
            'title' => __('Followers'),
            'value' => $user?->followers->count(),
        ],
        [
            'title' => __('Following'),
            'value' => $user?->followings->count(),
        ],
    ];
@endphp

@if($user)
    <x-stats.list :stats="$stats"/>
@endif
