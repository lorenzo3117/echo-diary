@props([
    'post' => null,
    'comment' => null,
])

@if ($post)
    <form method="POST" action="{{ $comment ? route('comment.update', $comment) : route('comment.store', $post) }}" class="hstack">
        @csrf
        @if ($comment)
            @method('PUT')
        @endif

        <x-form.input placeholder="{{ __('Your message') }}" name="message" value="{{ $comment?->message }}" fullWidth />

        <div class="hstack gap-2">
            <x-form.submit-button>{{ __('Comment') }}</x-form.submit-button>
        </div>
    </form>
@endif
