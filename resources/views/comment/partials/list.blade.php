@props([
    'comments' => \Illuminate\Database\Eloquent\Collection::empty(),
])

@if ($comments->isNotEmpty())
    <div class="vstack gap-2">
        @foreach ($comments as $comment)
            @include('comment.partials.list-item', ['comment' => $comment])
        @endforeach
    </div>
@else
    <p class="text-muted text-center py-4">{{ __('Be the first one to comment') }}</p>
@endif
