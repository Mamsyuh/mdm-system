@php
    // Variabel $kk dan $anggota dikirim dari KartuKeluargaController::show($kk)
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail KK {{ $kk->no_kk }}</title>
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
        {{-- ... Kode Header ... --}}
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
                <span class="text-sm bg-amber-800 px-3 py-1 rounded-full hidden sm:block">{{ auth()->user()->role->name ?? 'Admin' }}</span>
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
                {{-- ... Menu Sidebar ... --}}
                @if (auth()->user()->role->name === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                @else
                    <a href="{{ route('operator.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                @endif
                        <i class="fas fa-home"></i> <span>Dashboard</span>
                    </a>

                <a href="{{ route('validasi.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                    <i class="fas fa-check-double"></i> <span>Validasi Data</span>
                </a>

                <a href="{{ route('penduduk.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                    <i class="fas fa-users"></i> <span>Data Penduduk</span>
                </a>
                
                <a href="{{ route('kk.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-amber-700 shadow-lg">
                    <i class="fas fa-address-card"></i> <span>Manajemen KK</span>
                </a>
                
                <a href="#" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                    <i class="fas fa-envelope-open-text"></i> <span>Layanan Surat</span>
                </a>
            </nav>
            <div class="mt-8 p-4 bg-amber-800/50 rounded-lg border border-amber-600/30">
                <p class="text-xs text-amber-200 text-center italic">"Gotong Royong Membangun Desa"</p>
            </div>
        </aside>

        <main id="main-content" class="flex-1 p-4 md:p-6 transition-all duration-300">
            
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('kk.index') }}" class="text-blue-600 hover:underline font-semibold">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar KK
                </a>
                <div class="flex space-x-3">
                    <a href="{{ route('kk.exportPdf', $kk->id) }}" target="_blank" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                        <i class="fas fa-file-pdf mr-1"></i> Export PDF
                    </a>
                    <a href="{{ route('kk.edit', $kk->id) }}" class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                        <i class="fas fa-edit mr-1"></i> Edit KK
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-2xl p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Detail Kartu Keluarga (No. KK: {{ $kk->no_kk }})</h2>
                
                {{-- DETAIL KK --}}
                <div class="grid md:grid-cols-2 gap-4 mb-8 text-sm border p-4 rounded-lg bg-amber-50">
                    <div>
                        <p class="font-bold text-lg text-amber-800">Kepala Keluarga:</p> 
                        <p class="text-xl font-extrabold text-gray-800">{{ $kk->kepala_keluarga }}</p>
                    </div>
                    <div>
                        <p class="font-bold text-lg text-amber-800">Alamat Lengkap:</p> 
                        <p class="text-gray-700">{{ $kk->alamat }} (RT {{ $kk->rt }}/RW {{ $kk->rw }})</p>
                    </div>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2"><i class="fas fa-users mr-2 text-blue-600"></i> Daftar Anggota Keluarga ({{ $kk->anggota->count() }} Jiwa)</h3>
                
                {{-- TABEL ANGGOTA KELUARGA --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama & NIK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hubungan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Lahir & Usia</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Validasi</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($kk->anggota as $anggota)
                            <tr class="hover:bg-blue-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $anggota->nama }}</div>
                                    <div class="text-xs text-gray-500">NIK: {{ $anggota->nik }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $anggota->hubungan_keluarga }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d/m/Y') }} ({{ $anggota->umur ?? '?' }} thn)
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($anggota->status_validasi == 'valid')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Valid</span>
                                    @elseif($anggota->status_validasi == 'pending')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    {{-- Tombol Detail Penduduk (Arahkan ke PendudukController::show) --}}
                                    <a href="{{ route('penduduk.show', $anggota->id) }}" class="text-blue-600 hover:text-blue-900" title="Lihat Detail Penduduk"><i class="fas fa-user-circle"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    <i class="fas fa-exclamation-circle mr-2"></i> Belum ada anggota keluarga yang terdaftar dalam KK ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
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