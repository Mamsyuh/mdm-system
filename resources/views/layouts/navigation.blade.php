{{-- Tautan Dashboard: Sesuaikan dengan peran user --}}
@if (auth()->user()->role->name === 'admin')
    <a href="{{ route('admin.dashboard') }}"
        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition @if(Route::is('admin.dashboard')) bg-amber-700 shadow-lg @endif">
@else
        <a href="{{ route('operator.dashboard') }}"
            class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition @if(Route::is('operator.dashboard')) bg-amber-700 shadow-lg @endif">
    @endif
        <i class="fas fa-home"></i> <span>Dashboard</span>
    </a>

    {{-- Tautan VALIDASI DATA (MENU BARU & AKTIF) --}}
    <a href="{{ route('validasi.index') }}"
        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition @if(Route::is('validasi.index')) bg-amber-700 shadow-lg @endif">
        <i class="fas fa-check-double"></i> <span>Validasi Data</span>
    </a>

    <a href="{{ route('penduduk.index') }}"
        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition @if(Route::is('penduduk.index')) bg-amber-700 shadow-lg @endif">
        <i class="fas fa-users"></i> <span>Data Penduduk</span>
    </a>

    <a href="{{ route('kk.index') }}"
        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 hover:shadow-xl transition @if(Route::is(patterns: 'kk.index')) bg-amber-700 shadow-lg @endif">
        <i class="fas fa-address-card"></i> <span>Manajemen KK</span>
    </a>

    <a href="{{ route('surat.index') }}"
        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-amber-800 transition @if(Route::is('surat.index')) bg-amber-700 shadow-lg @endif">
        <i class="fas fa-envelope-open-text"></i> <span>Layanan Surat</span>
    </a>