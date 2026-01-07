<div class="row">

    <div class="col-md-6">
        <label>NIK *</label>
        <input type="text" name="nik" class="form-control"
               value="{{ old('nik', $penduduk->nik ?? '') }}">
        @error('nik') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6">
        <label>Nama *</label>
        <input type="text" name="nama" class="form-control"
               value="{{ old('nama', $penduduk->nama ?? '') }}">
    </div>

    <div class="col-md-4">
        <label>Jenis Kelamin *</label>
        <select name="jenis_kelamin" class="form-control">
            <option value="">Pilih</option>
            <option value="L" {{ old('jenis_kelamin', $penduduk->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ old('jenis_kelamin', $penduduk->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>

    <div class="col-md-4">
        <label>RT</label>
        <input type="text" name="rt" class="form-control"
               value="{{ old('rt', $penduduk->rt ?? '') }}">
    </div>

    <div class="col-md-4">
        <label>RW</label>
        <input type="text" name="rw" class="form-control"
               value="{{ old('rw', $penduduk->rw ?? '') }}">
    </div>

    <div class="col-md-12">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control"
               value="{{ old('alamat', $penduduk->alamat ?? '') }}">
    </div>

</div>
