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
    <body class="font-sans text-slate-900 antialiased">
        {{-- Background Navy sesuai Landing Page --}}
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#0f172a] relative overflow-hidden">
            
            {{-- Elemen Dekoratif Ornamen (Opsional, untuk kesan modern) --}}
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl"></div>
            </div>

            <div class="z-10 w-full flex flex-col items-center">
                {{-- Logo Section --}}
                <a href="/" class="mb-8 transition-transform hover:scale-105 duration-300">
                    <div class="w-24 h-24 bg-white/10 backdrop-blur-xl rounded-3xl flex items-center justify-center border border-white/20 shadow-2xl">
                        <span class="text-5xl">🏛️</span>
                    </div>
                </a>

                <div class="text-center mb-8">
                    <h2 class="text-2xl font-black text-white tracking-tight uppercase">SISKEP BENANGIN 1</h2>
                    <p class="text-blue-400 text-sm font-semibold tracking-widest uppercase mt-1">Sistem Informasi Kepegawaian & Penduduk</p>
                </div>

                {{-- Login/Register Card --}}
                <div class="w-full sm:max-w-md px-8 py-10 bg-white shadow-[0_20px_50px_rgba(0,0,0,0.3)] overflow-hidden sm:rounded-[2.5rem] border border-slate-100">
                    {{ $slot }}
                </div>

                {{-- Footer Text --}}
                <p class="mt-8 text-slate-500 text-xs font-medium uppercase tracking-widest">
                    &copy; {{ date('Y') }} Desa Benangin 1 • Digital Transformation
                </p>
            </div>
        </div>
    </body>
</html>