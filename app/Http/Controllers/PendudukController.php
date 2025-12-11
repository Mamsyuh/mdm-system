<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendudukExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PendudukController extends Controller
{
    // ===============================
    // INDEX + SEARCH & FILTER + STATISTIK
    // ===============================
    public function index(Request $request)
    {
        $q = Penduduk::query();

        // Pencarian
        if ($request->nik) {
            $q->where('nik', 'like', "%{$request->nik}%");
        }

        if ($request->nama) {
            $q->where('nama', 'like', "%{$request->nama}%");
        }

        // Filter
        if ($request->jenis_kelamin) {
            $q->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->rt) {
            $q->where('rt', $request->rt);
        }

        if ($request->rw) {
            $q->where('rw', $request->rw);
        }

        if ($request->usia_min) {
            $q->whereRaw("TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= ?", [$request->usia_min]);
        }

        if ($request->usia_max) {
            $q->whereRaw("TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) <= ?", [$request->usia_max]);
        }

        $penduduks = $q->orderBy('nama')->paginate(20)->where('status_validasi', '!=', 'Tidak Valid');

        // ============================
        // STATISTIK
        // ============================
        $rtList = Penduduk::select('rt')->distinct()->orderBy('rt')->get();

        $statistik = [
            'total' => Penduduk::count(),
            'laki' => Penduduk::where('jenis_kelamin', 'L')->count(),
            'perempuan' => Penduduk::where('jenis_kelamin', 'P')->count(),
            'valid' => Penduduk::where('status_validasi', 'valid')->count(),
        ];

        return view('penduduk.index', compact('penduduks', 'rtList', 'statistik'));
    }

    // ===============================
    // CREATE
    // ===============================
    public function create()
    {
        return view('penduduk.create');
    }

    // ===============================
    // STORE
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:penduduks,nik',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        // Validasi NIK
        $nikCheck = $this->validateNIK($request->nik);
        if ($nikCheck !== true) {
            return back()->withErrors(['nik' => $nikCheck])->withInput();
        }

        // Validasi Kepala Keluarga
        if($request->nik == "Kepala Keluarga"){
            $kkCheck = "Iya";
        } else {
            $kkCheck = "Tidak";
        }

        Penduduk::create([
            'kecamatan' => 'Teweh Timur',
            'desa' => 'Benangin 1',
            'kepala_keluarga' => $kkCheck,
            'no_kk' => $request->no_kk,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'hubungan_keluarga' => $request->hubungan_keluarga,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'status_validasi' => 'Perlu Verifikasi',
        ]);

        return redirect()->route('penduduk.index')
            ->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    // ===============================
    // EDIT
    // ===============================
    public function edit(Penduduk $penduduk)
    {
        return view('penduduk.edit', compact('penduduk'));
    }

    // ===============================
    // UPDATE
    // ===============================
    public function update(Request $request, Penduduk $penduduk)
    {
        $request->validate([
            'nik' => 'required|unique:penduduks,nik,' . $penduduk->id,
            'nama' => 'required',
        ]);

        // Validasi NIK
        $nikCheck = $this->validateNIK($request->nik);
        if ($nikCheck !== true) {
            return back()->withErrors(['nik' => $nikCheck])->withInput();
        }

        // Validasi Kepala Keluarga
        if($request->nik == "Kepala Keluarga"){
            $kkCheck = "Iya";
        } else {
            $kkCheck = "Tidak";
        }

        $penduduk->update([
            'kepala_keluarga' => $kkCheck,
            'no_kk' => $request->no_kk,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'hubungan_keluarga' => $request->hubungan_keluarga,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu
        ]);

        return redirect()->route('penduduk.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    // ===============================
    // DELETE
    // ===============================
    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();
        return redirect()->route('penduduk.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    // ===============================
    // VALIDASI NIK
    // ===============================
    private function validateNIK($nik)
    {
        if (strlen($nik) !== 16 || !ctype_digit($nik)) {
            return "NIK harus 16 digit angka.";
        }

        $day = substr($nik, 6, 2);
        $month = substr($nik, 8, 2);
        $year = substr($nik, 10, 2);

        if ($day > 40) $day -= 40;

        $year = ($year <= date('y')) ? "20$year" : "19$year";

        if (!checkdate($month, $day, $year)) {
            return "Tanggal lahir pada NIK tidak valid.";
        }

        return true;
    }

    // ===============================
    // IMPORT CSV
    // ===============================
    public function importCsv(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = fopen($request->file->getRealPath(), 'r');
        $header = fgetcsv($file);

        DB::beginTransaction();

        try {
            while (($row = fgetcsv($file)) !== false) {
                $data = array_combine($header, $row);

                if (!isset($data['nik']) || !isset($data['nama'])) continue;

                // Validasi NIK
                $nikCheck = $this->validateNIK($data['nik']);
                if ($nikCheck !== true) continue;

                Penduduk::updateOrCreate(
                    ['nik' => $data['nik']],
                    $data
                );
            }

            DB::commit();
            return back()->with('success', 'Berhasil import CSV.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    // ===============================
    // EXPORT EXCEL
    // ===============================
    public function exportExcel()
    {
        return Excel::download(new PendudukExport, 'penduduk.xlsx');
    }

    // ===============================
    // EXPORT PDF
    // ===============================
    public function exportPdf()
    {
        $penduduk = Penduduk::all();
        $pdf = Pdf::loadView('penduduk.pdf', compact('penduduk'));
        return $pdf->download('data-penduduk.pdf');
    }

    // ===============================
    // STATISTIK (HALAMAN KHUSUS)
    // ===============================
    public function statistik()
    {
        $total = Penduduk::count();
        $laki = Penduduk::where('jenis_kelamin', 'L')->count();
        $perempuan = Penduduk::where('jenis_kelamin', 'P')->count();

        $usia = Penduduk::selectRaw("
            SUM(CASE WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 17 THEN 1 ELSE 0 END) AS anak,
            SUM(CASE WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 17 AND 55 THEN 1 ELSE 0 END) AS dewasa,
            SUM(CASE WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) > 55 THEN 1 ELSE 0 END) AS lansia
        ")->first();

        $rt = Penduduk::selectRaw("rt, COUNT(*) as total")
            ->groupBy('rt')
            ->orderBy('rt')
            ->get();

        $rw = Penduduk::selectRaw("rw, COUNT(*) as total")
            ->groupBy('rw')
            ->orderBy('rw')
            ->get();

        return view('penduduk.statistik', compact(
            'total', 'laki', 'perempuan', 'usia', 'rt', 'rw'
        ));
    }
}
