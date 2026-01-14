<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SISKEP Benangin 1') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 min-h-screen font-sans antialiased text-slate-900">
    
    {{-- HEADER: Menggunakan Navy Deep Blue sesuai Landing Page --}}
    <header class="bg-[#0f172a] text-white shadow-xl sticky top-0 z-30 border-b border-white/10">
        <div class="px-6 py-4 flex items-center justify-between max-w-[1600px] mx-auto">
            @include('layouts.header')
        </div>
    </header>

    <div class="max-w-[1600px] mx-auto px-4 md:px-8 py-8">
        {{-- Kontainer Utama --}}
        <main class="bg-white rounded-[2rem] shadow-2xl shadow-slate-200/60 border border-slate-100 overflow-hidden min-h-[70vh]">
            {{-- Bagian @yield('content') akan terisi di sini --}}
            @yield('content')
        </main>

        {{-- Footer Simple --}}
        <footer class="mt-8 text-center">
            <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest">
                &copy; {{ date('Y') }} Pemerintah Desa Benangin 1 • Digital Transformation
            </p>
        </footer>
    </div>

</body>
</html>