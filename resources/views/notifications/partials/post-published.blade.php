@props([
    'notification' => null,
    'user' => null,
])

{{--TODO fix duplicate queries--}}

@php
    use App\Models\Post;

    $postTitle = Post::find($notification?->data['post_id'])->title;
@endphp

@if($notification && $user)
        <div class="vstack justify-start gap-2 py-1">
            <x-profile.avatar :user="$user" :navigateToProfile="false"/>
            <p class="line-clamp-2">{{ $postTitle }}</p>
        </div>
@endif
