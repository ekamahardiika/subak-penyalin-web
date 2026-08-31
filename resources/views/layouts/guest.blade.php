<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Subak Penyalin') - Subak Penyalin</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/Logo1.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4 sm:px-0 bg-emerald-800">
        <div class="p-0 m-0">
            <a href="/" class="block">
                <img src="{{ asset('logo/Logo1.png') }}" alt="Subak Penyalin Logo" style="width: 150px; height: auto;"
                    class="block mx-auto">
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-0 px-6 py-4 bg-white border shadow-md overflow-hidden rounded-lg sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
