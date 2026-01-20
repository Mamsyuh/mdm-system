@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-2xl p-8 m-6 border border-slate-100">

        {{-- JUDUL DENGAN AKSEN BIRU --}}
        <div class="flex items-center gap-3 mb-8">
            <div class="w-1.5 h-8 bg-blue-600 rounded-full"></div>
            <h2 class="text-2xl font-bold text-blue-900">Edit Data Penduduk</h2>
        </div>

        {{-- ERROR MESSAGES --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                <p class="font-bold mb-1 text-sm">Terjadi Kesalahan:</p>
                <ul class="list-disc pl-6 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('penduduk.update', $penduduk->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- NO KK --}}
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">NO KK</label>
                    <input type="text" name="no_kk" value="{{ $penduduk->no_kk }}"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        required maxlength="16" placeholder="Masukkan 16 digit No. KK">
                </div>

                {{-- NIK --}}
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">NIK</label>

                    <div class="flex gap-2">
                        <input type="text" id="nik" name="nik" value="{{ old('nik') }}"
                            class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            required maxlength="16" placeholder="Masukkan 16 digit NIK">

                        <button type="button" onclick="cariNik()"
                            class="px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition">
                            Cari
                        </button>
                    </div>
                </div>
            </div>

            {{-- Nama --}}
            <div>
                <label class="block mb-1.5 font-semibold text-slate-700">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ $penduduk->nama }}"
                    class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                    required placeholder="Masukkan Nama Lengkap">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Jenis Kelamin --}}
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ $penduduk->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $penduduk->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                {{-- Tempat Lahir --}}
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ $penduduk->tempat_lahir }}"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        placeholder="Tempat Lahir">
                </div>

                {{-- Tanggal Lahir --}}
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">Tanggal Lahir</label>
                    <input type="datetime-local" id="tanggal_lahir" name="tanggal_lahir"
                        value="{{ $penduduk->tanggal_lahir }}"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        onclick="this.showPicker();">
                </div>
            </div>

            {{-- Alamat --}}
            <div>
                <label class="block mb-1.5 font-semibold text-slate-700">Alamat</label>
                <textarea name="alamat"
                    class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                    rows="2" placeholder="Masukkan Alamat">{{ $penduduk->alamat }}</textarea>
            </div>

            {{-- RT/RW --}}
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">RT</label>
                    <input type="text" name="rt" value="{{ $penduduk->rt }}"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        placeholder="RT">
                </div>
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">RW</label>
                    <input type="text" name="rw" value="{{ $penduduk->rw }}"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        placeholder="RW">
                </div>
            </div>

            {{-- Agama --}}
            <div>
                <label class="block mb-1.5 font-semibold text-slate-700">Agama</label>
                <select name="agama"
                    class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    <option value="">-- Pilih --</option>
                    <option value="ISLAM" {{ $penduduk->agama == 'ISLAM' ? 'selected' : '' }}>Islam</option>
                    <option value="KRISTEN" {{ $penduduk->agama == 'KRISTEN' ? 'selected' : '' }}>Kristen</option>
                    <option value="KATOLIK" {{ $penduduk->agama == 'KATOLIK' ? 'selected' : '' }}>Katolik</option>
                    <option value="BUDDHA" {{ $penduduk->agama == 'BUDDHA' ? 'selected' : '' }}>Buddha</option>
                    <option value="HINDU" {{ $penduduk->agama == 'HINDU' ? 'selected' : '' }}>Hindu</option>
                    <option value="KONGHUCU" {{ $penduduk->agama == 'KONGHUCU' ? 'selected' : '' }}>Konghucu</option>
                </select>
            </div>

            {{-- Status Hubungan dalam Keluarga --}}
            <div>
                <label class="block mb-1.5 font-semibold text-slate-700">Status Hubungan dalam Keluarga</label>
                <select name="hubungan_keluarga"
                    class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    <option value="">-- Pilih --</option>
                    <option value="KEPALA KELUARGA" {{ $penduduk->hubungan_keluarga == 'KEPALA KELUARGA' ? 'selected' : '' }}>
                        Kepala Keluarga</option>
                    <option value="ISTRI" {{ $penduduk->hubungan_keluarga == 'ISTRI' ? 'selected' : '' }}>Istri</option>
                    <option value="ANAK" {{ $penduduk->hubungan_keluarga == 'ANAK' ? 'selected' : '' }}>Anak</option>
                    <option value="FAMILI LAIN" {{ $penduduk->hubungan_keluarga == 'FAMILI LAIN' ? 'selected' : '' }}>Famili
                        Lain</option>
                    <option value="CUCU" {{ $penduduk->hubungan_keluarga == 'CUCU' ? 'selected' : '' }}>Cucu</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Ayah --}}
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">Nama Ayah</label>
                    <input type="text" name="nama_ayah" value="{{ $penduduk->nama_ayah }}"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        placeholder="Nama Ayah">
                </div>

                {{-- Nama Ibu --}}
                <div>
                    <label class="block mb-1.5 font-semibold text-slate-700">Nama Ibu</label>
                    <input type="text" name="nama_ibu" value="{{ $penduduk->nama_ibu }}"
                        class="w-full border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition"
                        placeholder="Nama Ibu">
                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="flex justify-end gap-3 mt-10 pt-6 border-t border-slate-100">
                <a href="{{ route('penduduk.index') }}"
                    class="px-6 py-2.5 bg-slate-100 text-slate-600 font-semibold rounded-xl hover:bg-slate-200 transition">
                    Batal
                </a>

                <button type="submit"
                    class="px-8 py-2.5 bg-emerald-500 text-emerald-950 font-bold rounded-xl hover:bg-emerald-400 shadow-lg shadow-emerald-200 transition transform active:scale-95">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <script>
        function cariNik() {
            const nik = document.getElementById('nik').value;

            if (nik.length !== 16) {
                alert("NIK harus 16 digit!");
                return;
            }

            // Ambil tanggal lahir dari NIK
            let tanggal = parseInt(nik.substr(6, 2));
            let bulan = nik.substr(8, 2);
            let tahun = nik.substr(10, 2);

            // Tentukan gender
            let gender = 'L';
            if (tanggal > 40) {
                gender = 'P';
                tanggal = tanggal - 40;
            }

            // Konversi tahun (asumsi 1900-2099)
            let tahunFull = parseInt(tahun) > 30 ? '19' + tahun : '20' + tahun;

            // Format tanggal YYYY-MM-DD
            let tanggalFormatted = `${tahunFull}-${bulan}-${String(tanggal).padStart(2, '0')}`;

            // Set ke form
            document.getElementById('tanggal_lahir').value = tanggalFormatted;
            document.getElementById('jenis_kelamin').value = gender;
        }
    </script>
@endsection