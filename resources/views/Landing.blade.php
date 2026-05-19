@extends('layouts.app')

@section('title', 'LabBooking - Solusi Peminjaman Alat Laboratorium')

@section('content')
<div class="landing-page">
    <!-- Hero Section - Modern Minimalis -->
    <div class="hero-section py-5">
        <div class="container">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-4">
                        <i class="bi bi-flask me-2"></i> Solusi Cerdas Laboratorium
                    </div>
                    <h1 class="display-4 fw-bold mb-4">Peminjaman Alat Lab<br><span class="text-primary">Lebih Mudah & Transparan</span></h1>
                    <p class="lead text-secondary mb-4">Pinjam fasilitas lab dengan sistem modern. Proses cepat, real-time, dan bebas ribet. Transformasi digital untuk laboratorium Anda.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 rounded-pill">
                            <i class="bi bi-arrow-right me-2"></i>Mulai Sekarang
                        </a>
                        <button class="btn btn-outline-secondary btn-lg px-4 rounded-pill" data-bs-toggle="modal" data-bs-target="#learnMoreModal">
                            <i class="bi bi-play-circle me-2"></i>Demo
                        </button>
                    </div>
                    <div class="mt-5 d-flex align-items-center gap-4">
                        <div><i class="bi bi-check-circle-fill text-primary me-2"></i> Tanpa Birokrasi</div>
                        <div><i class="bi bi-check-circle-fill text-primary me-2"></i> Real-Time Tracking</div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="hero-illustration">
                        <img src="https://placehold.co/600x400/2d3748/FFFFFF/png?text=Dashboard+Preview" alt="Dashboard Preview" class="img-fluid rounded-3 shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section - Modern Cards -->
    <div class="features-section py-5 bg-white">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <span class="text-primary text-uppercase fw-semibold">Fitur Unggulan</span>
                    <h2 class="display-6 fw-bold mt-2">Kenapa Harus Pakai Kami?</h2>
                    <p class="lead text-secondary">Semua kebutuhan peminjaman alat lab dalam satu platform terintegrasi.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card text-start p-4 border rounded-4 h-100 transition-all">
                        <div class="feature-icon mb-4">
                            <i class="bi bi-calendar-check fs-1 text-primary"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Proses Mudah</h3>
                        <p class="text-secondary">Klik, pilih alat, konfirmasi. Selesai. Bahkan pengguna baru pun langsung paham.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-start p-4 border rounded-4 h-100 transition-all">
                        <div class="feature-icon mb-4">
                            <i class="bi bi-clock-history fs-1 text-primary"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Tracking Real-Time</h3>
                        <p class="text-secondary">Pantau status alat dan persetujuan laboran secara langsung. Tidak ada lagi menunggu bingung.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-start p-4 border rounded-4 h-100 transition-all">
                        <div class="feature-icon mb-4">
                            <i class="bi bi-shield-check fs-1 text-primary"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Sistem Terintegrasi</h3>
                        <p class="text-secondary">Sinkron dengan jadwal akademik dan penggunaan lab untuk efisiensi maksimal.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-start p-4 border rounded-4 h-100 transition-all">
                        <div class="feature-icon mb-4">
                            <i class="bi bi-graph-up fs-1 text-primary"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Rekap Data Otomatis</h3>
                        <p class="text-secondary">Laporan lengkap untuk analisis penggunaan alat dan evaluasi berkala.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-start p-4 border rounded-4 h-100 transition-all">
                        <div class="feature-icon mb-4">
                            <i class="bi bi-bell fs-1 text-primary"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Notifikasi Pintar</h3>
                        <p class="text-secondary">Pengingat otomatis untuk pengembalian alat dan update penting lainnya.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-start p-4 border rounded-4 h-100 transition-all">
                        <div class="feature-icon mb-4">
                            <i class="bi bi-people fs-1 text-primary"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Multi-Level Akses</h3>
                        <p class="text-secondary">Hak akses berbeda untuk mahasiswa, asisten lab, hingga kepala laboratorium.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section - GRAFIK KOSONG (belum login) / ISI (setelah login) -->
    <div class="stats-section py-5 bg-light">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-7">
                    <div class="vector-graph-wrapper p-4 bg-white rounded-4 shadow-sm">
                        <canvas id="usageChart" width="400" height="300" style="max-width:100%; height:auto;"></canvas>
                        <p class="text-center text-muted mt-3 small" id="chartCaption">*Login untuk melihat data peminjaman</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="stats-text">
                        <span class="text-primary text-uppercase fw-semibold">Kinerja Kami</span>
                        <h2 class="display-6 fw-bold mt-2 mb-4">Statistik Penggunaan</h2>
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="stat-item p-3 bg-white rounded-3 text-center">
                                    <div class="display-5 fw-bold text-primary" id="alatCount">0</div>
                                    <p class="text-secondary mb-0">Alat Tersedia</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-item p-3 bg-white rounded-3 text-center">
                                    <div class="display-5 fw-bold text-primary" id="userCount">0</div>
                                    <p class="text-secondary mb-0">Pengguna Aktif</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-item p-3 bg-white rounded-3 text-center">
                                    <div class="display-5 fw-bold text-primary" id="satisfactionCount">0<span class="fs-6">%</span></div>
                                    <p class="text-secondary mb-0">Kepuasan Pengguna</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-item p-3 bg-white rounded-3 text-center">
                                    <div class="display-5 fw-bold text-primary" id="hoursCount">0</div>
                                    <p class="text-secondary mb-0">Jam Layanan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section Minimalis -->
    <div class="cta-section py-5">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="display-6 fw-bold mb-3">Siap Tingkatkan Efisiensi Lab Anda?</h2>
                    <p class="lead mb-4">Bergabunglah dengan ribuan pengguna yang sudah merasakan kemudahan peminjaman alat lab.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 rounded-pill">
                        <i class="bi bi-person-plus me-2"></i>Daftar / Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modern Footer -->
<footer class="bg-dark text-white pt-5 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mb-4">
                <h5 class="fw-bold mb-3">Peminjaman Alat Lab</h5>
                <p class="text-white-50">Solusi cerdas dan modern untuk manajemen peminjaman alat laboratorium. Transparan, cepat, dan terpercaya.</p>
                <div class="mt-3">
                    <a href="#" class="text-white-50 me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white-50 me-3"><i class="bi bi-twitter"></i></a>
                    <a href="https://instagram.com/saefdnptraa" class="text-white-50 me-3"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white-50"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold mb-3">Kontak</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-geo-alt me-2"></i> Jl. Perjuangan No 134, Kota Cirebon</li>
                    <li class="mb-2"><i class="bi bi-telephone me-2"></i> 0897865433</li>
                    <li class="mb-2"><i class="bi bi-instagram me-2"></i> @saefdnptraa</li>
                    <li class="mb-2"><i class="bi bi-envelope me-2"></i> info@labbooking.com</li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3">Jam Operasional</h5>
                <ul class="list-unstyled text-white-50">
                    <li>Senin - Jumat : 08.00 - 20.00</li>
                    <li>Sabtu : 09.00 - 17.00</li>
                    <li>Minggu & Libur Nasional : Tutup</li>
                </ul>
            </div>
        </div>
        <hr class="bg-secondary">
        <div class="row">
            <div class="col-md-12 text-center text-white-50 small">
                &copy; 2025 Peminjaman Alat Lab. All rights reserved.
            </div>
        </div>
    </div>
</footer>

<!-- Learn More Modal -->
<div class="modal fade" id="learnMoreModal" tabindex="-1" aria-labelledby="learnMoreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="learnMoreModalLabel">Tentang Aplikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="lead">LabBooking adalah platform manajemen peminjaman alat laboratorium generasi baru.</p>
                <h6 class="fw-bold mt-4">Keunggulan:</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-check-lg text-primary me-2"></i> Proses online 24/7</li>
                    <li class="mb-2"><i class="bi bi-check-lg text-primary me-2"></i> Kalender ketersediaan real-time</li>
                    <li class="mb-2"><i class="bi bi-check-lg text-primary me-2"></i> Riwayat peminjaman tersimpan</li>
                    <li class="mb-2"><i class="bi bi-check-lg text-primary me-2"></i> Laporan otomatis</li>
                    <li class="mb-2"><i class="bi bi-check-lg text-primary me-2"></i> Dukungan teknis responsif</li>
                </ul>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4">Mulai Sekarang</a>
            </div>
        </div>
    </div>
</div>

<!-- Styles Modern Minimalis - Warna Elegan -->
<style>
    body {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background-color: #ffffff;
    }
    
    /* Warna Primary yang lebih elegan */
    .text-primary {
        color: #0f3b5c !important;
    }
    .bg-primary {
        background-color: #0f3b5c !important;
    }
    .btn-primary {
        background-color: #1b5a7a;
        border-color: #1b5a7a;
    }
    .btn-primary:hover {
        background-color: #0f3b5c;
        border-color: #0f3b5c;
    }
    .badge.bg-primary.bg-opacity-10 {
        background-color: rgba(15, 59, 92, 0.1) !important;
    }
    .feature-card .feature-icon i {
        color: #1b5a7a;
    }
    
    /* Warna accent untuk chart */
    .chart-accent {
        background: linear-gradient(135deg, #1b5a7a 0%, #2c8eb3 100%);
    }
    
    .min-vh-75 {
        min-height: 75vh;
    }
    .transition-all {
        transition: all 0.3s ease;
    }
    .feature-card {
        transition: all 0.3s ease;
        border-color: #e2e8f0 !important;
        background: white;
        border-radius: 1rem;
    }
    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 35px -10px rgba(15, 59, 92, 0.15);
        border-color: transparent !important;
    }
    .hero-illustration img {
        box-shadow: 0 25px 50px -12px rgba(15, 59, 92, 0.25);
        transition: transform 0.3s ease;
        border-radius: 1rem;
    }
    .hero-illustration img:hover {
        transform: scale(1.02);
    }
    .cta-section {
        background: linear-gradient(135deg, #0f3b5c 0%, #1b5a7a 100%);
        color: white;
    }
    .stat-item {
        transition: all 0.2s ease;
        border-radius: 0.75rem;
    }
    .stat-item:hover {
        background-color: #f8fafc !important;
        transform: translateY(-3px);
    }
    footer {
        background-color: #0a2a3f !important;
    }
    footer a {
        transition: opacity 0.2s ease;
        text-decoration: none;
    }
    footer a:hover {
        opacity: 0.7;
        color: white !important;
    }
    .bg-light {
        background-color: #f8fafc !important;
    }
    .text-secondary {
        color: #475569 !important;
    }
    
    @media (max-width: 768px) {
        .display-4 { font-size: 2rem; }
        .display-5 { font-size: 1.5rem; }
        .hero-section .min-vh-75 { min-height: auto; padding: 3rem 0; }
    }
</style>

<!-- Scripts untuk Chart.js dan Counter -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // CEK STATUS LOGIN (disesuaikan dengan auth Laravel Anda)
        const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
        
        let chart;
        const ctx = document.getElementById('usageChart').getContext('2d');
        const chartCaption = document.getElementById('chartCaption');
        
        // Data untuk grafik (akan diisi berdasarkan status login)
        let chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        let chartValues = [];
        let chartColor = '';
        let chartLabel = '';
        
        if (isLoggedIn) {
            // === GRAFIK TERISI (setelah login) ===
            chartCaption.textContent = '*Grafik tren peminjaman alat per bulan (data real)';
            chartCaption.classList.remove('text-muted');
            chartCaption.classList.add('text-primary', 'fw-medium');
            
            // Data real dari database (contoh, nanti bisa diganti dengan data dari controller)
            // Gunakan data statis untuk sementara
            chartValues = [42, 58, 72, 86, 95, 112, 108, 130, 145, 162, 178, 198];
            chartColor = '#1b5a7a';
            chartLabel = 'Jumlah Peminjaman';
            
        } else {
            // === GRAFIK KOSONG (belum login) ===
            chartCaption.textContent = '*Silahkan login terlebih dahulu untuk melihat data peminjaman';
            chartCaption.classList.add('text-muted', 'fst-italic');
            
            // Tampilkan grafik kosong (semua data 0)
            chartValues = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            chartColor = '#cbd5e1';
            chartLabel = 'Silahkan Login Terlebih Dahulu';
        }
        
        // Buat chart
        chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: chartLabel,
                    data: chartValues,
                    backgroundColor: chartColor,
                    borderRadius: 8,
                    barPercentage: 0.65,
                    categoryPercentage: 0.8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { 
                        position: 'top', 
                        labels: { 
                            font: { size: 12, family: "'Inter', sans-serif" } 
                        } 
                    },
                    tooltip: { 
                        backgroundColor: '#0f3b5c', 
                        titleColor: '#fff', 
                        bodyColor: '#e2e8f0',
                        callbacks: {
                            label: function(context) {
                                if (!isLoggedIn) {
                                    return 'Login untuk melihat data';
                                }
                                return context.parsed.y + ' Peminjaman';
                            }
                        }
                    }
                },
                scales: {
                    y: { 
                        grid: { color: '#e2e8f0' }, 
                        title: { display: true, text: 'Jumlah Peminjaman', color: '#475569' },
                        min: 0,
                        max: isLoggedIn ? null : 200
                    },
                    x: { 
                        grid: { display: false }, 
                        title: { display: true, text: 'Bulan', color: '#475569' } 
                    }
                }
            }
        });
        
        // Handle statistik counter hanya jika sudah login
        if (isLoggedIn) {
            // Data statistik real (contoh)
            const targetValues = [156, 2450, 98, 168];
            const elements = [
                document.getElementById('alatCount'),
                document.getElementById('userCount'),
                document.getElementById('satisfactionCount'),
                document.getElementById('hoursCount')
            ];
            
            function animateNumber(element, target, suffix = '') {
                if (!element) return;
                let current = 0;
                const increment = target / 60;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        element.textContent = target + suffix;
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(current) + suffix;
                    }
                }, 20);
            }
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateNumber(elements[0], targetValues[0], '');
                        animateNumber(elements[1], targetValues[1], '');
                        animateNumber(elements[2], targetValues[2], '%');
                        animateNumber(elements[3], targetValues[3], '');
                        observer.disconnect();
                    }
                });
            }, { threshold: 0.5 });
            
            const statsSection = document.querySelector('.stats-section');
            if (statsSection) observer.observe(statsSection);
        }
    });
</script>
@endsection