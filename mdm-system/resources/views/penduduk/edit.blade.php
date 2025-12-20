@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 m-3">
    <h2 class="text-2xl font-bold mb-6">Edit Data Penduduk</h2>

    {{-- Error --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penduduk.update', $penduduk->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        {{-- NO KK --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">NO KK</label>
            <input type="text" name="no_kk" value="{{ $penduduk->no_kk }}"
                class="w-full border rounded p-2" required maxlength="16" placeholder="Masukkan Nomor Kartu Keluarga">
        </div>
        
        {{-- NIK --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">NIK</label>
            <input type="text" name="nik" value="{{ $penduduk->nik }}"
                class="w-full border rounded p-2" required maxlength="16" placeholder="Masukkan Nomor Induk Kependudukan">
        </div>

        {{-- Nama --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nama Lengkap</label>
            <input type="text" name="nama" value="{{ $penduduk->nama }}"
                class="w-full border rounded p-2" required placeholder="Masukkan Nama Lengkap">
        </div>

        {{-- Jenis Kelamin --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="w-full border rounded p-2" required>
                <option value="">-- Pilih --</option>
                <option value="L" {{ $penduduk->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $penduduk->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        {{-- Tempat Lahir --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" value="{{ $penduduk->tempat_lahir }}"
                class="w-full border rounded p-2" placeholder="Masukkan Tempat Lahir">
        </div>

        {{-- Tanggal Lahir --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Tanggal Lahir</label>
            <input type="datetime-local" name="tanggal_lahir" value="{{ $penduduk->tanggal_lahir }}"
                class="w-full border rounded p-2" onclick="this.showPicker();">
        </div>

        {{-- Alamat --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Alamat</label>
            <textarea name="alamat" class="w-full border rounded p-2" rows="3" placeholder="Masukkan Alamat">{{ $penduduk->alamat }}</textarea>
        </div>

        {{-- RT/RW --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block mb-1 font-semibold">RT</label>
                <input type="text" name="rt" value="{{ $penduduk->rt }}"
                    class="w-full border rounded p-2" placeholder="Masukkan RT">
            </div>
            <div>
                <label class="block mb-1 font-semibold">RW</label>
                <input type="text" name="rw" value="{{ $penduduk->rw }}"
                    class="w-full border rounded p-2" placeholder="Masukkan RW">
            </div>
        </div>

        {{-- Agama --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Agama</label>
            <select name="agama" class="w-full border rounded p-2">
                <option value="">-- Pilih --</option>
                <option value="ISLAM" {{ $penduduk->agama == 'ISLAM' ? 'selected' : '' }}>Islam</option>
                <option value="KRISTEN" {{ $penduduk->agama == 'KRISTEN' ? 'selected' : '' }}>Kristen</option>
                <option value="KATOLIK" {{ $penduduk->agama == 'KATOLIK' ? 'selected' : '' }}>Katolik</option>
                <option value="BUDDHA" {{ $penduduk->agama == 'BUDDHA' ? 'selected' : '' }}>Buddha</option>
                <option value="HINDU" {{ $penduduk->agama == 'HINDU' ? 'selected' : '' }}>Hindu</option>
                <option value="KONGHUCU" {{ $penduduk->agama == 'KONGHUCU' ? 'selected' : '' }}>Konghucu</option>
            </select>
        </div>

        {{-- Status Perkawinan --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Status Perkawinan</label>
            <select name="status_perkawinan" class="w-full border rounded p-2">
                <option value="">-- Pilih --</option>
                <option value="BELUM KAWIN" {{ $penduduk->status_perkawinan == 'BELUM KAWIN' ? 'selected' : '' }}>Belum Kawin</option>
                <option value="KAWIN" {{ $penduduk->status_perkawinan == 'KAWIN' ? 'selected' : '' }}>Kawin</option>
                <option value="CERAI HIDUP" {{ $penduduk->status_perkawinan == 'CERAI HIDUP' ? 'selected' : '' }}>Cerai Hidup</option>
                <option value="CERAI MATI" {{ $penduduk->status_perkawinan == 'CERAI MATI' ? 'selected' : '' }}>Cerai Mati</option>
            </select>
        </div>

        {{-- Status Hubungan dalam Keluarga --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Status Hubungan dalam Keluarga</label>
            <select name="hubungan_keluarga" class="w-full border rounded p-2">
                <option value="">-- Pilih --</option>
                <option value="KEPALA KELUARGA" {{ $penduduk->hubungan_keluarga == 'KEPALA KELUARGA' ? 'selected' : '' }}>Kepala Keluarga</option>
                <option value="ISTRI" {{ $penduduk->hubungan_keluarga == 'ISTRI' ? 'selected' : '' }}>Istri</option>
                <option value="ANAK" {{ $penduduk->hubungan_keluarga == 'ANAK' ? 'selected' : '' }}>Anak</option>
                <option value="FAMILI LAIN" {{ $penduduk->hubungan_keluarga == 'FAMILI LAIN' ? 'selected' : '' }}>Famili Lain</option>
                <option value="CUCU" {{ $penduduk->hubungan_keluarga == 'CUCU' ? 'selected' : '' }}>Cucu</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nama Ayah</label>
            <input type="text" name="nama_ayah" class="w-full border rounded p-2" placeholder="Masukkan Nama Ayah" value="{{ $penduduk->nama_ayah }}"></input>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nama Ibu</label>
            <input type="text" name="nama_ibu" class="w-full border rounded p-2" placeholder="Masukkan Nama Ibu" value="{{ $penduduk->nama_ibu }}"></input>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end gap-2 mt-6">
            <a href="{{ route('penduduk.index') }}"
               class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
               Batal
            </a>

            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
