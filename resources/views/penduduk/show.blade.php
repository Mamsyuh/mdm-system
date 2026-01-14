@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-xl rounded-2xl p-8 m-6 border border-slate-100">

    {{-- JUDUL DENGAN AKSEN BIRU --}}
    <div class="flex items-center gap-3 mb-8">
        <div class="w-1.5 h-8 bg-blue-600 rounded-full"></div>
        <h2 class="text-2xl font-bold text-blue-900">Show Data Penduduk</h2>
    </div>
        
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- NO KK --}}
        <div>
            <label class="block mb-1.5 font-semibold text-slate-700">NO KK</label>
            <input type="text" name="no_kk" value="{{ $penduduk->no_kk }}"
                class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" required maxlength="16" placeholder="Masukkan 16 digit No. KK" disabled>
        </div>

        {{-- NIK --}}
        <div>
            <label class="block mb-1.5 font-semibold text-slate-700">NIK</label>
            <input type="text" name="nik" value="{{ $penduduk->nik }}"
                class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" required maxlength="16" placeholder="Masukkan 16 digit NIK" disabled>
        </div>
    </div>

    {{-- Nama --}}
    <div>
        <label class="block mb-1.5 font-semibold text-slate-700">Nama Lengkap</label>
        <input type="text" name="nama" value="{{ $penduduk->nama }}"
            class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" required placeholder="Masukkan Nama Lengkap" disabled>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Jenis Kelamin --}}
        <div>
            <label class="block mb-1.5 font-semibold text-slate-700">Jenis Kelamin</label>
            <input type="text" name="nama" value="{{ $penduduk->jenis_kelamin }}"
            class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" required placeholder="Masukkan Jenis Kelamin" disabled>
        </div>

        {{-- Tempat Lahir --}}
        <div>
            <label class="block mb-1.5 font-semibold text-slate-700">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" value="{{ $penduduk->tempat_lahir }}"
                class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="Tempat Lahir" disabled>
        </div>

        {{-- Tanggal Lahir --}}
        <div>
            <label class="block mb-1.5 font-semibold text-slate-700">Tanggal Lahir</label>
            <input type="datetime-local" name="tanggal_lahir" value="{{ $penduduk->tanggal_lahir }}"
                    class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" onclick="this.showPicker();" disabled>
        </div>
    </div>

    {{-- Alamat --}}
    <div>
        <label class="block mb-1.5 font-semibold text-slate-700">Alamat</label>
        <textarea name="alamat" class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" rows="2" placeholder="Masukkan Alamat" disabled>{{ $penduduk->alamat }}</textarea>
    </div>

    {{-- RT/RW --}}
    <div class="grid grid-cols-2 gap-6">
        <div>
            <label class="block mb-1.5 font-semibold text-slate-700">RT</label>
            <input type="text" name="rt" value="{{ $penduduk->rt }}"
                class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="RT" disabled>
        </div>
        <div>
            <label class="block mb-1.5 font-semibold text-slate-700">RW</label>
            <input type="text" name="rw" value="{{ $penduduk->rw }}"
                class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="RW" disabled>
        </div>
    </div>

    {{-- Agama --}}
    <div>
        <label class="block mb-1.5 font-semibold text-slate-700">Agama</label>
        <input type="text" name="nama" value="{{ $penduduk->agama }}"
            class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" required placeholder="Masukkan Agama" disabled>
    </div>

    {{-- Status Hubungan dalam Keluarga --}}
    <div>
        <label class="block mb-1.5 font-semibold text-slate-700">Status Hubungan dalam Keluarga</label>
        <input type="text" name="nama" value="{{ $penduduk->hubungan_keluarga }}"
            class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" required placeholder="Masukkan Jenis Kelamin" disabled>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Nama Ayah --}}
        <div>
            <label class="block mb-1.5 font-semibold text-slate-700">Nama Ayah</label>
            <input type="text" name="nama_ayah" value="{{ $penduduk->nama_ayah }}" class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="Nama Ayah" disabled>
        </div>

        {{-- Nama Ibu --}}
        <div>
            <label class="block mb-1.5 font-semibold text-slate-700">Nama Ibu</label>
            <input type="text" name="nama_ibu" value="{{ $penduduk->nama_ibu }}" class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="Nama Ibu" disabled>
        </div>
    </div>
</div>
@endsection