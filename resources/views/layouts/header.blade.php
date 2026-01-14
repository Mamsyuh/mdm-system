<div class="flex items-center gap-4">
    {{-- Menu Toggle: Menggunakan hover slate/navy gelap --}}
    <button id="menu-toggle" class="md:hidden p-2 rounded-md hover:bg-slate-800 text-white transition">
        <i class="fas fa-bars text-xl"></i>
    </button>

    <div class="flex items-center gap-3">
        {{-- Logo Container: Menggunakan putih transparan (Glassmorphism) --}}
        <div class="w-11 h-11 bg-white/10 backdrop-blur-md rounded-xl flex items-center justify-center border border-white/20 shadow-inner">
            <span class="text-2xl">🏛️</span>
        </div>
        <div>
            <h1 class="text-xl font-black tracking-tight text-white uppercase leading-none">SISKEP BENANGIN 1</h1>
            <p class="text-blue-400 text-[10px] hidden md:block font-bold tracking-[0.15em] uppercase mt-1">Desa Digital Modern</p>
        </div>
    </div>
</div>

<div class="flex items-center gap-4">
    <div class="text-right hidden sm:block">
        <p class="text-sm font-bold">{{ auth()->user()->name }}</p>
        <p class="text-xs text-emerald-400 font-medium uppercase tracking-tighter">online</p>
    </div>

    {{-- Avatar: Menggunakan Emerald Green (Warna Tombol Landing Page Anda) --}}
    <div class="w-10 h-10 bg-emerald-500 text-emerald-950 rounded-xl flex items-center justify-center font-black shadow-lg shadow-emerald-500/20 border border-emerald-400/20">
        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
    </div>

    {{-- Logout Button: Menggunakan Slate gelap dengan hover Merah Aksi --}}
    <form method="POST" action="{{ route('logout') }}" class="m-0">
        @csrf
        <button type="submit"
            class="w-10 h-10 flex items-center justify-center text-sm text-slate-300 bg-slate-800 rounded-xl hover:bg-red-600 hover:text-white transition-all duration-300 shadow-lg group"
            title="Keluar dari Sistem">
            <i class="fas fa-power-off group-hover:scale-110 transition-transform"></i>
        </button>
    </form>
</div>