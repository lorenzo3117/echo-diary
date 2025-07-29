@props([
    'asButton' => false,
])

<a {{ $attributes->merge(['class' => ($asButton ? 'btn' : 'link')]) }}>
    {{ $slot }}
</a>
