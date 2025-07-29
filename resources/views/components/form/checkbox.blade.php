@props([
    'label' => null,
    'name' => '',
    'checked' => false,
])

<label for="{{ $name }}" class="hstack gap-2">
    <input id="{{ $name }}" type="checkbox" class="checkbox" name="{{ $name }}" @checked(old($name, $checked))>
    <span>{{ $label }}</span>
</label>
