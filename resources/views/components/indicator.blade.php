@props([
    'value' => '',
])

<div class="indicator">
    <span class="indicator-item badge badge-primary badge-sm">{{ $value }}</span>
    {{ $slot }}
</div>
