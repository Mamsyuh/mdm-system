<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- NIK --}}
    <div class="space-y-1.5">
        <label class="block font-semibold text-slate-700">NIK <span class="text-red-500">*</span></label>
        <input type="text" name="nik" 
               class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#7a201a] focus:border-[#7a201a] outline-none transition @error('nik') border-red-500 @enderror"
               value="{{ old('nik', $penduduk->nik ?? '') }}" placeholder="Masukkan 16 digit NIK">
        @error('nik') <small class="text-red-600 font-medium">{{ $message }}</small> @enderror
    </div>

    {{-- Nama --}}
    <div class="space-y-1.5">
        <label class="block font-semibold text-slate-700">Nama Lengkap <span class="text-red-500">*</span></label>
        <input type="text" name="nama" 
               class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#7a201a] focus:border-[#7a201a] outline-none transition"
               value="{{ old('nama', $penduduk->nama ?? '') }}" placeholder="Masukkan Nama Lengkap">
    </div>

    {{-- Baris Ketiga: Jenis Kelamin, RT, RW --}}
    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Jenis Kelamin --}}
        <div class="space-y-1.5">
            <label class="block font-semibold text-slate-700">Jenis Kelamin <span class="text-red-500">*</span></label>
            <select name="jenis_kelamin" 
                    class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#7a201a] outline-none transition">
                <option value="">-- Pilih --</option>
                <option value="L" {{ old('jenis_kelamin', $penduduk->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin', $penduduk->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        {{-- RT --}}
        <div class="space-y-1.5">
            <label class="block font-semibold text-slate-700">RT</label>
            <input type="text" name="rt" 
                   class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#7a201a] outline-none transition"
                   value="{{ old('rt', $penduduk->rt ?? '') }}" placeholder="000">
        </div>

        {{-- RW --}}
        <div class="space-y-1.5">
            <label class="block font-semibold text-slate-700">RW</label>
            <input type="text" name="rw" 
                   class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#7a201a] outline-none transition"
                   value="{{ old('rw', $penduduk->rw ?? '') }}" placeholder="000">
        </div>
    </div>

    {{-- Alamat --}}
    <div class="md:col-span-2 space-y-1.5">
        <label class="block font-semibold text-slate-700">Alamat Lengkap</label>
        <input type="text" name="alamat" 
               class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#7a201a] outline-none transition"
               value="{{ old('alamat', $penduduk->alamat ?? '') }}" placeholder="Contoh: Jl. Merdeka No. 10">
    </div>

</div>