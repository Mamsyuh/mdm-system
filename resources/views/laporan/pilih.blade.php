@extends('layouts.app')

@section('content')
<div class="container-fluid py-4" style="max-width: 1200px;">
    <!-- Header -->
    <div class="text-center mb-4">
        <h2 class="fw-bold mb-2">
            <i class="fas fa-file-alt text-primary"></i>
            Pilih Jenis Laporan
        </h2>
        <p class="text-muted">Pilih format laporan data penduduk yang ingin Anda download</p>
    </div>

    <!-- Filter Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white border-0 pt-4 pb-0">
            <h5 class="mb-3"><i class="fas fa-filter text-primary me-2"></i>Filter Laporan</h5>
        </div>
        <div class="card-body pt-2">
            <form id="filterForm">
                <div class="row g-3 align-items-end">
                    <!-- Tipe Filter -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Tipe Filter</label>
                        <select class="form-select" id="filter_type" name="filter_type">
                            <option value="semua">📊 Semua Data</option>
                            <option value="tahun">📅 Per Tahun</option>
                            <option value="bulan">📆 Per Bulan</option>
                        </select>
                    </div>

                    <!-- Pilih Tahun -->
                    <div class="col-md-3" id="tahunGroup" style="display: none;">
                        <label class="form-label fw-semibold">Pilih Tahun</label>
                        <select class="form-select" id="tahun" name="tahun">
                            <option value="">-- Pilih Tahun --</option>
                            @foreach($tahunList as $tahun)
                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pilih Bulan -->
                    <div class="col-md-3" id="bulanGroup" style="display: none;">
                        <label class="form-label fw-semibold">Pilih Bulan</label>
                        <select class="form-select" id="bulan" name="bulan">
                            <option value="">-- Pilih Bulan --</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>

                    <!-- Info Box -->
                    <div class="col-md-3">
                        <div class="alert alert-info mb-0 py-2">
                            <small id="filterInfoText"><strong>Filter: Semua Data</strong></small>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Export Cards -->
    <div class="row g-4 mb-4">
        <!-- PDF Card -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <i class="fas fa-file-pdf fa-3x text-white"></i>
                        </div>
                    </div>
                    
                    <h4 class="fw-bold mb-2">Export PDF</h4>
                    <p class="text-muted small mb-4">Download laporan data penduduk dalam format PDF (Landscape A4)</p>
                    
                    <div class="d-grid gap-2">
                        <button type="button" onclick="exportPDF()" class="btn btn-primary btn-lg">
                            <i class="fas fa-download me-2"></i>Download PDF
                        </button>
                        <button type="button" onclick="previewPDF()" class="btn btn-outline-secondary">
                            <i class="fas fa-eye me-2"></i>Preview PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Excel Card -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="fas fa-file-excel fa-3x text-white"></i>
                        </div>
                    </div>
                    
                    <h4 class="fw-bold mb-2">Export Excel</h4>
                    <p class="text-muted small mb-4">Download laporan data penduduk dalam format Excel (.xlsx)</p>
                    
                    <div class="d-grid gap-2">
                        <button type="button" onclick="exportExcel()" class="btn btn-success btn-lg">
                            <i class="fas fa-download me-2"></i>Download Excel
                        </button>
                        <button class="btn btn-outline-secondary" disabled>
                            <i class="fas fa-times me-2"></i>Preview tidak tersedia
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="py-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                        <h3 class="fw-bold mb-1">{{ number_format($totalPenduduk) }}</h3>
                        <p class="text-muted mb-0">Total Penduduk</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="py-3">
                        <div class="rounded-circle bg-info bg-opacity-10 mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-male fa-2x text-info"></i>
                        </div>
                        <h3 class="fw-bold mb-1">{{ number_format($lakiLaki) }}</h3>
                        <p class="text-muted mb-0">Laki-laki</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="py-3">
                        <div class="rounded-circle bg-danger bg-opacity-10 mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-female fa-2x text-danger"></i>
                        </div>
                        <h3 class="fw-bold mb-1">{{ number_format($perempuan) }}</h3>
                        <p class="text-muted mb-0">Perempuan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="text-center mt-4">
        <a href="{{ route('penduduk.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Data Penduduk
        </a>
    </div>
</div>

<style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,.15) !important;
    }
</style>

<script>
document.getElementById('filter_type').addEventListener('change', function() {
    const filterType = this.value;
    const tahunGroup = document.getElementById('tahunGroup');
    const bulanGroup = document.getElementById('bulanGroup');
    
    tahunGroup.style.display = 'none';
    bulanGroup.style.display = 'none';
    document.getElementById('tahun').value = '';
    document.getElementById('bulan').value = '';
    
    if (filterType === 'tahun') {
        tahunGroup.style.display = 'block';
    } else if (filterType === 'bulan') {
        tahunGroup.style.display = 'block';
        bulanGroup.style.display = 'block';
    }
    
    updateFilterInfo();
});

document.getElementById('tahun').addEventListener('change', updateFilterInfo);
document.getElementById('bulan').addEventListener('change', updateFilterInfo);

function updateFilterInfo() {
    const filterType = document.getElementById('filter_type').value;
    const tahun = document.getElementById('tahun').value;
    const bulan = document.getElementById('bulan').value;
    const bulanText = document.getElementById('bulan').options[document.getElementById('bulan').selectedIndex].text;
    
    let text = 'Filter: ';
    
    if (filterType === 'semua') {
        text += '<strong>Semua Data</strong>';
    } else if (filterType === 'tahun' && tahun) {
        text += '<strong>Tahun ' + tahun + '</strong>';
    } else if (filterType === 'bulan' && tahun && bulan) {
        text += '<strong>' + bulanText + ' ' + tahun + '</strong>';
    } else {
        text += '<strong>Pilih filter terlebih dahulu</strong>';
    }
    
    document.getElementById('filterInfoText').innerHTML = text;
}

function getFilterParams() {
    const params = new URLSearchParams();
    params.append('filter_type', document.getElementById('filter_type').value);
    
    const filterType = document.getElementById('filter_type').value;
    const tahun = document.getElementById('tahun').value;
    const bulan = document.getElementById('bulan').value;
    
    if (filterType === 'tahun' && tahun) {
        params.append('tahun', tahun);
    } else if (filterType === 'bulan' && tahun && bulan) {
        params.append('tahun', tahun);
        params.append('bulan', bulan);
    }
    
    return params.toString();
}

function exportPDF() {
    window.location.href = "{{ route('laporan.pdf') }}?" + getFilterParams();
}

function previewPDF() {
    window.open("{{ route('laporan.preview') }}?" + getFilterParams(), '_blank');
}

function exportExcel() {
    window.location.href = "{{ route('laporan.excel') }}?" + getFilterParams();
}
</script>
@endsection