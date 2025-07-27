@props([
    'variant' => null,
    'fullWidth' => false,
])

<button @class([
    "btn",
    "btn-primary" => $variant === 'primary',
    "btn-error" => $variant === 'error',
    "btn-block" => $fullWidth,
]) {{ $attributes }}>
    {{ $slot }}
</button>
