@extends('layouts.app')

@section('content')
<div class="export-container">
    <div class="container-fluid px-4 py-4">
        <!-- Animated Header -->
        <div class="header-section text-center mb-5 animate-fade-in">
            <div class="header-icon-wrapper mb-3">
                <div class="pulse-ring"></div>
                <div class="header-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
            </div>
            <h2 class="display-6 fw-bold mb-2 gradient-text">Export Laporan Data</h2>
            <p class="text-muted">Pilih format dan filter untuk mengekspor data penduduk</p>
        </div>

        <div class="row g-4">
            <!-- Sidebar Filter -->
            <div class="col-lg-4">
                <div class="filter-card card border-0 shadow-lg sticky-sidebar">
                    <div class="card-header bg-transparent border-0 pt-4 pb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-badge mt-0 m-3">
                                <i class="fas fa-sliders-h"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 m-3 fw-bold">Filter Data</h5>
                                <small class="text-muted mt-0 m-3">Atur periode laporan</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body px-4">
                        <form id="filterForm">
                            <!-- Tipe Filter -->
                            <div class="filter-group mb-4">
                                <label class="filter-label">
                                    <i class="fas fa-layer-group text-primary me-2"></i>
                                    Tipe Filter
                                </label>
                                <select class="modern-select" id="filter_type">
                                    <option value="semua">📊 Semua Data</option>
                                    <option value="tahun">📅 Per Tahun</option>
                                    <option value="bulan">📆 Per Bulan</option>
                                </select>
                            </div>

                            <!-- Tahun -->
                            <div class="filter-group mb-4" id="tahunGroup" style="display: none;">
                                <label class="filter-label">
                                    <i class="fas fa-calendar text-info me-2"></i>
                                    Pilih Tahun
                                </label>
                                <select class="modern-select" id="tahun">
                                    <option value="">-- Pilih Tahun --</option>
                                    @foreach($tahunList as $tahun)
                                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Bulan -->
                            <div class="filter-group mb-4" id="bulanGroup" style="display: none;">
                                <label class="filter-label">
                                    <i class="fas fa-calendar-day text-success me-2"></i>
                                    Pilih Bulan
                                </label>
                                <select class="modern-select" id="bulan">
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

                            <!-- Active Filter Display -->
                            <div class="active-filter">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-filter fa-lg text-primary me-3"></i>
                                    <div>
                                        <small class="d-block text-muted mb-1">Filter Aktif</small>
                                        <strong id="filterInfoText">Semua Data</strong>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Statistics -->
                    <div class="card-footer bg-transparent border-0 px-4 pb-4">
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-icon bg-primary">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value">{{ number_format($totalPenduduk) }}</div>
                                    <div class="stat-label">Total</div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon bg-info">
                                    <i class="fas fa-male"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value">{{ number_format($lakiLaki) }}</div>
                                    <div class="stat-label">Laki-laki</div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon bg-danger">
                                    <i class="fas fa-female"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value">{{ number_format($perempuan) }}</div>
                                    <div class="stat-label">Perempuan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <a href="{{ route('penduduk.index') }}" class="back-button mt-3">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali ke Data Penduduk
                </a>
            </div>

            <!-- Export Options -->
            <div class="col-lg-8">
                <div class="export-grid">
                    <!-- PDF Card -->
                    <div class="export-card pdf-card" onclick="exportPDF()">
                        <div class="export-card-glow"></div>
                        <div class="export-card-content">
                            <div class="export-icon-wrapper">
                                <div class="export-icon pdf-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div class="export-badge">PDF</div>
                            </div>
                            
                            <h3 class="export-title">Export PDF</h3>
                            <p class="export-description">
                                Format profesional untuk dokumen cetak dengan layout landscape A4
                            </p>

                            <div class="export-features">
                                <div class="feature-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Siap Cetak</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Layout Rapi</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Watermark</span>
                                </div>
                            </div>

                            <button type="button" class="export-button pdf-button">
                                <span class="button-text">
                                    <i class="fas fa-download me-2"></i>
                                    Download PDF
                                </span>
                                <span class="button-icon">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Excel Card -->
                    <div class="export-card excel-card" onclick="exportExcel()">
                        <div class="export-card-glow"></div>
                        <div class="export-card-content">
                            <div class="export-icon-wrapper">
                                <div class="export-icon excel-icon">
                                    <i class="fas fa-file-excel"></i>
                                </div>
                                <div class="export-badge">XLSX</div>
                            </div>
                            
                            <h3 class="export-title">Export Excel</h3>
                            <p class="export-description">
                                Format spreadsheet untuk analisis data dan pengolahan lanjutan
                            </p>

                            <div class="export-features">
                                <div class="feature-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Editable</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Formula Ready</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Multi Sheet</span>
                                </div>
                            </div>

                            <button type="button" class="export-button excel-button">
                                <span class="button-text">
                                    <i class="fas fa-download me-2"></i>
                                    Download Excel
                                </span>
                                <span class="button-icon">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Info Banner -->
                <div class="info-banner mt-4">
                    <div class="info-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="info-content">
                        <h6 class="info-title">💡 Tips Penggunaan</h6>
                        <p class="info-text">
                            Gunakan filter untuk fokus pada data periode tertentu. 
                            PDF untuk laporan formal, Excel untuk analisis mendalam.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Base Styles */
.export-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding-bottom: 2rem;
}

/* Header Animation */
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeInDown 0.6s ease-out;
}

.header-icon-wrapper {
    position: relative;
    display: inline-block;
}

.header-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.4);
    position: relative;
    z-index: 2;
}

@keyframes pulse-ring {
    0% {
        transform: scale(0.8);
        opacity: 1;
    }
    100% {
        transform: scale(1.5);
        opacity: 0;
    }
}

.pulse-ring {
    position: absolute;
    width: 80px;
    height: 80px;
    border-radius: 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    animation: pulse-ring 2s ease-out infinite;
}

.gradient-text {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Filter Card */
.filter-card {
    border-radius: 24px;
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.95);
}

.sticky-sidebar {
    position: sticky;
    top: 20px;
}

.icon-badge {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.filter-group {
    position: relative;
}

.filter-label {
    display: block;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.modern-select {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 0.95rem;
    background: white;
    transition: all 0.3s ease;
    cursor: pointer;
}

.modern-select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.modern-select:hover {
    border-color: #cbd5e0;
}

.active-filter {
    background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
    padding: 16px;
    border-radius: 12px;
    border: 2px dashed #667eea50;
}

/* Statistics Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 10px;
}

.stat-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
}

.stat-content {
    flex: 1;
}

.stat-value {
    font-size: 1.1rem;
    font-weight: 700;
    color: #2d3748;
    line-height: 1.2;
}

.stat-label {
    font-size: 0.7rem;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Back Button */
.back-button {
    display: block;
    width: 100%;
    padding: 12px;
    text-align: center;
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    color: #4a5568;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.back-button:hover {
    background: #f7fafc;
    border-color: #cbd5e0;
    color: #2d3748;
    transform: translateX(-3px);
}

/* Export Grid */
.export-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
}

/* Export Cards */
.export-card {
    position: relative;
    background: white;
    border-radius: 24px;
    padding: 32px;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.export-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.pdf-card::before {
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
}

.excel-card::before {
    background: linear-gradient(90deg, #10b981 0%, #059669 100%);
}

.export-card:hover::before {
    opacity: 1;
}

.export-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
}

.export-card-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
}

.pdf-card .export-card-glow {
    background: radial-gradient(circle, rgba(102, 126, 234, 0.2) 0%, transparent 70%);
}

.excel-card .export-card-glow {
    background: radial-gradient(circle, rgba(16, 185, 129, 0.2) 0%, transparent 70%);
}

.export-card:hover .export-card-glow {
    opacity: 1;
}

.export-card-content {
    position: relative;
    z-index: 2;
}

.export-icon-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
}

.export-icon {
    width: 80px;
    height: 80px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: white;
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    transition: all 0.4s ease;
}

.pdf-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.excel-icon {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.export-card:hover .export-icon {
    transform: scale(1.1) rotate(-5deg);
}

.export-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.pdf-card .export-badge {
    background: rgba(102, 126, 234, 0.1);
    color: #667eea;
}

.excel-card .export-badge {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}

.export-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 12px;
}

.export-description {
    color: #718096;
    margin-bottom: 24px;
    line-height: 1.6;
}

.export-features {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin-bottom: 24px;
}

.feature-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    font-size: 0.75rem;
    color: #4a5568;
}

.feature-item i {
    color: #48bb78;
    font-size: 1rem;
}

.export-button {
    width: 100%;
    padding: 16px 24px;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.pdf-button {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.excel-button {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.export-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.export-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.2);
    transition: left 0.5s ease;
}

.export-button:hover::before {
    left: 100%;
}

.button-icon {
    transition: transform 0.3s ease;
}

.export-button:hover .button-icon {
    transform: translateX(5px);
}

/* Info Banner */
.info-banner {
    background: linear-gradient(135deg, #ebf8ff 0%, #bee3f8 100%);
    border-radius: 16px;
    padding: 20px;
    display: flex;
    gap: 16px;
    align-items: start;
    border-left: 4px solid #3182ce;
}

.info-icon {
    width: 40px;
    height: 40px;
    background: white;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #3182ce;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.info-title {
    font-weight: 700;
    color: #2c5282;
    margin-bottom: 4px;
}

.info-text {
    color: #2c5282;
    margin: 0;
    font-size: 0.9rem;
    line-height: 1.5;
}

/* Responsive */
@media (max-width: 991px) {
    .sticky-sidebar {
        position: relative;
        top: 0;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .export-features {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterType = document.getElementById('filter_type');
    const tahunGroup = document.getElementById('tahunGroup');
    const bulanGroup = document.getElementById('bulanGroup');
    const tahunSelect = document.getElementById('tahun');
    const bulanSelect = document.getElementById('bulan');
    
    filterType.addEventListener('change', function() {
        tahunGroup.style.display = 'none';
        bulanGroup.style.display = 'none';
        tahunSelect.value = '';
        bulanSelect.value = '';
        
        if (this.value === 'tahun') {
            tahunGroup.style.display = 'block';
        } else if (this.value === 'bulan') {
            tahunGroup.style.display = 'block';
            bulanGroup.style.display = 'block';
        }
        
        updateFilterInfo();
    });
    
    tahunSelect.addEventListener('change', updateFilterInfo);
    bulanSelect.addEventListener('change', updateFilterInfo);
});

function updateFilterInfo() {
    const filterType = document.getElementById('filter_type').value;
    const tahun = document.getElementById('tahun').value;
    const bulan = document.getElementById('bulan').value;
    const bulanText = document.getElementById('bulan').options[document.getElementById('bulan').selectedIndex].text;
    
    let text = '';
    
    if (filterType === 'semua') {
        text = 'Semua Data';
    } else if (filterType === 'tahun' && tahun) {
        text = 'Tahun ' + tahun;
    } else if (filterType === 'bulan' && tahun && bulan) {
        text = bulanText + ' ' + tahun;
    } else {
        text = 'Pilih filter terlebih dahulu';
    }
    
    document.getElementById('filterInfoText').textContent = text;
}

function getFilterParams() {
    const params = new URLSearchParams();
    const filterType = document.getElementById('filter_type').value;
    const tahun = document.getElementById('tahun').value;
    const bulan = document.getElementById('bulan').value;
    
    params.append('filter_type', filterType);
    
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

function exportExcel() {
    window.location.href = "{{ route('laporan.excel') }}?" + getFilterParams();
}
</script>
@endsection