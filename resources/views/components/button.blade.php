@props([
    'variant' => null,
    'fullWidth' => false,
    'isCircle' => false,
    'isOutline' => false,
])

<button @class([
    "btn btn-sm",
    "btn-primary" => $variant === 'primary',
    "btn-secondary" => $variant === 'secondary',
    "btn-error" => $variant === 'error',
    "btn-block" => $fullWidth,
    "btn-circle" => $isCircle,
    "btn-outline" => $isOutline,
]) {{ $attributes }}>
    {{ $slot }}
</button>
