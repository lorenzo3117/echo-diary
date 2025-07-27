@props([
    'type' => 'info',
    'message' => '',
])

<div role="alert" @class([
    'alert',
    'alert-info' => $type === 'info',
    'alert-success' => $type === 'success',
    'alert-error' => $type === 'error',
])>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-6 w-6 shrink-0 stroke-current">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    <span>{{ $message }}</span>
</div>
