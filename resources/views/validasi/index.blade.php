@php
    // Variabel $penduduksPending dikirim dari ValidasiController::index()
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Data - Desa Benangin</title>
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

    {{-- HEADER (Gunakan header dari dashboard admin/operator) --}}
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
            
            {{-- PROFILE & LOGOUT --}}
            <div class="flex items-center gap-4">
                <span class="text-sm bg-amber-800 px-3 py-1 rounded-full hidden sm:block">{{ auth()->user()->role->name ?? 'Admin' }}</span>
                <div class="w-10 h-10 avatar-admin rounded-full flex items-center justify-center font-bold">
                    <i class="fas fa-user-shield text-white text-lg"></i>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-2 text-sm text-red-100 bg-red-700 rounded-full hover:bg-red-800 transition shadow-md hidden sm:block" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="h-1 bg-gradient-to-r from-transparent via-amber-400 to-transparent"></div>
    </header>

    <div class="flex">
        {{-- SIDEBAR --}}
        <aside id="sidebar" class="sidebar w-64 bg-gradient-to-b from-amber-900 to-red-900 min-h-screen text-amber-50 p-4 fixed md:relative z-10">
            <nav class="space-y-2">
                @include('layouts.navigation')
            </nav>
            <div class="mt-8 p-4 bg-amber-800/50 rounded-lg border border-amber-600/30">
                <p class="text-xs text-amber-200 text-center italic">"Gotong Royong Membangun Desa"</p>
            </div>
        </aside>

        <main id="main-content" class="flex-1 p-4 md:p-6 transition-all duration-300">
            
            {{-- HEADER HALAMAN --}}
            <div class="bg-white rounded-2xl p-6 mb-6 shadow-xl border-t-4 border-blue-600">
                <h2 class="text-2xl font-bold text-gray-800">📋 Data Penduduk Menunggu Validasi</h2>
                <p class="text-gray-500 mt-1">Halaman ini digunakan Operator untuk memverifikasi data penduduk baru.</p>
            </div>

            {{-- ALERT SUKSES/ERROR --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Gagal!</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            {{-- TABEL DATA PENDING --}}
            <div class="bg-white rounded-xl shadow-2xl p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama & NIK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TTL & Gender</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat (RT/RW)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($penduduksPending as $penduduk)
                            <tr class="hover:bg-amber-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $loop->iteration + $penduduksPending->firstItem() - 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $penduduk->nama }}</div>
                                    <div class="text-xs text-gray-500">NIK: {{ $penduduk->nik }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $penduduk->tempat_lahir }}, {{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $penduduk->jenis_kelamin }} ({{ $penduduk->umur ?? '?' }} thn)</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $penduduk->alamat }} ({{ $penduduk->rt }}/{{ $penduduk->rw }})
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    {{-- Tombol Aksi --}}
                                    <a href="{{ route('validasi.show', $penduduk->id) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-3 rounded text-xs transition">
                                        <i class="fas fa-search"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    <i class="fas fa-check-circle mr-2 text-green-500"></i> Tidak ada data penduduk yang menunggu validasi.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $penduduksPending->links() }}
                </div>
            </div>

            {{-- Catatan untuk Operator --}}
            <div class="mt-6 p-4 bg-red-50 border-l-4 border-red-400 text-red-700">
                <p class="font-bold"><i class="fas fa-exclamation-triangle mr-2"></i> PERINGATAN OPERATOR</p>
                <p class="text-sm">Pastikan Anda membandingkan data dengan dokumen asli (KTP/KK) sebelum melakukan verifikasi.</p>
            </div>

        </main>
    </div>

    <script>
        // Toggle Sidebar Script (Ambil dari dashboard admin/operator)
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>

</body>
</html>