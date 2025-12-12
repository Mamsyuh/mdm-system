<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-batik min-h-screen">
    <header class="bg-gradient-to-r from-amber-900 via-red-900 to-amber-900 text-amber-50 shadow-lg sticky top-0 z-20">
        <div class="h-2 bg-gradient-to-r from-amber-500 via-red-500 to-amber-500"></div>
        <div class="px-6 py-4 flex items-center justify-between">
            @include('layouts.header')
        </div>
        <div class="h-1 bg-gradient-to-r from-transparent via-amber-400 to-transparent"></div>
    </header>
    <!-- Page Content -->
    <div class="max-w-7xl mx-auto px-4 py-6">
        <main class="bg-white rounded-xl shadow-md overflow-hidden">
            @yield('content')
        </main>
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

</html>