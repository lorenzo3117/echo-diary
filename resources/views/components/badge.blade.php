@props([
    'variant' => 'primary',
])

<div @class([
    'badge',
    'badge-primary' => $variant === 'primary',
    'badge-success' => $variant === 'success',
    'badge-error' => $variant === 'error',
    'badge-neutral' => $variant === 'neutral',
])>
    {{ $slot }}
</div>
