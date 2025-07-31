@props([
    'post' => null,
])

@php
    use App\Enum\PostStatus;

    $status = $post->status;
    $variant = null;

    switch ($status) {
        case PostStatus::DRAFT->value:
            $variant = 'primary';
            break;
        case PostStatus::PUBLISHED->value:
            $variant = 'success';
            break;
        case PostStatus::REVIEW->value:
            $variant = 'error';
            break;
        case PostStatus::ARCHIVED->value:
            $variant = 'neutral';
            break;
    }
@endphp

@if($post && $status && $variant)
    @can('view-status', $post)
        <x-badge :variant="$variant">{{ $status }}</x-badge>
    @endcan
@endif
