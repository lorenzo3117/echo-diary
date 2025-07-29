@props([
    'label' => null,
    'name' => '',
    'value' => null,
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
    <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            @if($required) required @endif
            {{ $attributes->merge(['class' => 'textarea ' . ($errors->has($name) ? 'textarea-error' : '') . ($fullWidth ? 'w-full' : '')]) }}
        >
        {{ $inputValue }}
    </textarea>
    @error($name)
        <p class="text-error mt-2">{{ $message }}</p>
    @enderror
</div>
