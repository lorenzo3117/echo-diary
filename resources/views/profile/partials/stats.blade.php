@props([
    'user' => null,
    'postsCount' => 0,
    'postsFavoritesCount' => 0,
])

@php
    $stats = [
        [
            'title' => __('Posts'),
            'value' => $postsCount,
        ],
        [
            'title' => __('Favorites'),
            'value' => $postsFavoritesCount,
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
