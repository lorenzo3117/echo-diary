@props([
    'variant' => 'primary',
])

<x-button type="submit" variant="{{ $variant }}" {{ $attributes }}>
    {{ $slot }}
</x-button>
