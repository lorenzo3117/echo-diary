@props([
    'label' => null,
    'name' => '',
    'value' => null,
    'checked' => false,
])

<label for="{{ $name }}" class="hstack gap-2">
    <input type="radio" name="{{ $name }}" value="{{ $value }}" @checked(old($name, $checked)) class="radio" />
    <span>{{ $label }}</span>
</label>
