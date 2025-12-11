<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        .bg-batik {
            background-color: #fffbeb;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='%23d97706' fill-opacity='0.03'/%3E%3C/svg%3E");
        }
    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-batik min-h-screen">
    <header class="bg-gradient-to-r from-amber-900 via-red-900 to-amber-900 text-amber-50 shadow-lg sticky top-0 z-20">
        <div class="h-2 bg-gradient-to-r from-amber-500 via-red-500 to-amber-500"></div>
        <div class="px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center">
                        <span class="text-2xl">🏛️</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-wide">DESA Benangin 1</h1>
                        <p class="text-amber-200 text-sm hidden md:block">📍 Kecamatan Teweh Timur</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="h-1 bg-gradient-to-r from-transparent via-amber-400 to-transparent"></div>
    </header>
    <!-- Page Content -->
    <div class="max-w-7xl mx-auto px-4 py-6">
        <main class="bg-white rounded-xl shadow-md overflow-hidden">
            @yield('content')
        </main>
    </div>
</body>

</html>