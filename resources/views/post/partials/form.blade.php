@php use App\Enum\PostStatus; @endphp

@props([
    'post' => null,
])

<form method="POST" action="{{ $post ? route('post.update', $post) : route('post.store') }}" class="vstack">
    @csrf
    @if ($post)
        @method('PUT')
    @endif

    <x-form.input label="{{ __('Title') }}" name="title" value="{{ $post->title ?? null }}" fullWidth />
    <x-form.input label="{{ __('Description') }}" name="description" value="{{ $post->description ?? null }}" fullWidth />
    <x-form.textarea label="{{ __('Content') }}" name="content" value="{{ $post->content ?? null }}" fullWidth />

    <div class="hstack">
        <x-form.submit name="status" value="{{ PostStatus::DRAFT->value }}" variant="default">{{ __('Save as draft') }}</x-form.submit>
        <x-form.submit name="status" value="{{ PostStatus::PUBLISHED->value }}">{{ __('Publish post') }}</x-form.submit>
    </div>
</form>
