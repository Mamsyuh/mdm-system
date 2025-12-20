@php
    // Variabel $penduduk dikirim dari ValidasiController::show($penduduk)
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Verifikasi Data - {{ $penduduk->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        .bg-batik {
            background-color: #fffbeb;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='%23d97706' fill-opacity='0.03'/%3E%3C/svg%3E");
        }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s ease-in-out; }
            .sidebar.active { transform: translateX(0); box-shadow: 6px 0 10px rgba(0,0,0,0.3); }
        }
    </style>
</head>
<body class="bg-batik min-h-screen">

    {{-- HEADER --}}
    <header class="bg-gradient-to-r from-amber-900 via-red-900 to-amber-900 text-amber-50 shadow-lg sticky top-0 z-20">
        <div class="h-2 bg-gradient-to-r from-amber-500 via-red-500 to-amber-500"></div>
        <div class="px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button id="menu-toggle" class="md:hidden p-2 rounded-md hover:bg-amber-800">
                    <i class="fas fa-bars text-xl"></i>
                </button>
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
            <div class="flex items-center gap-4">
                <span class="text-sm bg-amber-800 px-3 py-1 rounded-full hidden sm:block">{{ auth()->user()->role->name ?? 'Operator' }}</span>
                <div class="w-10 h-10 bg-amber-700 rounded-full flex items-center justify-center font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
        <div class="h-1 bg-gradient-to-r from-transparent via-amber-400 to-transparent"></div>
    </header>

    <div class="flex">
        {{-- SIDEBAR --}}
        <aside id="sidebar" class="sidebar w-64 bg-gradient-to-b from-amber-900 to-red-900 min-h-screen text-amber-50 p-4 fixed md:relative z-10">
            <nav class="space-y-2">
                @if (auth()->user()->role->name === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                @else
                    <a href="{{ route('operator.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                @endif
                        <i class="fas fa-home"></i> <span>Dashboard</span>
                    </a>

                <a href="{{ route('validasi.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-amber-700 shadow-lg">
                    <i class="fas fa-check-double"></i> <span>Validasi Data</span>
                </a>

                <a href="{{ route('penduduk.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                    <i class="fas fa-users"></i> <span>Data Penduduk</span>
                </a>
                
                <a href="#" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                    <i class="fas fa-envelope-open-text"></i> <span>Layanan Surat</span>
                </a>
            </nav>
            <div class="mt-8 p-4 bg-amber-800/50 rounded-lg border border-amber-600/30">
                <p class="text-xs text-amber-200 text-center italic">"Gotong Royong Membangun Desa"</p>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main id="main-content" class="flex-1 p-4 md:p-6 transition-all duration-300">
            
            <a href="{{ route('validasi.index') }}" class="text-blue-600 hover:underline mb-4 block font-semibold">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Pending
            </a>
            
            {{-- Alert Status --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-2xl p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Verifikasi Data: {{ $penduduk->nama }}</h2>
                
                {{-- Tampilkan Detail Data Penduduk --}}
                <div class="grid md:grid-cols-3 gap-6 mb-8 text-sm">
                    
                    {{-- Blok Kependudukan --}}
                    <div>
                        <h4 class="font-bold text-lg text-amber-700 mb-2 border-b">Data Utama</h4>
                        <p><span class="font-semibold">Nama Lengkap:</span> {{ $penduduk->nama }}</p>
                        <p><span class="font-semibold">NIK:</span> {{ $penduduk->nik }}</p>
                        <p><span class="font-semibold">Jenis Kelamin:</span> {{ $penduduk->jenis_kelamin }}</p>
                        <p><span class="font-semibold">Hubungan Keluarga:</span> {{ $penduduk->hubungan_keluarga }}</p>
                    </div>

                    {{-- Blok Lahir & Agama --}}
                    <div>
                        <h4 class="font-bold text-lg text-amber-700 mb-2 border-b">Kelahiran & Agama</h4>
                        <p><span class="font-semibold">TTL:</span> {{ $penduduk->tempat_lahir }}, {{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d F Y') }}</p>
                        <p><span class="font-semibold">Usia:</span> {{ $penduduk->umur ?? '?' }} Tahun</p>
                        <p><span class="font-semibold">Agama:</span> {{ $penduduk->agama }}</p>
                    </div>

                    {{-- Blok Alamat --}}
                    <div>
                        <h4 class="font-bold text-lg text-amber-700 mb-2 border-b">Alamat & KK</h4>
                        <p><span class="font-semibold">No. KK:</span> {{ $penduduk->no_kk }}</p>
                        <p><span class="font-semibold">Kepala Keluarga:</span> {{ $penduduk->kepala_keluarga }}</p>
                        <p><span class="font-semibold">Alamat:</span> {{ $penduduk->alamat }}</p>
                        <p><span class="font-semibold">RT/RW:</span> {{ $penduduk->rt }}/{{ $penduduk->rw }}</p>
                    </div>
                </div>

                <h3 class="text-xl font-bold text-green-700 mb-4 border-t pt-4">Aksi Verifikasi Data</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    
                    {{-- 1. FORM APPROVE --}}
                    <form method="POST" action="{{ route('validasi.approve', $penduduk->id) }}" onsubmit="return confirm('ANDA YAKIN? Data ini akan disetujui sebagai data valid.');">
                        @csrf
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow-md transition transform hover:scale-105">
                            <i class="fas fa-check-circle mr-2"></i> SETUJUI / VALIDASI
                        </button>
                    </form>

                    {{-- 2. FORM REJECT --}}
                    <button onclick="document.getElementById('rejectModal').classList.remove('hidden')" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg shadow-md transition transform hover:scale-105">
                        <i class="fas fa-times-circle mr-2"></i> TOLAK / REJECT
                    </button>
                </div>

                <div class="mt-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800">
                    <p class="font-bold"><i class="fas fa-exclamation-triangle mr-2"></i> Perhatian:</p>
                    <p class="text-sm">Setelah data divalidasi atau ditolak, Anda akan diarahkan kembali ke daftar data pending.</p>
                </div>

            </div>
        </main>
    </div>

    {{-- MODAL REJECT --}}
    <div id="rejectModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-70 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-2xl">
            <h3 class="text-xl font-bold mb-4 text-red-700">Tolak Data Penduduk</h3>
            <form method="POST" action="{{ route('validasi.reject', $penduduk->id) }}">
                @csrf
                <div class="mb-4">
                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan Wajib Diisi:</label>
                    <textarea id="catatan" name="catatan" rows="3" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 p-2" placeholder="Contoh: NIK tidak sesuai dengan data Dukcapil atau tanggal lahir salah."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Tolak Data</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script Toggle Sidebar --}}
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>

</body>
</html>