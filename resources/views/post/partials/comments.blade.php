@props([
    'post' => null,
    'comments' => null,
])

@if($post && $comments)
    <h3 id="comments">{{ __('Comments') }}</h3>
    @include('comment.partials.form', ['post' => $post])
    @include('comment.partials.list', ['comments' => $comments])
    {{ $comments->links() }}
@endif
