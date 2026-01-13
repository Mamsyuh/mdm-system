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
        {{-- Accent line di bagian paling atas --}}
        <div class="h-[3px] bg-gradient-to-r from-blue-600 via-emerald-500 to-blue-600"></div>
        
        <div class="px-6 py-4 flex items-center justify-between max-w-[1600px] mx-auto">
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-4">
                    {{-- Logo Container Glassmorphism --}}
                    <div class="w-12 h-12 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/20 shadow-inner">
                        <span class="text-2xl">🏛️</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-black tracking-tight leading-none uppercase">SISKEP BENANGIN 1</h1>
                        <p class="text-blue-400 text-[10px] font-bold tracking-[0.2em] uppercase mt-1 opacity-90">Sistem Informasi Desa</p>
                    </div>
                </div>
            </div>

            {{-- Sisi Kanan Header (Opsional: User Profile) --}}
            <div class="flex items-center gap-4">
                <div class="hidden md:flex flex-col items-end mr-2">
                    <span class="text-xs font-bold text-white leading-none">{{ auth()->user()->name ?? 'Administrator' }}</span>
                    <span class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider">Online</span>
                </div>
                <div class="w-10 h-10 bg-emerald-500 text-emerald-950 rounded-xl flex items-center justify-center font-black shadow-lg shadow-emerald-500/20">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
            </div>
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