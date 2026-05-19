@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-end mb-5">
        <div>
            <h2 class="fw-bold text-dark mb-1">Daftar Alat Laboratorium</h2>
            <p class="text-muted mb-0">Pilih alat yang tersedia untuk menunjang praktikum Anda.</p>
        </div>
        <div class="d-none d-md-block">
            <a href="{{ route('user.booking.create') }}" class="btn btn-primary px-4 py-2 shadow-sm" style="border-radius: 10px;">
                <i class="bi bi-plus-lg me-2"></i>Mulai Pinjam
            </a>
        </div>
    </div>

    <!-- Stats Mini -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="p-3 bg-white border-0 shadow-sm rounded-4 d-flex align-items-center">
                <div class="icon-box bg-light-primary text-primary me-3">
                    <i class="bi bi-box-seam fs-4"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Total Alat</small>
                    <span class="fw-bold fs-5" id="totalAlat">0</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="p-3 bg-white border-0 shadow-sm rounded-4 d-flex align-items-center">
                <div class="icon-box bg-light-success text-success me-3">
                    <i class="bi bi-check-circle fs-4"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Tersedia</small>
                    <span class="fw-bold fs-5" id="totalTersedia">0</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="p-3 bg-white border-0 shadow-sm rounded-4 d-flex align-items-center">
                <div class="icon-box bg-light-warning text-warning me-3">
                    <i class="bi bi-clock-history fs-4"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Sedang Dipinjam</small>
                    <span class="fw-bold fs-5" id="totalDipinjam">0</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="p-3 bg-white border-0 shadow-sm rounded-4 d-flex align-items-center">
                <div class="icon-box bg-light-purple text-purple me-3">
                    <i class="bi bi-building fs-4"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Kategori</small>
                    <span class="fw-bold fs-5" id="totalKategori">0</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Kategori & Search -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="input-group search-group">
                <span class="input-group-text bg-white border-end-0 py-2 px-3">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" id="searchBarang" class="form-control border-start-0 py-2 shadow-none" placeholder="Cari alat (misal: Mikroskop, Tabung Reaksi)...">
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <select id="filterKategori" class="form-select shadow-none">
                <option value="all">Semua Kategori</option>
                <option value="Optik">🔬 Optik & Mikroskop</option>
                <option value="Kimia">🧪 Kimia & Reagen</option>
                <option value="Biologi">🧬 Biologi & Medis</option>
                <option value="Fisika">⚡ Fisika & Elektronika</option>
                <option value="Umum">🔧 Umum & Pendukung</option>
            </select>
        </div>
        <div class="col-md-3 mb-3">
            <select id="filterStatus" class="form-select shadow-none">
                <option value="all">Semua Status</option>
                <option value="tersedia">Tersedia</option>
                <option value="habis">Habis / 0 Unit</option>
            </select>
        </div>
        <div class="col-md-2 mb-3">
            <button id="resetFilter" class="btn btn-outline-secondary w-100">
                <i class="bi bi-arrow-repeat me-1"></i>Reset
            </button>
        </div>
    </div>

    <!-- Grid Barang -->
    <div class="row g-4" id="barangContainer">
        @php
            // DATA ALAT LABORATORIUM DENGAN ICON REALISTIS DARI BOOTSTRAP ICONS
            $dataAlatLab = [
                // Kategori Optik & Mikroskop
                ['nama' => 'Mikroskop Binokuler', 'deskripsi' => 'Perbesaran 40x-1000x, dengan lampu LED dan kondensor Abbe', 'kategori' => 'Optik', 'jumlah' => 12, 'lab' => 'Lab Biologi', 'icon' => 'bi-mirror', 'icon_color' => '#0284c7'],
                ['nama' => 'Mikroskop Monokuler', 'deskripsi' => 'Perbesaran 40x-400x, cocok untuk pemula', 'kategori' => 'Optik', 'jumlah' => 8, 'lab' => 'Lab Biologi', 'icon' => 'bi-mirror', 'icon_color' => '#0284c7'],
                ['nama' => 'Lup Binokuler', 'deskripsi' => 'Pembesaran 10x-40x untuk pengamatan detail', 'kategori' => 'Optik', 'jumlah' => 5, 'lab' => 'Lab Biologi', 'icon' => 'bi-search', 'icon_color' => '#0284c7'],
                ['nama' => 'Spektrofotometer UV-Vis', 'deskripsi' => 'Pengukuran absorbansi panjang gelombang 190-1100nm', 'kategori' => 'Optik', 'jumlah' => 3, 'lab' => 'Lab Kimia', 'icon' => 'bi-graph-up', 'icon_color' => '#0284c7'],
                ['nama' => 'Refraktometer', 'deskripsi' => 'Mengukur indeks bias larutan', 'kategori' => 'Optik', 'jumlah' => 6, 'lab' => 'Lab Kimia', 'icon' => 'bi-eye', 'icon_color' => '#0284c7'],
                
                // Kategori Kimia & Reagen
                ['nama' => 'pH Meter Digital', 'deskripsi' => 'Akurasi 0.01, dengan kalibrasi otomatis', 'kategori' => 'Kimia', 'jumlah' => 15, 'lab' => 'Lab Kimia', 'icon' => 'bi-droplet', 'icon_color' => '#059669'],
                ['nama' => 'Timbangan Digital', 'deskripsi' => 'Kapasitas 200g, ketelitian 0.001g', 'kategori' => 'Kimia', 'jumlah' => 10, 'lab' => 'Lab Kimia', 'icon' => 'bi-scale', 'icon_color' => '#059669'],
                ['nama' => 'Sentrifugal', 'deskripsi' => 'Kecepatan maksimal 5000 rpm, 8 tabung', 'kategori' => 'Kimia', 'jumlah' => 4, 'lab' => 'Lab Kimia', 'icon' => 'bi-egg-fried', 'icon_color' => '#059669'],
                ['nama' => 'Hotplate Stirrer', 'deskripsi' => 'Pemanas dan pengaduk magnetik digital', 'kategori' => 'Kimia', 'jumlah' => 7, 'lab' => 'Lab Kimia', 'icon' => 'bi-fire', 'icon_color' => '#059669'],
                ['nama' => 'Tabung Reaksi', 'deskripsi' => 'Set 50 pcs, ukuran 15x150mm', 'kategori' => 'Kimia', 'jumlah' => 50, 'lab' => 'Lab Kimia', 'icon' => 'bi-cup-straw', 'icon_color' => '#059669'],
                ['nama' => 'Rak Tabung Reaksi', 'deskripsi' => 'Rak kayu untuk 50 tabung', 'kategori' => 'Kimia', 'jumlah' => 20, 'lab' => 'Lab Kimia', 'icon' => 'bi-grid-3x3-gap', 'icon_color' => '#059669'],
                ['nama' => 'Gelas Ukur', 'deskripsi' => 'Set ukuran 10ml, 50ml, 100ml, 250ml, 500ml', 'kategori' => 'Kimia', 'jumlah' => 30, 'lab' => 'Lab Kimia', 'icon' => 'bi-cup', 'icon_color' => '#059669'],
                ['nama' => 'Labu Erlenmeyer', 'deskripsi' => 'Berbagai ukuran 100ml - 1000ml', 'kategori' => 'Kimia', 'jumlah' => 25, 'lab' => 'Lab Kimia', 'icon' => 'bi-cone-striped', 'icon_color' => '#059669'],
                ['nama' => 'Buret', 'deskripsi' => 'Titrasi volume 25ml dan 50ml', 'kategori' => 'Kimia', 'jumlah' => 15, 'lab' => 'Lab Kimia', 'icon' => 'bi-eyedropper', 'icon_color' => '#059669'],
                
                // Kategori Biologi & Medis
                ['nama' => 'Inkubator', 'deskripsi' => 'Suhu 5-80°C, kapasitas 50L', 'kategori' => 'Biologi', 'jumlah' => 3, 'lab' => 'Lab Biologi', 'icon' => 'bi-thermometer-half', 'icon_color' => '#dc2626'],
                ['nama' => 'Autoklaf', 'deskripsi' => 'Sterilisasi uap tekanan tinggi, 20L', 'kategori' => 'Biologi', 'jumlah' => 2, 'lab' => 'Lab Biologi', 'icon' => 'bi-tools', 'icon_color' => '#dc2626'],
                ['nama' => 'Laminar Air Flow', 'deskripsi' => 'Kabinet aliran laminar untuk kerja steril', 'kategori' => 'Biologi', 'jumlah' => 2, 'lab' => 'Lab Biologi', 'icon' => 'bi-wind', 'icon_color' => '#dc2626'],
                ['nama' => 'Water Bath', 'deskripsi' => 'Pemanas air digital, kapasitas 10L', 'kategori' => 'Biologi', 'jumlah' => 5, 'lab' => 'Lab Biologi', 'icon' => 'bi-water', 'icon_color' => '#dc2626'],
                ['nama' => 'Centrifuge', 'deskripsi' => 'Untuk pemisahan sampel darah dan cairan', 'kategori' => 'Biologi', 'jumlah' => 4, 'lab' => 'Lab Medis', 'icon' => 'bi-speedometer2', 'icon_color' => '#dc2626'],
                
                // Kategori Fisika & Elektronika
                ['nama' => 'Osiloskop Digital', 'deskripsi' => 'Bandwidth 100MHz, 2 channel', 'kategori' => 'Fisika', 'jumlah' => 6, 'lab' => 'Lab Fisika', 'icon' => 'bi-tv', 'icon_color' => '#d97706'],
                ['nama' => 'Multimeter Digital', 'deskripsi' => 'Pengukuran tegangan, arus, resistansi', 'kategori' => 'Fisika', 'jumlah' => 15, 'lab' => 'Lab Fisika', 'icon' => 'bi-battery-charging', 'icon_color' => '#d97706'],
                ['nama' => 'Power Supply', 'deskripsi' => 'DC 0-30V, 0-5A digital', 'kategori' => 'Fisika', 'jumlah' => 10, 'lab' => 'Lab Fisika', 'icon' => 'bi-plug', 'icon_color' => '#d97706'],
                ['nama' => 'Generator Fungsi', 'deskripsi' => 'Frekuensi 1Hz - 5MHz, gelombang sinus, segitiga, square', 'kategori' => 'Fisika', 'jumlah' => 4, 'lab' => 'Lab Fisika', 'icon' => 'bi-soundwave', 'icon_color' => '#d97706'],
                
                // Kategori Umum & Pendukung
                ['nama' => 'Kacamata Lab', 'deskripsi' => 'Pelindung mata anti percikan', 'kategori' => 'Umum', 'jumlah' => 25, 'lab' => 'Lab Umum', 'icon' => 'bi-eyeglasses', 'icon_color' => '#6b7280'],
                ['nama' => 'Sarung Tangan Lateks', 'deskripsi' => 'Box isi 100 pasang, ukuran M/L', 'kategori' => 'Umum', 'jumlah' => 10, 'lab' => 'Lab Umum', 'icon' => 'bi-hand-index', 'icon_color' => '#6b7280'],
                ['nama' => 'Jas Lab', 'deskripsi' => 'Jas laboratorium ukuran S-XXL', 'kategori' => 'Umum', 'jumlah' => 30, 'lab' => 'Lab Umum', 'icon' => 'bi-person-badge', 'icon_color' => '#6b7280'],
                ['nama' => 'Lemari Asam', 'deskripsi' => 'Fume hood untuk kerja dengan bahan kimia berbahaya', 'kategori' => 'Umum', 'jumlah' => 2, 'lab' => 'Lab Kimia', 'icon' => 'bi-box', 'icon_color' => '#6b7280'],
                ['nama' => 'Tabung Gas', 'deskripsi' => 'Tabung gas Oksigen dan Nitrogen', 'kategori' => 'Umum', 'jumlah' => 8, 'lab' => 'Lab Umum', 'icon' => 'bi-fuel-pump', 'icon_color' => '#6b7280'],
            ];
        @endphp

        @forelse($dataAlatLab as $item)
        <div class="col-sm-6 col-lg-3 barang-item" data-kategori="{{ $item['kategori'] }}" data-tersedia="{{ $item['jumlah'] > 0 ? 'tersedia' : 'habis' }}">
            <div class="card h-100 border-0 shadow-sm card-hover-effect" style="border-radius: 20px; overflow: hidden;">
                <!-- Gambar/Icon Realistis dari Bootstrap Icons -->
                <div class="icon-container d-flex align-items-center justify-content-center" 
                     style="height: 170px; background: linear-gradient(135deg, {{ $item['icon_color'] }}20 0%, {{ $item['icon_color'] }}08 100%);">
                    <div class="icon-circle" style="width: 85px; height: 85px; background: {{ $item['icon_color'] }}15; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="{{ $item['icon'] }}" style="font-size: 3.5rem; color: {{ $item['icon_color'] }};"></i>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge px-3 py-1 rounded-pill mb-2" 
                              style="background-color: {{ $item['icon_color'] }}20; color: {{ $item['icon_color'] }}; font-weight: 500;">
                            {{ $item['kategori'] }}
                        </span>
                        <div class="status-indicator {{ $item['jumlah'] > 0 ? 'bg-success' : 'bg-danger' }}"></div>
                    </div>
                    
                    <h5 class="card-title fw-bold text-dark mb-1">{{ $item['nama'] }}</h5>
                    <p class="text-muted small mb-2">{{ $item['lab'] }}</p>
                    <p class="text-muted small mb-3" style="font-size: 0.8rem; line-height: 1.4;">{{ Str::limit($item['deskripsi'], 65) }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top" style="border-color: #eef2f6 !important;">
                        <div>
                            <small class="text-muted d-block small-text">Tersedia</small>
                            <span class="fw-bold {{ $item['jumlah'] > 0 ? 'text-success' : 'text-danger' }} fs-5">
                                {{ $item['jumlah'] }} Unit
                            </span>
                        </div>
                        <a href="{{ route('user.booking.create') }}" class="btn btn-sm px-4 rounded-pill" 
                           style="background-color: {{ $item['icon_color'] }}; color: white; border: none;">
                            <i class="bi bi-hand-index-thumb me-1"></i>Pinjam
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted"></i>
            <p class="mt-3 text-muted">Belum ada data alat laboratorium.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    body { background-color: #f8fafc; font-family: 'Inter', system-ui, -apple-system, sans-serif; }
    
    /* Icon Container Styles */
    .icon-container {
        transition: all 0.3s ease;
    }
    
    .icon-circle {
        transition: all 0.3s ease;
    }
    
    .card-hover-effect:hover .icon-circle {
        transform: scale(1.05);
    }
    
    /* Badge Colors berdasarkan kategori */
    .bg-light-primary { background-color: #eff6ff; }
    .bg-light-success { background-color: #d1fae5; }
    .bg-light-warning { background-color: #fed7aa; }
    .bg-light-purple { background-color: #f3e8ff; }
    .text-purple { color: #7c3aed !important; }
    
    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .card-hover-effect {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-hover-effect:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1) !important;
    }

    .status-indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        box-shadow: 0 0 0 2px rgba(255,255,255,0.8);
    }

    .search-group .form-control:focus {
        border-color: #dee2e6;
        box-shadow: none;
    }
    
    .form-select:focus {
        border-color: #1b5a7a;
        box-shadow: 0 0 0 2px rgba(27, 90, 122, 0.1);
    }

    .small-text { 
        font-size: 0.7rem; 
        font-weight: 600; 
        text-transform: uppercase; 
        letter-spacing: 0.5px; 
    }
    
    .btn-primary {
        background-color: #1b5a7a;
        border-color: #1b5a7a;
    }
    .btn-primary:hover {
        background-color: #0f3b5c;
        border-color: #0f3b5c;
    }
    
    /* Scrollbar */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: #1b5a7a; border-radius: 10px; }
    
    @media (max-width: 768px) {
        .icon-container { height: 130px; }
        .icon-circle { width: 60px; height: 60px; }
        .icon-circle i { font-size: 2.5rem !important; }
        .card-body { padding: 1rem !important; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchBarang');
        const filterKategori = document.getElementById('filterKategori');
        const filterStatus = document.getElementById('filterStatus');
        const resetBtn = document.getElementById('resetFilter');
        const barangItems = document.querySelectorAll('.barang-item');
        
        function updateStats() {
            let totalAlat = 0;
            let totalTersedia = 0;
            let kategoriSet = new Set();
            
            barangItems.forEach(item => {
                const jumlahText = item.querySelector('.fw-bold.text-success, .fw-bold.text-danger')?.innerText || '0';
                const jumlah = parseInt(jumlahText.split(' ')[0]) || 0;
                const kategori = item.dataset.kategori;
                
                totalAlat += jumlah;
                if (jumlah > 0) totalTersedia += jumlah;
                if (kategori) kategoriSet.add(kategori);
            });
            
            document.getElementById('totalAlat').textContent = totalAlat;
            document.getElementById('totalTersedia').textContent = totalTersedia;
            document.getElementById('totalKategori').textContent = kategoriSet.size;
        }
        
        function applyFilters() {
            const searchTerm = searchInput.value.toLowerCase();
            const kategoriValue = filterKategori.value;
            const statusValue = filterStatus.value;
            
            let visibleCount = 0;
            
            barangItems.forEach(item => {
                const title = item.querySelector('.card-title')?.textContent.toLowerCase() || '';
                const kategori = item.dataset.kategori;
                const tersedia = item.dataset.tersedia;
                
                let show = true;
                
                if (searchTerm && !title.includes(searchTerm)) show = false;
                if (kategoriValue !== 'all' && kategori !== kategoriValue) show = false;
                if (statusValue !== 'all' && tersedia !== statusValue) show = false;
                
                item.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });
            
            let noResultMsg = document.getElementById('noResultMessage');
            if (visibleCount === 0 && barangItems.length > 0) {
                if (!noResultMsg) {
                    noResultMsg = document.createElement('div');
                    noResultMsg.id = 'noResultMessage';
                    noResultMsg.className = 'col-12 text-center py-5';
                    noResultMsg.innerHTML = `
                        <i class="bi bi-search fs-1 text-muted"></i>
                        <p class="mt-3 text-muted">Tidak ada alat yang sesuai dengan pencarian Anda.</p>
                        <button class="btn btn-outline-primary mt-2" id="clearSearchBtn">
                            <i class="bi bi-arrow-repeat me-1"></i>Reset Pencarian
                        </button>
                    `;
                    document.getElementById('barangContainer').appendChild(noResultMsg);
                    document.getElementById('clearSearchBtn')?.addEventListener('click', () => {
                        searchInput.value = '';
                        filterKategori.value = 'all';
                        filterStatus.value = 'all';
                        applyFilters();
                    });
                }
            } else if (noResultMsg) {
                noResultMsg.remove();
            }
        }
        
        searchInput.addEventListener('keyup', applyFilters);
        filterKategori.addEventListener('change', applyFilters);
        filterStatus.addEventListener('change', applyFilters);
        
        resetBtn.addEventListener('click', () => {
            searchInput.value = '';
            filterKategori.value = 'all';
            filterStatus.value = 'all';
            applyFilters();
        });
        
        updateStats();
    });
</script>
@endsection