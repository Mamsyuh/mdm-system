@php
    // Variabel $surats dikirim dari SuratController::index()
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Surat - Desa Benangin</title>
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
</head>
<body class="bg-batik min-h-screen">

    {{-- HEADER --}}
    <header class="bg-gradient-to-r from-amber-900 via-red-900 to-amber-900 text-amber-50 shadow-lg sticky top-0 z-20">
        {{-- ... Kode Header sama dengan index/kk.blade.php ... --}}
        <div class="h-2 bg-gradient-to-r from-amber-500 via-red-500 to-amber-500"></div>
        <div class="px-6 py-4 flex items-center justify-between">
            @include('layouts.header')
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
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Pengajuan Surat</h2>
                    <a href="{{ route('surat.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                        <i class="fas fa-plus mr-1"></i> Buat Pengajuan Baru
                    </a>
                </div>
                <p class="text-gray-500 mt-1">Daftar semua pengajuan surat pengantar yang masuk ke sistem.</p>
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

            {{-- TABEL DATA SURAT --}}
            <div class="bg-white rounded-xl shadow-2xl p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Surat/Tgl</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemohon</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Surat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keperluan</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($surats as $surat)
                            <tr class="hover:bg-amber-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                    {{ $surat->nomor_surat ?? 'BELUM TERBIT' }}
                                    <div class="text-xs text-gray-500">{{ $surat->created_at->format('d/m/Y') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $surat->penduduk->nama ?? 'Data Tidak Ditemukan' }}
                                    <div class="text-xs text-gray-500">{{ $surat->penduduk->nik ?? '' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $surat->jenis_surat }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ Str::limit($surat->keperluan, 40) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    @if($surat->status == 'approved')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                                    @elseif($surat->status == 'rejected')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium flex justify-center space-x-2">
                                    {{-- Tombol Aksi Detail --}}
                                    <a href="{{ route('surat.show', $surat->id) }}" class="text-blue-600 hover:text-blue-900" title="Detail Pengajuan"><i class="fas fa-search"></i></a>
                                    
                                    {{-- Tombol Edit hanya jika status masih Pending --}}
                                    @if($surat->status == 'pending')
                                        <a href="{{ route('surat.edit', $surat->id) }}" class="text-amber-600 hover:text-amber-900" title="Edit Pengajuan"><i class="fas fa-edit"></i></a>
                                    @endif
                                    
                                    {{-- Tombol Cetak/Download hanya jika Approved --}}
                                    @if($surat->status == 'approved')
                                        <a href="#" target="_blank" class="text-green-600 hover:text-green-900" title="Cetak Surat"><i class="fas fa-print"></i></a>
                                    @endif

                                    {{-- Tombol Hapus (Admin Only - diatur di controller) --}}
                                    @if(auth()->user()->role->name === 'admin')
                                    <form action="{{ route('surat.destroy', $surat->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus Permanen"><i class="fas fa-trash"></i></button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    <i class="fas fa-info-circle mr-2"></i> Belum ada pengajuan surat yang tercatat.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $surats->links() }}
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