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
    <span
        class="text-sm bg-amber-800 px-3 py-1 rounded-full hidden sm:block">{{ auth()->user()->role->name == 'Administrator' ? 'Admin' : 'Operator' }}</span>
    <div class="w-10 h-10 bg-amber-700 rounded-full flex items-center justify-center font-bold">
        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
    </div>
    {{-- Logout Button --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="p-2 text-sm text-red-100 bg-red-700 rounded-full hover:bg-red-800 transition shadow-md hidden sm:block"
            title="Logout">
            <i class="fas fa-sign-out-alt"></i>
        </button>
    </form>
</div>