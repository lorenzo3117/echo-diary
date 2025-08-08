@props([
    'comment' => null,
])

@if ($comment)
    <div class="card card-body p-4">
        <div class="hstack justify-between">
            <x-profile.avatar :user="$comment->user"/>
            @include('comment.partials.action-menu', ['comment' => $comment])
        </div>
        <p>{{ $comment->message }}</p>
        <p class="text-muted text-right">{{ $comment->created_at->diffForHumans() }}</p>
    </div>
@endif