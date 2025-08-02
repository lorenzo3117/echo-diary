@php use App\Enum\PostStatus; @endphp

@props([
    'post' => null,
])

<form method="POST" action="{{ $post ? route('post.update', $post) : route('post.store') }}" class="vstack">
    @csrf
    @if ($post)
        @method('PUT')
    @endif

    <x-form.input label="{{ __('Title') }}" name="title" value="{{ $post?->title }}" fullWidth />
    <x-form.input label="{{ __('Description') }}" name="description" value="{{ $post?->description }}" fullWidth />
    <x-form.trix-input label="{{ __('Content') }}" name="content" value="{!! $post?->content?->toTrixHtml() !!}" />

    <div class="hstack">
        <x-form.submit-button name="status" value="{{ PostStatus::DRAFT->value }}" variant="default">{{ __('Save as draft') }}</x-form.submit-button>
        <x-form.submit-button name="status" value="{{ PostStatus::PUBLISHED->value }}">{{ __('Publish post') }}</x-form.submit-button>
    </div>
</form>
