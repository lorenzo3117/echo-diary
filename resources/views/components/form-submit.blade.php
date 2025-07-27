@props([
    'variant' => 'primary',
])

<x-button variant="{{ $variant }}" type="submit" {{ $attributes }}>
    {{ $slot }}
</x-button>
