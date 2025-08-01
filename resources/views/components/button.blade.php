@props([
    'variant' => null,
    'fullWidth' => false,
    'isCircle' => false,
    'isOutline' => false,
    'isSmall' => false,
])

<button @class([
    "btn",
    "btn-primary" => $variant === 'primary',
    "btn-secondary" => $variant === 'secondary',
    "btn-error" => $variant === 'error',
    "btn-block" => $fullWidth,
    "btn-circle" => $isCircle,
    "btn-outline" => $isOutline,
    "btn-sm" => $isSmall,
]) {{ $attributes }}>
    {{ $slot }}
</button>
