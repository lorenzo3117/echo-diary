@props([
    'notification' => null,
    'user' => null,
])

{{--TODO fix duplicate queries--}}

@php
    use App\Models\Post;

    $postTitle = Post::find($notification?->data['post_id'])?->title;
@endphp

@if($notification && $postTitle && $user)
        <div class="vstack justify-start gap-2 py-1">
            <div class="hstack gap-2">
                <p class="whitespace-nowrap">New post by</p>
                <x-profile.avatar :user="$user" :navigateToProfile="false"/>
            </div>
            <strong class="truncate">{{ $postTitle }}</strong>
        </div>
@else
    <p class="text-error">{{ __('Error loading notification') }}</p>
@endif
