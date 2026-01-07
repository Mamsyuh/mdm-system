<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\OperatorDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\KartuKeluargaController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ValidasiController;
use App\Http\Controllers\SuratController; 
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if (!$user) {
        return redirect()->route('login');
    }
    if ($user->role && $user->role->name === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    if ($user->role && $user->role->name === 'operator') {
        return redirect()->route('operator.dashboard');
    }
    return abort(403, 'Role tidak dikenali');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/surat/{surat}/approve', [SuratController::class, 'approve'])->name('surat.approve');
    Route::post('/surat/{surat}/reject', [SuratController::class, 'reject'])->name('surat.reject');
    Route::delete('/surat/{surat}', [SuratController::class, 'destroy'])->name('surat.destroy');
});

Route::middleware(['auth', 'role:operator'])->group(function () {
    Route::get('/operator/dashboard', [OperatorDashboardController::class, 'index'])->name('operator.dashboard');
});

Route::middleware(['auth', 'role:admin,operator'])->group(function () {
    Route::resource('surat', SuratController::class)->except(['destroy']); 
    Route::get('/surat/{surat}/print', [SuratController::class, 'printPdf'])->name('surat.print');

    Route::get('/validasi', [ValidasiController::class, 'index'])->name('validasi.index');
    Route::get('/validasi/{penduduk}', [ValidasiController::class, 'show'])->name('validasi.show');
    Route::post('/validasi/{penduduk}/approve', [ValidasiController::class, 'approve'])->name('validasi.approve');
    Route::post('/validasi/{penduduk}/reject', [ValidasiController::class, 'reject'])->name('validasi.reject');

    // MODUL LAPORAN
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    Route::get('/laporan/preview', [LaporanController::class, 'previewPdf'])->name('laporan.preview');

    Route::post('/penduduk/import-csv', [PendudukController::class, 'importCsv'])->name('penduduk.importCsv');
    Route::get('/penduduk/export-excel', [PendudukController::class, 'exportExcel'])->name('penduduk.exportExcel');
    Route::get('/penduduk/export-pdf', [PendudukController::class, 'exportPdf'])->name('penduduk.exportPdf');
    Route::get('/penduduk/statistik', [PendudukController::class, 'statistik'])->name('penduduk.statistik');
    Route::get('/penduduk/pilih-laporan', [PendudukController::class, 'pilihLaporan'])->name('penduduk.pilihLaporan');

    Route::resource('penduduk', PendudukController::class);

    Route::get('/kk/export-pdf', [KartuKeluargaController::class, 'exportPdf'])->name('kk.exportPdf');
    Route::resource('kk', KartuKeluargaController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Tambahkan di paling bawah routes/web.php (sebelum require auth.php)
Route::get('/test-view', function() {
    $penduduk = \App\Models\Penduduk::all();
    return view('laporan.index', compact('penduduk'));
});

require __DIR__.'/auth.php';