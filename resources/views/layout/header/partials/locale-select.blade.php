@php
    $locales = [
        'en' => 'English',
        'nl' => 'Nederlands',
        'fr' => 'Français',
    ];

    $currentLocale = app()->getLocale();
@endphp

<form method="POST" action="{{ route('lang') }}" id="localeForm">
    @csrf

    <x-form.select
        name="locale"
        :options="$locales"
        :value="$currentLocale"
        x-data=""
        x-on:change="document.getElementById('localeForm').submit()"
    />
</form>

