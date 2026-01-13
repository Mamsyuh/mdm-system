<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<<<<<<< HEAD

    <title>{{ config('app.name', 'SISKEP Benangin 1') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
=======
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <title>{{ $title }}</title>

    <style>
        .bg-batik {
            background-color: #fffbeb;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='%23d97706' fill-opacity='0.03'/%3E%3C/svg%3E");
        }

        .avatar-admin {
            background-color: #d97706;
            /* Warna Amber */
            border: 2px solid #fff;
        }

        .avatar-operator {
            background-color: #e3a65fff;
            /* Warna Amber */
            border: 2px solid #fff;
        }
    </style>
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<<<<<<< HEAD
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
=======
<body class="bg-batik min-h-screen">
    <header class="bg-gradient-to-r from-amber-900 via-red-900 to-amber-900 text-amber-50 shadow-lg sticky top-0 z-20">
        <div class="h-2 bg-gradient-to-r from-amber-500 via-red-500 to-amber-500"></div>
        <div class="px-6 py-4 flex items-center justify-between">
            @include('layouts.header')
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae
        </div>
    </header>

    <div class="max-w-[1600px] mx-auto px-4 md:px-8 py-8">
        {{-- Kontainer Utama --}}
        <main class="bg-white rounded-[2rem] shadow-2xl shadow-slate-200/60 border border-slate-100 overflow-hidden min-h-[70vh]">
            {{-- Bagian @yield('content') akan terisi di sini --}}
            @yield('content')
        </main>
<<<<<<< HEAD
=======
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#tanggal_lahir").datepicker({
                // Opsi agar input bisa diketik
                changeMonth: true, // Opsional: drop-down bulan
                changeYear: true,  // Opsional: drop-down tahun

                // Format tanggal yang ditampilkan di input field (sesuai kebutuhan Anda)
                dateFormat: "dd/mm/yy", // Contoh: 19/02/2004

                // Mengatur format tanggal ke nilai tersembunyi untuk database (lihat langkah 2)
                altField: "#tanggal_lahir",
                altFormat: "yy-mm-dd" // Format database: 2004-02-19
            });
        });
    </script>
</body>
>>>>>>> b9d24180c6c542f3cb13d186ba7fde8a2324e5ae

        {{-- Footer Simple --}}
        <footer class="mt-8 text-center">
            <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest">
                &copy; {{ date('Y') }} Pemerintah Desa Benangin 1 • Digital Transformation
            </p>
        </footer>
    </div>

</body>
</html>