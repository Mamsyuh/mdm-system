<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Desa Benangin 1 - Digitalisasi Kependudukan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJ8WblIBAz5i407eKBCf/zP/gC91D328Q3x8j1E4Q6N7KxU5L0P8S2T8y8F8Gg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom Keyframes untuk efek intro */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down { animation: fadeInDown 1s ease-out; }
        .animate-fade-in-up { animation: fadeInUp 1s ease-out; }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">

    {{-- NAVIGATION BAR --}}
    <nav class="w-full bg-white dark:bg-gray-800 shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="font-extrabold text-2xl text-blue-700 dark:text-blue-400 flex items-center animate-fade-in-down">
                <i class="fas fa-landmark mr-3 text-3xl"></i> SISKEP BENANGIN 1
            </h1>

            <div class="space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="px-5 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition duration-300 shadow-md">
                            <i class="fas fa-chart-line mr-1"></i> Dashboard Akses
                        </a>
                    @else
                        <div class="h-8"></div> 
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <section class="relative bg-gradient-to-br from-blue-700 to-indigo-900 h-[650px] flex items-center justify-center overflow-hidden">
        {{-- Ilustrasi Latar Belakang (Opacity Rendah) --}}
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 1440 320\'><path fill=\'%23ffffff\' fill-opacity=\'0.1\' d=\'M0,224L60,202.7C120,181,240,139,360,117.3C480,96,600,96,720,117.3C840,139,960,181,1080,186.7C1200,192,1320,160,1380,144L1440,128L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z\'></path></svg>');"></div>

        <div class="relative z-10 text-center text-white px-6 max-w-4xl">
            <h2 class="text-6xl font-extrabold mb-4 animate-fade-in-down delay-100">
                Digitalisasi Data Kependudukan Desa Benangin
            </h2>
            <p class="text-xl mb-10 font-light mx-auto animate-fade-in-down delay-300">
                Sistem Informasi Terintegrasi dan Validasi Data Penduduk untuk administrasi desa yang cepat, akurat dan transparan.
            </p>

            <a href="{{ route('login') }}"
               class="px-10 py-4 bg-green-400 hover:bg-green-500 text-gray-900 font-bold rounded-full text-xl shadow-2xl transition transform hover:scale-105 duration-300 animate-fade-in-up delay-500">
                <i class="fas fa-sign-in-alt mr-2"></i> Masuk ke Sistem
            </a>
        </div>
    </section>

    {{-- FEATURE SHOWCASE (Grid 4 Kolom) --}}
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-4xl font-extrabold text-gray-800 dark:text-white mb-16 relative inline-block">
                Modul & Keunggulan Utama
                <span class="absolute left-0 right-0 bottom-[-10px] h-1 bg-blue-600 rounded-full w-2/3 mx-auto"></span>
            </h3>

            <div class="grid md:grid-cols-4 gap-8">
                
                {{-- Card 1: Validasi Data --}}
                <div class="bg-white dark:bg-gray-800 shadow-2xl p-8 rounded-3xl border-t-4 border-yellow-500 hover:shadow-yellow-500/30 transition duration-500 transform hover:-translate-y-2">
                    <div class="text-5xl text-yellow-500 mb-4 animate-pulse-slow">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-3">Validasi Data (Core)</h4>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Verifikasi dan jejak audit data penduduk oleh operator sebelum disahkan.</p>
                </div>

                {{-- Card 2: Manajemen KK --}}
                <div class="bg-white dark:bg-gray-800 shadow-2xl p-8 rounded-3xl border-t-4 border-blue-600 hover:shadow-blue-600/30 transition duration-500 transform hover:-translate-y-2">
                    <div class="text-5xl text-blue-600 mb-4">
                        <i class="fas fa-address-card"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-3">Kartu Keluarga</h4>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Pengelolaan data KK, relasi anggota, dan pencetakan dokumen.</p>
                </div>

                {{-- Card 3: Statistik --}}
                <div class="bg-white dark:bg-gray-800 shadow-2xl p-8 rounded-3xl border-t-4 border-green-500 hover:shadow-green-500/30 transition duration-500 transform hover:-translate-y-2">
                    <div class="text-5xl text-green-500 mb-4">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-3">Visualisasi Statistik</h4>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Grafik interaktif penduduk berdasarkan usia, gender, dan wilayah RT/RW.</p>
                </div>

                {{-- Card 4: Layanan Surat --}}
                <div class="bg-white dark:bg-gray-800 shadow-2xl p-8 rounded-3xl border-t-4 border-red-500 hover:shadow-red-500/30 transition duration-500 transform hover:-translate-y-2">
                    <div class="text-5xl text-red-500 mb-4">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-3">Layanan Surat Digital</h4>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Pengajuan dan persetujuan surat pengantar (Domisili, SKU, dll.) secara terpusat.</p>
                </div>

            </div>
        </div>
    </section>

    {{-- PROCESS TIMELINE / MISI --}}
    <section class="py-24 bg-white dark:bg-gray-800">
        <div class="max-w-6xl mx-auto px-6">
            <h3 class="text-4xl font-extrabold text-gray-800 dark:text-white text-center mb-16">
                Bagaimana Sistem Kami Bekerja?
            </h3>
            
            <div class="relative wrap overflow-hidden p-10 h-full">
                <div class="border-2-2 absolute border-opacity-20 border-blue-600 h-full border" style="left: 50%"></div>
                
                <div class="mb-8 flex justify-between items-center w-full right-timeline">
                    <div class="order-1 w-5/12"></div>
                    <div class="z-20 flex items-center order-1 bg-blue-600 shadow-xl w-10 h-10 rounded-full">
                        <h1 class="mx-auto font-semibold text-lg text-white">1</h1>
                    </div>
                    <div class="order-1 bg-white dark:bg-gray-700 rounded-lg shadow-xl w-5/12 px-6 py-4 transition transform hover:scale-105">
                        <h3 class="mb-3 font-bold text-blue-600 text-xl">Input Data Baru</h3>
                        <p class="text-sm leading-snug tracking-wide text-gray-900 dark:text-gray-200">Operator memasukkan data penduduk atau KK baru melalui form yang terstruktur.</p>
                    </div>
                </div>

                <div class="mb-8 flex justify-between items-center w-full left-timeline">
                    <div class="order-1 bg-white dark:bg-gray-700 rounded-lg shadow-xl w-5/12 px-6 py-4 transition transform hover:scale-105">
                        <h3 class="mb-3 font-bold text-blue-600 text-xl">Proses Validasi</h3>
                        <p class="text-sm leading-snug tracking-wide text-gray-900 dark:text-gray-200">Data masuk ke antrian Validasi untuk diverifikasi oleh Operator/Admin. Data tidak valid akan ditolak.</p>
                    </div>
                    <div class="z-20 flex items-center order-1 bg-blue-600 shadow-xl w-10 h-10 rounded-full">
                        <h1 class="mx-auto font-semibold text-lg text-white">2</h1>
                    </div>
                    <div class="order-1 w-5/12"></div>
                </div>
                
                <div class="mb-8 flex justify-between items-center w-full right-timeline">
                    <div class="order-1 w-5/12"></div>
                    <div class="z-20 flex items-center order-1 bg-blue-600 shadow-xl w-10 h-10 rounded-full">
                        <h1 class="mx-auto font-semibold text-lg text-white">3</h1>
                    </div>
                    <div class="order-1 bg-white dark:bg-gray-700 rounded-lg shadow-xl w-5/12 px-6 py-4 transition transform hover:scale-105">
                        <h3 class="mb-3 font-bold text-blue-600 text-xl">Penyimpanan Terintegrasi</h3>
                        <p class="text-sm leading-snug tracking-wide text-gray-900 dark:text-gray-200">Data yang sudah divalidasi disimpan di database terpusat.</p>
                    </div>
                </div>

                <div class="mb-8 flex justify-between items-center w-full left-timeline">
                    <div class="order-1 bg-white dark:bg-gray-700 rounded-lg shadow-xl w-5/12 px-6 py-4 transition transform hover:scale-105">
                        <h3 class="mb-3 font-bold text-blue-600 text-xl">Laporan & Layanan</h3>
                        <p class="text-sm leading-snug tracking-wide text-gray-900 dark:text-gray-200">Data digunakan untuk pencetakan statistik, KK, Export Excel, atau pengajuan surat resmi.</p>
                    </div>
                    <div class="z-20 flex items-center order-1 bg-blue-600 shadow-xl w-10 h-10 rounded-full">
                        <h1 class="mx-auto font-semibold text-lg text-white">4</h1>
                    </div>
                    <div class="order-1 w-5/12"></div>
                </div>

            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-gray-300 py-10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-lg font-semibold text-blue-400">Sistem Informasi Integrasi dan Validasi Data Penduduk</p>
            <p class="text-sm mt-2">© {{ date('Y') }} Desa Benangin 1. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Script untuk mengatur posisi elemen timeline (untuk tampilan desktop)
        const items = document.querySelectorAll(".right-timeline, .left-timeline");
        
        function isElementInViewport(el) {
            const rect = el.getBoundingClientRect();
            return (
                rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.bottom >= 0
            );
        }

        function callbackFunc() {
            for (let i = 0; i < items.length; i++) {
                if (isElementInViewport(items[i])) {
                    items[i].classList.add("animate-fade-in-up");
                }
            }
        }
        
        // Panggil saat dimuat dan saat scroll
        window.addEventListener("load", callbackFunc);
        window.addEventListener("scroll", callbackFunc);
    </script>
</body>
</html>