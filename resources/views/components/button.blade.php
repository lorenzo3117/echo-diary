@props([
    'variant' => null,
    'fullWidth' => false,
])

<button class="btn @if($variant) btn-{{ $variant }} @endif @if($fullWidth) btn-block @endif" {{ $attributes }}>
    {{ $slot }}
</button>
