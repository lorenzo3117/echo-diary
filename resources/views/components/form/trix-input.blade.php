@props([
    'Label' => '',
    'name' => '',
    'value' => null,
])

<x-rich-text::styles theme="richtextlaravel" />

<div>
    @if ($label)
        <label for="{{ $name }}" class="block mb-2">
            {{ $label }}
        </label>
    @endif
        <input
            type="hidden"
            name="{{ $name }}"
            id="{{ $name }}_input"
            value="{{ $value }}"
        />
        <trix-toolbar
            class="[&_.trix-button]:bg-white [&_.trix-button.trix-active]:bg-gray-300"
            id="{{ $name }}_toolbar"
        ></trix-toolbar>
        <trix-editor
            id="{{ $name }}"
            toolbar="{{ $name }}_toolbar"
            input="{{ $name }}_input"
{{--            {{ $attributes->merge(['class' => 'trix-content border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-1 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm dark:[&_pre]:!bg-gray-700 dark:[&_pre]:rounded dark:[&_pre]:!text-white']) }}--}}
            required
            {{ $attributes->merge(['class' => 'trix-content h-96']) }}
        ></trix-editor>
    @error($name)
        <p class="text-error mt-1">{{ $message }}</p>
    @enderror
</div>
