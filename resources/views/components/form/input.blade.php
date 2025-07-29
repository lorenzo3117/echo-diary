@props([
    'label' => null,
    'name' => '',
    'value' => null,
    'type' => 'text',
    'placeholder' => '',
    'required' => true,
    'fullWidth' => false,
    'for' => null
])

@php
    $inputValue = old($name, $value);
@endphp

<div @class(['w-full' => $fullWidth])>
    @if ($label)
        <label for="{{ $name }}" class="block mb-2">
            {{ $label }}
        </label>
    @endif
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $inputValue }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'input ' . ($errors->has($name) ? 'input-error' : '') . ($fullWidth ? 'w-full' : '')]) }}
    />
    @error($name)
    <p class="text-error mt-2">{{ $message }}</p>
    @enderror
</div>
