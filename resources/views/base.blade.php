<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-100 min-h-screen">
@include('layout.header')

<main class="container py-8">
    @if (session()->has('success'))
        <x-alert type="success" message="{{ session('success') }}"/>
    @endif
    @if ($errors->any())
        @foreach($errors->all() as $error)
            <x-alert type="error" message="{{ $error }}"/>
        @endforeach
    @endif

    @yield('content')
</main>
</body>
</html>
