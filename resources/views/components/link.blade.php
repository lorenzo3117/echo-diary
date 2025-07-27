@props([
    'asButton' => false,
])

<a {{ $attributes->merge(['class' => ($asButton ? 'btn btn-block' : 'link')]) }}>
    {{ $slot }}
</a>
