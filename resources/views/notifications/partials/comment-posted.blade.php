@props([
    'notification' => null,
    'user' => null,
])

{{--TODO fix duplicate queries--}}

@php
    use App\Models\Comment;

    $comment = Comment::find($notification?->data['comment_id']);
    $commentMessage = $comment?->message;
    $postTitle = $comment?->post->title;
@endphp

@if($notification && $postTitle && $user)
    <div class="vstack justify-start gap-2 py-1">
        <div class="hstack gap-2">
            <p class="whitespace-nowrap">New comment by</p>
            <x-profile.avatar :user="$user" :navigateToProfile="false"/>
            <p class="line-clamp-1">on <strong>{{ $postTitle }}</strong></p>
        </div>
        <strong class="truncate">{{ $commentMessage }}</strong>
    </div>
@else
    <p class="text-error">{{ __('Error loading notification') }}</p>
@endif
