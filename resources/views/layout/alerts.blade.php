<div
    x-data="{ show: false }"
    x-init="
        $nextTick(() => {
            show = true;
            setTimeout(() => show = false, 3000);
        });
    "
    x-show="show"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="translate-x-full opacity-0"
    class="transform transition duration-200 fixed top-8 right-8 z-50 max-w-sm w-full"
    style="display: none;">
    @if (session()->has('success'))
        <x-alert variant="success" message="{{ session('success') }}"/>
    @endif
    @if ($errors->any())
        <div class="vstack items-stretch">
            @foreach($errors->all() as $error)
                <x-alert variant="error" message="{{ $error }}"/>
            @endforeach
        </div>
    @endif
</div>