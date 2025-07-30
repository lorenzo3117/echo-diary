@props([
    'label' => null,
    'name' => '',
    'value' => null,
    'placeholder' => null,
    'options' => [],
    'required' => true,
    'fullWidth' => false,
])

@php
    $selectedValue = old($name, $value);
    $placeholder = $placeholder ?? __('Select an option');
@endphp

<div @class(['w-full' => $fullWidth])>
    @if ($label)
        <label for="{{ $name }}" class="block mb-2">
            {{ $label }}
        </label>
    @endif
    <select name="{{ $name }}" id="{{ $name }}" @if($required) required @endif {{ $attributes->merge(['class' => 'select ' . ($errors->has($name) ? 'input-error' : '') . ($fullWidth ? 'w-full' : '')]) }}>
        @if(!$required)
            <option value="">{{ $placeholder }}</option>
        @endif
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" @selected($selectedValue == $key)>
                {{ $value }}
            </option>
        @endforeach
    </select>
    @error($name)
        <p class="text-error mt-1">{{ $message }}</p>
    @enderror
</div>
