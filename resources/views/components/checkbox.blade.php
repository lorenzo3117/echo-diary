@props([
    'label' => null,
    'name' => '',
    'checked' => false,
])

<label for="{{ $name }}" class="hstack gap-0">
    <input id="{{ $name }}" type="checkbox" class="checkbox" name="{{ $name }}" @checked(old($name, $checked))>
    <span class="ms-2">{{ $label }}</span>
</label>
