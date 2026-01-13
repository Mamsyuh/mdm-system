{{-- Tautan Dashboard --}}
@php
    $dashboardRoute = auth()->user()->role->name === 'admin' ? 'admin.dashboard' : 'operator.dashboard';
@endphp

<a href="{{ route($dashboardRoute) }}"
    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 group 
    {{ Route::is($dashboardRoute) 
        ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30 shadow-[0_0_15px_rgba(37,99,235,0.1)]' 
        : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
    <i class="fas fa-th-large text-lg {{ Route::is($dashboardRoute) ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }}"></i> 
    <span class="font-bold text-sm tracking-wide">Dashboard</span>
</a>

{{-- Tautan VALIDASI DATA --}}
<a href="{{ route('validasi.index') }}"
    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 group 
    {{ Route::is('validasi.index') 
        ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30 shadow-[0_0_15px_rgba(37,99,235,0.1)]' 
        : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
    <i class="fas fa-shield-check text-lg {{ Route::is('validasi.index') ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }}"></i> 
    <span class="font-bold text-sm tracking-wide">Validasi Data</span>
</a>

{{-- Tautan DATA PENDUDUK --}}
<a href="{{ route('penduduk.index') }}"
    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 group 
    {{ Route::is('penduduk.index') 
        ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30 shadow-[0_0_15px_rgba(37,99,235,0.1)]' 
        : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
    <i class="fas fa-users text-lg {{ Route::is('penduduk.index') ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }}"></i> 
    <span class="font-bold text-sm tracking-wide">Data Penduduk</span>
</a>

{{-- Tautan MANAJEMEN KK --}}
<a href="{{ route('kk.index') }}"
    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 group 
    {{ Route::is('kk.*') 
        ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30 shadow-[0_0_15px_rgba(37,99,235,0.1)]' 
        : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
    <i class="fas fa-address-card text-lg {{ Route::is('kk.*') ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }}"></i> 
    <span class="font-bold text-sm tracking-wide">Manajemen KK</span>
</a>

{{-- Tautan LAYANAN SURAT --}}
<a href="{{ route('surat.index') }}"
    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 group 
    {{ Route::is('surat.index') 
        ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30 shadow-[0_0_15_rgba(37,99,235,0.1)]' 
        : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
    <i class="fas fa-file-invoice text-lg {{ Route::is('surat.index') ? 'text-blue-400' : 'text-slate-500 group-hover:text-slate-300' }}"></i> 
    <span class="font-bold text-sm tracking-wide">Layanan Surat</span>
</a>