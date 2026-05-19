@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-end mb-5">
        <div>
            <h2 class="fw-bold text-dark mb-1">Daftar Peralatan Lab Komputer</h2>
            <p class="text-muted mb-0">Pilih perangkat hardware atau peripheral yang tersedia untuk kebutuhan praktik Anda.</p>
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
                    <i class="bi bi-pc-display-horizontal fs-4"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Total Perangkat</small>
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
                    <small class="text-muted d-block">Siap Digunakan</small>
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
                    <i class="bi bi-tags fs-4"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Kategori IT</small>
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
                <input type="text" id="searchBarang" class="form-control border-start-0 py-2 shadow-none" placeholder="Cari hardware (misal: Laptop, Switch, Router)...">
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <select id="filterKategori" class="form-select shadow-none">
                <option value="all">Semua Kategori</option>
                <option value="Komputer">💻 Komputer & Laptop</option>
                <option value="Networking">🌐 Jaringan / Networking</option>
                <option value="Peripheral">⌨️ Peripheral & Input</option>
                <option value="Multimedia">🎥 Multimedia & Audio</option>
                <option value="Komponen">🔌 Komponen & Kabel</option>
            </select>
        </div>
        <div class="col-md-3 mb-3">
            <select id="filterStatus" class="form-select shadow-none">
                <option value="all">Semua Status</option>
                <option value="tersedia">Tersedia</option>
                <option value="habis">Habis / Kosong</option>
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
            // DATA PERALATAN KOMPUTER & IT LAB
            $dataAlatLab = [
                // Kategori Komputer & Laptop
                ['nama' => 'Laptop ASUS ROG', 'deskripsi' => 'Core i7, RAM 16GB, RTX 3060. Cocok untuk komputasi berat, rendering, dan editing.', 'kategori' => 'Komputer', 'jumlah' => 10, 'lab' => 'Lab Multimedia', 'icon' => 'bi-laptop', 'icon_color' => '#0284c7'],
                ['nama' => 'PC Desktop i5', 'deskripsi' => 'Intel Core i5, RAM 8GB, SSD 256GB, Monitor 21.5 Inch. Paket workstation standar.', 'kategori' => 'Komputer', 'jumlah' => 25, 'lab' => 'Lab Jaringan & Komputer', 'icon' => 'bi-pc-display', 'icon_color' => '#0284c7'],
                ['nama' => 'MacBook Air M1', 'deskripsi' => 'RAM 8GB, SSD 256GB. Sangat ideal untuk pengembangan aplikasi iOS / Mobile.', 'kategori' => 'Komputer', 'jumlah' => 5, 'lab' => 'Lab Programming', 'icon' => 'bi-laptop', 'icon_color' => '#0284c7'],
                
                // Kategori Jaringan / Networking
                ['nama' => 'Router Cisco ISR 4321', 'deskripsi' => 'Modular router enterprise untuk simulasi WAN dan routing protokol tingkat lanjut.', 'kategori' => 'Networking', 'jumlah' => 6, 'lab' => 'Lab Jaringan & Komputer', 'icon' => 'bi-router', 'icon_color' => '#059669'],
                ['nama' => 'Switch Manageable 24 Port', 'deskripsi' => 'Cisco Catalyst Gigabit Ethernet switch, mendukung konfigurasi VLAN dan Trunking.', 'kategori' => 'Networking', 'jumlah' => 8, 'lab' => 'Lab Jaringan & Komputer', 'icon' => 'bi-hdd-network', 'icon_color' => '#059669'],
                ['nama' => 'Access Point Ubiquiti UniFi', 'deskripsi' => 'Dual-Band enterprise AP untuk perancangan dan manajemen topologi jaringan nirkabel.', 'kategori' => 'Networking', 'jumlah' => 12, 'lab' => 'Lab Jaringan & Komputer', 'icon' => 'bi-wifi', 'icon_color' => '#059669'],
                ['nama' => 'MikroTik RouterBOARDRB951', 'deskripsi' => 'Wireless router portabel serbaguna, ideal untuk latihan manajemen bandwidth & firewall.', 'kategori' => 'Networking', 'jumlah' => 15, 'lab' => 'Lab Jaringan & Komputer', 'icon' => 'bi-router-fill', 'icon_color' => '#059669'],
                
                // Kategori Peripheral & Input
                ['nama' => 'Drawing Tablet Wacom', 'deskripsi' => 'Wacom Intuos Creative Pen Tablet untuk akurasi desain grafis dan pembuatan aset digital.', 'kategori' => 'Peripheral', 'jumlah' => 8, 'lab' => 'Lab Multimedia', 'icon' => 'bi-tablet', 'icon_color' => '#dc2626'],
                ['nama' => 'Barcode Scanner Wireless', 'deskripsi' => 'Laser barcode reader dengan interface USB untuk integrasi sistem informasi / kasir.', 'kategori' => 'Peripheral', 'jumlah' => 14, 'lab' => 'Lab Database', 'icon' => 'bi-qr-code-scan', 'icon_color' => '#dc2626'],
                ['nama' => 'Keyboard Mechanical', 'deskripsi' => 'Brown switch layout TKL, responsif untuk kenyamanan mengetik kode program skala besar.', 'kategori' => 'Peripheral', 'jumlah' => 20, 'lab' => 'Lab Programming', 'icon' => 'bi-keyboard', 'icon_color' => '#dc2626'],
                
                // Kategori Multimedia & Audio
                ['nama' => 'Proyektor Epson Full HD', 'deskripsi' => 'Kecerahan 3000 Lumens, resolusi 1080p, input HDMI/VGA untuk presentasi grup.', 'kategori' => 'Multimedia', 'jumlah' => 4, 'lab' => 'Lab Utama', 'icon' => 'bi-projector', 'icon_color' => '#d97706'],
                ['nama' => 'Kamera DSLR Canon EOS', 'deskripsi' => 'Lensa kit 18-55mm, perekaman video Full HD untuk praktek sinematografi.', 'kategori' => 'Multimedia', 'jumlah' => 3, 'lab' => 'Lab Multimedia', 'icon' => 'bi-camera', 'icon_color' => '#d97706'],
                ['nama' => 'Microphone Condenser Rode', 'deskripsi' => 'Kualitas studio studio, interface USB untuk kebutuhan voice over atau podcasting.', 'kategori' => 'Multimedia', 'jumlah' => 5, 'lab' => 'Lab Multimedia', 'icon' => 'bi-mic', 'icon_color' => '#d97706'],
                
                // Kategori Komponen & Kabel
                ['nama' => 'Crimping Tools Set', 'deskripsi' => 'Tang kupas/potong kabel dan konektor RJ45 lengkap dengan Lan Tester.', 'kategori' => 'Komponen', 'jumlah' => 18, 'lab' => 'Lab Jaringan & Komputer', 'icon' => 'bi-tools', 'icon_color' => '#6b7280'],
                ['nama' => 'Kabel UTP Cat6 (Roll)', 'deskripsi' => 'Panjang 305 meter kualitas tinggi untuk latihan instalasi kabel backbone jaringan.', 'kategori' => 'Komponen', 'jumlah' => 4, 'lab' => 'Inventaris Server', 'icon' => 'bi-usb-c', 'icon_color' => '#6b7280'],
                ['nama' => 'External Harddisk 2TB', 'deskripsi' => 'USB 3.0 interface high-speed, digunakan untuk backup backup data besar atau OS image.', 'kategori' => 'Komponen', 'jumlah' => 10, 'lab' => 'Inventaris Server', 'icon' => 'bi-database', 'icon_color' => '#6b7280'],
            ];
        @endphp

        @forelse($dataAlatLab as $item)
        <div class="col-sm-6 col-lg-3 barang-item" data-kategori="{{ $item['kategori'] }}" data-tersedia="{{ $item['jumlah'] > 0 ? 'tersedia' : 'habis' }}">
            <div class="card h-100 border-0 shadow-sm card-hover-effect" style="border-radius: 20px; overflow: hidden;">
                <!-- Kotak Visual Representasi Perangkat -->
                <div class="icon-container d-flex align-items-center justify-content-center" 
                     style="height: 170px; background: linear-gradient(135deg, {{ $item['icon_color'] }}20 0%, {{ $item['icon_color'] }}08 100%);">
                    <div class="icon-circle" style="width: 85px; height: 85px; background: {{ $item['icon_color'] }}15; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi {{ $item['icon'] }}" style="font-size: 3.5rem; color: {{ $item['icon_color'] }};"></i>
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
                    <p class="text-muted small mb-2"><i class="bi bi-geo-alt me-1"></i>{{ $item['lab'] }}</p>
                    <p class="text-muted small mb-3" style="font-size: 0.8rem; line-height: 1.4;">{{ Str::limit($item['deskripsi'], 65) }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top" style="border-color: #eef2f6 !important;">
                        <div>
                            <small class="text-muted d-block small-text">Stok Ready</small>
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
            <i class="bi bi-cpu fs-1 text-muted"></i>
            <p class="mt-3 text-muted">Belum ada data perangkat komputer yang terdaftar.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    body { background-color: #f8fafc; font-family: 'Inter', system-ui, -apple-system, sans-serif; }
    
    .icon-container { transition: all 0.3s ease; }
    .icon-circle { transition: all 0.3s ease; }
    .card-hover-effect:hover .icon-circle { transform: scale(1.05); }
    
    .bg-light-primary { background-color: #eff6ff; }
    .bg-light-success { background-color: #d1fae5; }
    .bg-light-warning { background-color: #fed7aa; }
    .bg-light-purple { background-color: #f3e8ff; }
    
    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .card-hover-effect { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .card-hover-effect:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.08) !important;
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
                        <i class="bi bi-cpu fs-1 text-muted"></i>
                        <p class="mt-3 text-muted">Tidak ada perangkat komputer yang sesuai.</p>
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