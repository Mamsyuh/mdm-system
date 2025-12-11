@php
    // Variabel $kartuKeluargas dikirim dari KartuKeluargaController::index()
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kartu Keluarga - Desa Benangin</title>
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
            <div class="bg-white rounded-2xl p-6 mb-6 shadow-xl border-t-4 border-amber-600">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">Manajemen Kartu Keluarga</h2>
                    <a href="{{ route('kk.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                        <i class="fas fa-plus mr-1"></i> Tambah KK Baru
                    </a>
                </div>
                <p class="text-gray-500 mt-1">Daftar semua Kartu Keluarga yang tercatat di Desa Benangin.</p>
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

            {{-- TABEL DATA KK --}}
            <div class="bg-white rounded-xl shadow-2xl p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. KK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kepala Keluarga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat (RT/RW)</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($kk as $kartuKeluarga)
                            <tr class="hover:bg-amber-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $kartuKeluarga->no_kk }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kartuKeluarga->kepala_keluarga }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $kartuKeluarga->alamat }} ({{ $kartuKeluarga->rt }}/{{ $kartuKeluarga->rw }})
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">{{ $kartuKeluarga->anggota_count }} Jiwa</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium flex justify-center space-x-2">
                                    {{-- Tombol Detail --}}
                                    <a href="{{ route('kk.show', $kartuKeluarga->id) }}" class="text-blue-600 hover:text-blue-900" title="Detail"><i class="fas fa-eye"></i></a>
                                    
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('kk.edit', $kartuKeluarga->id) }}" class="text-amber-600 hover:text-amber-900" title="Edit"><i class="fas fa-edit"></i></a>
                                    
                                    {{-- Tombol PDF --}}
                                    <a href="{{ route('kk.exportPdf', $kartuKeluarga->id) }}" target="_blank" class="text-red-600 hover:text-red-900" title="Export PDF"><i class="fas fa-file-pdf"></i></a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('kk.destroy', $kartuKeluarga->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus KK ini? Semua anggota akan kehilangan relasi KK.');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    <i class="fas fa-info-circle mr-2"></i> Belum ada Kartu Keluarga yang tercatat.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $kk->links() }}
                </div>
            </div>
        </main>
    </div>

    <script>
        // Toggle Sidebar Script
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>

</body>
</html>