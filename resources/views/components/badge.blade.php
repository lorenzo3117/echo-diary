@props([
    'variant' => 'primary',
])

<div @class([
    'badge',
    'badge-primary' => $variant === 'primary',
    'badge-neutral' => $variant === 'neutral',
])>
    {{ $slot }}
</div>
