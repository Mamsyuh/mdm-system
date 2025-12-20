<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penduduk - Desa Benangin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

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
</head>

<body class="bg-batik min-h-screen">

    {{-- HEADER (Logout dan Avatar Admin) --}}
    <header class="bg-gradient-to-r from-amber-900 via-red-900 to-amber-900 text-amber-50 shadow-lg sticky top-0 z-20">
        <div class="h-2 bg-gradient-to-r from-amber-500 via-red-500 to-amber-500"></div>
        <div class="px-6 py-4 flex items-center justify-between">
            @include('layouts.header')
        </div>
        <div class="h-1 bg-gradient-to-r from-transparent via-amber-400 to-transparent"></div>
    </header>

    <div class="flex">
        <aside id="sidebar"
            class="sidebar w-64 bg-gradient-to-b from-amber-900 to-red-900 min-h-screen text-amber-50 p-4 fixed md:relative z-10">
            <nav class="space-y-2">
                @include('layouts.navigation')
            </nav>
            <div class="mt-8 p-4 bg-amber-800/50 rounded-lg border border-amber-600/30">
                <p class="text-xs text-amber-200 text-center italic">"Gotong Royong Membangun Desa"</p>
            </div>
        </aside>

        <main id="main-content" class="flex-1 p-4 md:p-6 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 py-6">
                {{-- Breadcrumb --}}
                <nav class="mb-4 text-sm">
                    <a href="{{ route('admin.dashboard') }}" class="text-amber-600 hover:text-amber-800">Dashboard</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-600">Data Penduduk</span>
                </nav>

                {{-- Alert --}}
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                {{-- Header & Actions --}}
                {{-- Statistik Penduduk --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-white p-4 rounded-xl shadow border-l-4 border-amber-600">
                        <p class="text-gray-600 text-sm">Total Penduduk</p>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $statistik['total'] }}</h2>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow border-l-4 border-blue-600">
                        <p class="text-gray-600 text-sm">Laki-laki</p>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $statistik['laki'] }}</h2>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow border-l-4 border-pink-600">
                        <p class="text-gray-600 text-sm">Perempuan</p>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $statistik['perempuan'] }}</h2>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Data Penduduk</h1>
                            <p class="text-gray-600 text-sm">Kelola data penduduk Desa Benangin</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('penduduk.create') }}"
                                class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                            <button onclick="toggleFilter()"
                                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                        </div>
                    </div>

                    {{-- Filter Panel --}}
                    <div id="filterPanel" class="hidden mt-4 pt-4 border-t">
                        <form method="GET" action="{{ route('penduduk.index') }}" class="grid md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Cari (Nama/NIK/KK)</label>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                                    placeholder="Cari...">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                <select name="jenis_kelamin"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                                    <option value="">Semua</option>
                                    <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">RT</label>
                                <select name="rt"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                                    <option value="">Semua RT</option>
                                    @forelse($rtList as $rt)
                                        <option value="{{ $rt->rt }}">RT {{ $rt->rt }}</option>
                                    @empty
                                        <option value="">Tidak ada data</option>
                                    @endforelse
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status Validasi</label>
                                <select name="status_validasi"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                                    <option value="">Semua</option>
                                    <option value="valid" {{ request('status_validasi') == 'valid' ? 'selected' : '' }}>
                                        Valid
                                    </option>
                                    <option value="pending" {{ request('status_validasi') == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="reject" {{ request('status_validasi') == 'reject' ? 'selected' : '' }}>
                                        Reject
                                    </option>
                                </select>
                            </div>
                            <div class="md:col-span-4 flex gap-2">
                                <button type="submit"
                                    class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg transition">
                                    <i class="fas fa-search mr-2"></i> Cari
                                </button>
                                <button type="reset"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg transition">
                                    <i class="fas fa-redo mr-2"></i> Reset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Table --}}
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-amber-600 to-amber-700 text-white">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">NIK
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">L/P
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Umur
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">RT/RW
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Status
                                    </th>
                                    <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($penduduks as $index => $penduduk)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3 text-sm">{{ $penduduks->firstItem() + $index }}</td>
                                        <td class="px-4 py-3 text-sm font-mono">{{ $penduduk->nik }}</td>
                                        <td class="px-4 py-3 text-sm font-medium">{{ $penduduk->nama }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            @if($penduduk->jenis_kelamin == 'L')
                                                <span class="text-blue-600"><i class="fas fa-mars"></i></span>
                                            @else
                                                <span class="text-pink-600"><i class="fas fa-venus"></i></span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm">{{ $penduduk->umur }} th</td>
                                        <td class="px-4 py-3 text-sm">{{ $penduduk->rt }}/{{ $penduduk->rw }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            @if($penduduk->status_validasi == 'Valid')
                                                <span
                                                    class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">Valid</span>
                                            @elseif($penduduk->status_validasi == 'Perlu Verifikasi')
                                                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">Perlu
                                                    Verifikasi</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded-full">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm text-center">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('penduduk.edit', $penduduk) }}"
                                                    class="text-amber-600 hover:text-amber-800" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('penduduk.destroy', $penduduk) }}" method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                                            <i class="fas fa-inbox text-4xl mb-2"></i>
                                            <p>Tidak ada data penduduk</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="px-4 py-3 bg-gray-50">
                        {{ $penduduks->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>



    <script>
        function toggleFilter() {
            const panel = document.getElementById('filterPanel');
            panel.classList.toggle('hidden');
        }
    </script>

</body>

</html>