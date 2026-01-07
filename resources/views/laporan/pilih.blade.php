@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-2">
                    <i class="fas fa-file-alt text-primary"></i>
                    Pilih Jenis Laporan
                </h2>
                <p class="text-muted">Pilih format laporan data penduduk yang ingin Anda download</p>
            </div>

            <!-- Cards -->
            <div class="row g-4 mb-4">
                <!-- Export PDF Card -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-lg h-100 hover-lift">
                        <div class="card-body text-center p-5">
                            <!-- Icon -->
                            <div class="mb-4">
                                <div class="icon-wrapper mx-auto" style="width: 100px; height: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-file-pdf fa-3x text-white"></i>
                                </div>
                            </div>
                            
                            <!-- Title & Description -->
                            <h4 class="card-title fw-bold mb-3">Export PDF</h4>
                            <p class="text-muted mb-4">
                                Download laporan data penduduk dalam format PDF (Landscape A4)
                            </p>
                            
                            <!-- Buttons -->
                            <div class="d-grid gap-2">
                                <a href="{{ route('penduduk.exportPdf') }}" class="btn btn-lg text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <i class="fas fa-download me-2"></i>Download PDF
                                </a>
                                <button class="btn btn-outline-secondary" disabled>
                                    <i class="fas fa-eye me-2"></i>Preview tidak tersedia
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Export Excel Card -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-lg h-100 hover-lift">
                        <div class="card-body text-center p-5">
                            <!-- Icon -->
                            <div class="mb-4">
                                <div class="icon-wrapper mx-auto" style="width: 100px; height: 100px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-file-excel fa-3x text-white"></i>
                                </div>
                            </div>
                            
                            <!-- Title & Description -->
                            <h4 class="card-title fw-bold mb-3">Export Excel</h4>
                            <p class="text-muted mb-4">
                                Download laporan data penduduk dalam format Excel (.xlsx)
                            </p>
                            
                            <!-- Button -->
                            <div class="d-grid gap-2">
                                <a href="{{ route('penduduk.exportExcel') }}" class="btn btn-lg text-white" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                    <i class="fas fa-download me-2"></i>Download Excel
                                </a>
                                <button class="btn btn-outline-secondary" disabled>
                                    <i class="fas fa-eye me-2"></i>Preview tidak tersedia
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Box -->
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-info-circle fa-2x text-info"></i>
                        </div>
                        <div class="col">
                            <h6 class="mb-1 fw-bold">Informasi</h6>
                            <small class="text-muted">
                                Laporan akan berisi seluruh data penduduk yang terdaftar dalam sistem. 
                                Format PDF cocok untuk dicetak, sedangkan Excel cocok untuk analisis data lebih lanjut.
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center mt-4">
                <a href="{{ route('penduduk.index') }}" class="btn btn-secondary px-4">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Data Penduduk
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
    }
    
    .icon-wrapper {
        transition: transform 0.3s ease;
    }
    
    .hover-lift:hover .icon-wrapper {
        transform: scale(1.1) rotate(5deg);
    }
    
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: scale(1.02);
    }
</style>
@endsection