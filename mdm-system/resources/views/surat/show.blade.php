@php
    // Variabel $surat dikirim dari SuratController::show($surat)
    $isAdmin = auth()->user()->role->name === 'admin';
    $isPending = $surat->status === 'pending';
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengajuan Surat - {{ $surat->jenis_surat }}</title>
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
        {{-- ... Kode Header sama dengan index/kk.blade.php ... --}}
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
                
                <a href="{{ route('kk.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition">
                    <i class="fas fa-address-card"></i> <span>Manajemen KK</span>
                </a>

                <a href="{{ route('surat.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-amber-700 shadow-lg">
                    <i class="fas fa-envelope-open-text"></i> <span>Layanan Surat</span>
                </a>
            </nav>
            <div class="mt-8 p-4 bg-amber-800/50 rounded-lg border border-amber-600/30">
                <p class="text-xs text-amber-200 text-center italic">"Gotong Royong Membangun Desa"</p>
            </div>
        </aside>

        <main id="main-content" class="flex-1 p-4 md:p-6 transition-all duration-300">
            
            <a href="{{ route('surat.index') }}" class="text-blue-600 hover:underline mb-4 block font-semibold">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Pengajuan
            </a>

            {{-- ALERT STATUS --}}
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
                <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Pengajuan Surat: {{ $surat->jenis_surat }}</h2>
                
                <div class="grid md:grid-cols-3 gap-6 mb-8 text-sm">
                    
                    {{-- Blok Status Surat --}}
                    <div>
                        <h4 class="font-bold text-lg text-amber-700 mb-2 border-b">Status Pengajuan</h4>
                        <p><span class="font-semibold">Tanggal Pengajuan:</span> {{ $surat->created_at->format('d F Y H:i') }}</p>
                        <p><span class="font-semibold">Nomor Surat:</span> 
                            <span class="font-mono text-gray-900">{{ $surat->nomor_surat ?? 'BELUM TERBIT' }}</span>
                        </p>
                        <p class="mt-2"><span class="font-semibold">Status:</span> 
                            @if($surat->status == 'approved')
                                <span class="px-2 py-0.5 text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">DISETUJUI</span>
                            @elseif($surat->status == 'rejected')
                                <span class="px-2 py-0.5 text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">DITOLAK</span>
                            @else
                                <span class="px-2 py-0.5 text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">PENDING</span>
                            @endif
                        </p>
                    </div>

                    {{-- Blok Pemohon --}}
                    <div>
                        <h4 class="font-bold text-lg text-amber-700 mb-2 border-b">Detail Pemohon</h4>
                        <p><span class="font-semibold">Nama:</span> {{ $surat->penduduk->nama ?? '-' }}</p>
                        <p><span class="font-semibold">NIK:</span> {{ $surat->penduduk->nik ?? '-' }}</p>
                        <p><span class="font-semibold">Alamat:</span> {{ $surat->penduduk->alamat ?? '-' }} (RT/RW: {{ $surat->penduduk->rt ?? '-' }}/{{ $surat->penduduk->rw ?? '-' }})</p>
                    </div>

                    {{-- Blok Keperluan --}}
                    <div>
                        <h4 class="font-bold text-lg text-amber-700 mb-2 border-b">Keperluan Surat</h4>
                        <p class="text-gray-700 italic">{{ $surat->keperluan }}</p>
                        
                        @if ($surat->status === 'rejected')
                        <div class="mt-4 p-3 bg-red-50 border border-red-300 rounded">
                            <p class="font-semibold text-red-700">Catatan Penolakan:</p>
                            <p class="text-red-600 text-sm">{{ $surat->catatan }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- AKSI ADMIN (HANYA MUNCUL JIKA ADMIN & PENDING) --}}
                @if ($isAdmin && $isPending)
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-t pt-4">Aksi Persetujuan Admin</h3>
                    <div class="flex space-x-4">
                        
                        {{-- 1. FORM APPROVE --}}
                        <form method="POST" action="{{ route('surat.approve', $surat->id) }}" onsubmit="return confirm('YAKIN INGIN MENYETUJUI SURAT INI? Nomor surat akan diterbitkan otomatis.');">
                            @csrf
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                                <i class="fas fa-check-circle mr-2"></i> SETUJUI & TERBITKAN
                            </button>
                        </form>

                        {{-- 2. FORM REJECT --}}
                        <button onclick="document.getElementById('rejectModal').classList.remove('hidden')" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                            <i class="fas fa-times-circle mr-2"></i> TOLAK PENGAJUAN
                        </button>
                    </div>
                @endif
                
                {{-- Aksi Download (Approved) --}}
                @if ($surat->status === 'approved')
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-t pt-4">Dokumen Resmi</h3>
                    <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition inline-block">
                        <i class="fas fa-download mr-2"></i> Unduh Surat Resmi (Nomor: {{ $surat->nomor_surat }})
                    </a>
                @endif

            </div>
        </main>
    </div>

    {{-- MODAL REJECT (Untuk menolak pengajuan) --}}
    <div id="rejectModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-70 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-2xl">
            <h3 class="text-xl font-bold mb-4 text-red-700">Tolak Pengajuan Surat</h3>
            <form method="POST" action="{{ route('surat.reject', $surat->id) }}">
                @csrf
                <div class="mb-4">
                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan Wajib Diisi:</label>
                    <textarea id="catatan" name="catatan" rows="3" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 p-2" placeholder="Contoh: NIK pemohon belum divalidasi atau data keperluan tidak jelas."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Tolak Pengajuan</button>
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