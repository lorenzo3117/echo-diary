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

    <div>
        <x-form.submit>{{ $post ? __('Update post') : __('Create') }}</x-form.submit>
    </div>
</form>
