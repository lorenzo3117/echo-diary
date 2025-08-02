@props([
    'title' => '',
    'value' => '',
    'description' => '',
])

<div class="stat place-items-center">
    <div class="stat-title">{{ $title }}</div>
    <div class="stat-value">{{ $value }}</div>
    <div class="stat-desc">{{ $description }}</div>
</div>
