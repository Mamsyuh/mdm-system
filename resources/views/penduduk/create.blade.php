@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-2xl p-8 m-6 border border-slate-100">

        <div class="flex items-center gap-3 mb-8">
            <div class="w-1.5 h-8 bg-blue-600 rounded-full"></div>
            <h2 class="text-2xl font-bold text-blue-900">Tambah Data Penduduk</h2>
        </div>

        {{-- Error --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                <p class="font-bold mb-1">Terjadi Kesalahan:</p>
                <ul class="list-disc pl-6 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('penduduk.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- NO KK --}}
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">NO KK</label>
                    <input type="text" name="no_kk" value="{{ old('no_kk') }}"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        required maxlength="16" placeholder="Masukkan 16 digit No. KK">
                </div>

                {{-- NIK --}}
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik') }}"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        required maxlength="16" placeholder="Masukkan 16 digit NIK">
                </div>
            </div>

            {{-- Nama --}}
            <div>
                <label class="block mb-1.5 font-semibold text-slate-700">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                    class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    required placeholder="Masukkan Nama Lengkap Sesuai KTP">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Jenis Kelamin --}}
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">Jenis Kelamin</label>
                    <select name="jenis_kelamin"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                {{-- Tempat Lahir --}}
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        placeholder="Contoh: Barito Utara">
                </div>

                {{-- Tanggal Lahir --}}
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        onclick="this.showPicker();">
                </div>
            </div>

            {{-- Alamat --}}
            <div>
                <label class="block mb-1.5 font-semibold text-slate-700">Alamat</label>
                <textarea name="alamat"
                    class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                    rows="2" placeholder="Masukkan Nama Jalan/Dusun">{{ old('alamat') }}</textarea>
            </div>

            {{-- RT/RW --}}
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">RT</label>
                    <input type="text" name="rt" value="{{ old('rt') }}"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        placeholder="000">
                </div>
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">RW</label>
                    <input type="text" name="rw" value="{{ old('rw') }}"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        placeholder="000">
                </div>
            </div>

            {{-- Agama --}}
            <div>
                <label class="block mb-1.5 font-semibold text-slate-700">Agama</label>
                <select name="agama"
                    class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    <option value="">-- Pilih --</option>
                    <option value="ISLAM">Islam</option>
                    <option value="KRISTEN">Kristen</option>
                    <option value="KATOLIK">Katolik</option>
                    <option value="BUDDHA">Buddha</option>
                    <option value="HINDU">Hindu</option>
                    <option value="KONGHUCU">Konghucu</option>
                </select>
            </div>

            {{-- Status Hubungan dalam Keluarga --}}
            <div>
                <label class="block mb-1.5 font-semibold text-slate-700">Status Hubungan dalam Keluarga</label>
                <select name="hubungan_keluarga"
                    class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    <option value="">-- Pilih --</option>
                    <option value="KEPALA KELUARGA">Kepala Keluarga</option>
                    <option value="ISTRI">Istri</option>
                    <option value="ANAK">Anak</option>
                    <option value="FAMILI LAIN">Famili Lain</option>
                    <option value="CUCU">Cucu</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">Nama Ayah</label>
                    <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        placeholder="Nama Ayah">
                </div>

                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">Nama Ibu</label>
                    <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        placeholder="Nama Ibu">
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3 mt-10 pt-6 border-t border-slate-100">
                <a href="{{ route('penduduk.index') }}"
                    class="px-6 py-2.5 bg-slate-100 text-slate-600 font-semibold rounded-xl hover:bg-slate-200 transition">
                    Batal
                </a>

                <button type="submit"
                    class="px-8 py-2.5 bg-emerald-500 text-emerald-950 font-bold rounded-xl hover:bg-emerald-400 shadow-lg shadow-emerald-200 transition transform active:scale-95">
                    Simpan Data
                </button>
            </div>

        </form>
    </div>
@endsection