@props([
    'variant' => null,
    'fullWidth' => false,
    'isCircle' => false,
])

<button @class([
    "btn",
    "btn-primary" => $variant === 'primary',
    "btn-error" => $variant === 'error',
    "btn-block" => $fullWidth,
    "btn-circle" => $isCircle
]) {{ $attributes }}>
    {{ $slot }}
</button>
