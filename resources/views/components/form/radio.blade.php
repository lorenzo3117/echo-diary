@props([
    'label' => null,
    'name' => '',
    'for' => '',
    'value' => null,
    'checked' => false,
])

@php
    $for = $for ?? $name;
@endphp

<label for="{{ $for }}" class="hstack gap-2">
    <input type="radio" id="{{ $for }}" name="{{ $name }}" value="{{ $value }}" @checked(old($name, $checked)) class="radio" />
    <span>{{ $label }}</span>
</label>
