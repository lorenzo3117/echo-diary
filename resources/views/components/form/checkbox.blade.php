@props([
    'label' => null,
    'name' => '',
    'checked' => false,
    'isToggle' => false,
])

<label for="{{ $name }}" class="hstack gap-2">
    <input id="{{ $name }}"
           type="checkbox"
           name="{{ $name }}"
            @checked(old($name, $checked))
            @class([
                'checkbox' => !$isToggle,
                'toggle' => $isToggle,
            ])
            {{ $attributes }}>
    <span>{{ $label }}</span>
</label>
