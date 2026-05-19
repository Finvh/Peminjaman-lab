<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', config('app.name', 'LabBooking')) - Sistem Peminjaman Alat Laboratorium</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Sistem peminjaman alat laboratorium modern, efisien, dan mudah digunakan untuk mendukung kegiatan akademik dan penelitian">
    <meta name="keywords" content="lab, booking, laboratorium, peminjaman alat, manajemen lab">
    <meta name="author" content="LabBooking">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a67d8, #6b46a0);
        }
        
        /* Main Container */
        .app-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Custom Navbar */
        .custom-navbar {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            padding: 1rem 0;
            transition: all 0.3s ease;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .custom-navbar.scrolled {
            padding: 0.7rem 0;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.12);
            background: rgba(255, 255, 255, 0.98);
        }
        
        .navbar-brand-custom {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-decoration: none;
            transition: transform 0.3s ease;
        }
        
        .navbar-brand-custom:hover {
            transform: scale(1.05);
        }
        
        .nav-link-custom {
            color: #4a5568;
            font-weight: 500;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-link-custom:hover {
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }
        
        .nav-link-custom.active {
            color: #667eea;
            background: rgba(102, 126, 234, 0.15);
        }
        
        /* Button Custom */
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .btn-outline-custom {
            background: transparent;
            border: 2px solid #667eea;
            color: #667eea;
            padding: 0.6rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-custom:hover {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-color: transparent;
            color: white;
            transform: translateY(-2px);
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            padding: 2rem 0;
        }
        
        .content-wrapper {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            min-height: 500px;
        }
        
        /* Alert Custom */
        .alert-custom {
            border-radius: 15px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            animation: slideDown 0.5s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Footer */
        .custom-footer {
            background: linear-gradient(135deg, #1a202c, #2d3748);
            color: #a0aec0;
            padding: 3rem 0 1rem 0;
            margin-top: auto;
        }
        
        .footer-title {
            color: white;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }
        
        .footer-title:after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 10px;
        }
        
        .footer-link {
            color: #a0aec0;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin-bottom: 0.75rem;
        }
        
        .footer-link:hover {
            color: #667eea;
            transform: translateX(5px);
        }
        
        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            margin-right: 0.5rem;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
        }
        
        .social-icon:hover {
            background: linear-gradient(135deg, #667eea, #764ba2);
            transform: translateY(-3px);
        }
        
        /* Card Custom */
        .card-custom {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }
        
        /* Back to Top */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
            cursor: pointer;
        }
        
        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top:hover {
            transform: translateY(-5px);
            color: white;
        }
        
        /* Loading Spinner */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.95);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            flex-direction: column;
        }
        
        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #e2e8f0;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 1rem;
            }
            
            .navbar-brand-custom {
                font-size: 1.2rem;
            }
        }
        
        /* Dropdown Custom */
        .dropdown-menu-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 0.5rem;
            margin-top: 0.5rem;
        }
        
        .dropdown-item-custom {
            padding: 0.6rem 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .dropdown-item-custom:hover {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            transform: translateX(5px);
        }
        
        /* Avatar */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="app-container">
        <!-- Loading Overlay -->
        <div class="loading-overlay" id="loadingOverlay">
            <div class="spinner mb-3"></div>
            <p class="text-gray-600">Memuat...</p>
        </div>
        
       <!-- Navbar -->
<nav class="custom-navbar" id="navbar">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <a href="{{ route('landing') }}" class="navbar-brand-custom">
                <i class="bi bi-flask"></i> LabBooking
            </a>
            
            <!-- Mobile Menu Button -->
            <button class="btn d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
                <i class="bi bi-list fs-2"></i>
            </button>
            
            <!-- Desktop Menu -->
            <div class="d-none d-md-flex align-items-center gap-2">
                <a href="{{ route('landing') }}" class="nav-link-custom {{ request()->routeIs('landing') ? 'active' : '' }}">
                    <i class="bi bi-house"></i> Beranda
                </a>
                
                @auth
                    @if(Auth::user()->role === 'admin')
                        {{-- Menu Khusus Admin --}}
                        <a href="{{ route('admin.dashboard') }}" class="nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i> Admin Dash
                        </a>
                        <a href="{{ route('admin.barang') }}" class="nav-link-custom {{ request()->routeIs('admin.barang') ? 'active' : '' }}">
                            <i class="bi bi-box-seam"></i> Kelola Barang
                        </a>
                        <a href="{{ route('admin.users') }}" class="nav-link-custom {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                            <i class="bi bi-people"></i> Kelola User
                        </a>
                    @else
                        {{-- Menu Khusus User/Mahasiswa --}}
                        <a href="{{ route('user.dashboard') }}" class="nav-link-custom {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <a href="{{ route('user.barang') }}" class="nav-link-custom {{ request()->routeIs('user.barang') ? 'active' : '' }}">
                            <i class="bi bi-tools"></i> Daftar Alat
                        </a>
                        <a href="{{ route('user.booking.create') }}" class="nav-link-custom {{ request()->routeIs('user.booking.create') ? 'active' : '' }}">
                            <i class="bi bi-calendar-plus"></i> Booking
                        </a>
                    @endif
                    
                    <!-- User Dropdown -->
                    <div class="dropdown ms-3">
                        <button class="btn dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="d-none d-lg-inline">{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom">
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person-circle"></i> Profil Saya
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item dropdown-item-custom text-danger">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-outline-custom me-2">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary-custom">
                        <i class="bi bi-person-plus"></i> Daftar
                    </a>
                @endauth
            </div>
        </div>
        
        <!-- Mobile Menu (Menu HP) -->
        <div class="collapse mt-3 d-md-none" id="mobileMenu">
            <div class="d-flex flex-column gap-2">
                <a href="{{ route('landing') }}" class="nav-link-custom">Beranda</a>
                
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="nav-link-custom">Dashboard Admin</a>
                        <a href="{{ route('admin.barang') }}" class="nav-link-custom">Kelola Barang</a>
                        <a href="{{ route('admin.users') }}" class="nav-link-custom">Kelola User</a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="nav-link-custom">Dashboard</a>
                        <a href="{{ route('user.barang') }}" class="nav-link-custom">Daftar Alat</a>
                        <a href="{{ route('user.booking.create') }}" class="nav-link-custom">Booking</a>
                    @endif
                    <hr>
                    <a href="{{ route('profile.edit') }}" class="nav-link-custom">Profil Saya</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link-custom text-danger w-100 text-start border-0 bg-transparent">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-outline-custom text-center">Login</a>
                    <a href="{{ route('register') }}" class="btn-primary-custom text-center">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
        <!-- Page Header (Optional) -->
        @if(isset($header))
            <div class="bg-gradient-primary py-4" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                <div class="container">
                    <h1 class="text-white mb-0 fs-2">{{ $header }}</h1>
                    @if(isset($subheader))
                        <p class="text-white-50 mt-2 mb-0">{{ $subheader }}</p>
                    @endif
                </div>
            </div>
        @endif
        
        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-custom" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                            <div>
                                <strong>Sukses!</strong><br>
                                {{ session('success') }}
                            </div>
                        </div>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-custom" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                            <div>
                                <strong>Error!</strong><br>
                                {{ session('error') }}
                            </div>
                        </div>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-warning alert-custom" role="alert">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-exclamation-circle-fill fs-4 me-3"></i>
                            <div>
                                <strong>Validasi Gagal!</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                
                <!-- Content Wrapper -->
                <div class="content-wrapper" data-aos="fade-up">
                    @yield('content')
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <footer class="custom-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h4 class="footer-title">LabBooking</h4>
                        <p class="text-secondary">
                            Solusi cerdas untuk manajemen peminjaman alat laboratorium. Efisien, transparan, dan mudah digunakan.
                        </p>
                        <div class="mt-3">
                            <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-md-2 col-6 mb-4 mb-md-0">
                        <h5 class="text-white mb-3">Tautan</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('/') }}" class="footer-link">Beranda</a></li>
                            <li><a href="#" class="footer-link">Tentang</a></li>
                            <li><a href="#" class="footer-link">Layanan</a></li>
                            <li><a href="#" class="footer-link">Kontak</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-md-2 col-6 mb-4 mb-md-0">
                        <h5 class="text-white mb-3">Bantuan</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="footer-link">FAQ</a></li>
                            <li><a href="#" class="footer-link">Panduan</a></li>
                            <li><a href="#" class="footer-link">Privasi</a></li>
                            <li><a href="#" class="footer-link">Syarat</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-md-4">
                        <h5 class="text-white mb-3">Kontak Kami</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-geo-alt text-primary me-2"></i>
                                <span class="text-secondary">Jl. Laboratorium No. 123, Kota Bandung</span>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-envelope text-primary me-2"></i>
                                <span class="text-secondary">info@labbooking.com</span>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-telephone text-primary me-2"></i>
                                <span class="text-secondary">+62 812 3456 7890</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <hr class="bg-secondary mt-4">
                
                <div class="text-center text-secondary pt-3">
                    <p class="mb-0">&copy; {{ date('Y') }} LabBooking. All rights reserved.</p>
                </div>
            </div>
        </footer>
        
        <!-- Back to Top Button -->
        <div class="back-to-top" id="backToTop">
            <i class="bi bi-arrow-up"></i>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            const backToTop = document.getElementById('backToTop');
            
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
                backToTop.classList.add('show');
            } else {
                navbar.classList.remove('scrolled');
                backToTop.classList.remove('show');
            }
        });
        
        // Back to top
        document.getElementById('backToTop').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Loading overlay
        document.addEventListener('DOMContentLoaded', function() {
            const loadingOverlay = document.getElementById('loadingOverlay');
            if (loadingOverlay) {
                setTimeout(() => {
                    loadingOverlay.style.display = 'none';
                }, 500);
            }
        });
        
        // Show loading on link click
        document.querySelectorAll('a:not([target="_blank"]):not([href^="#"]):not([href^="javascript"])').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.href && !this.href.includes('#') && !this.href.includes('javascript')) {
                    const loadingOverlay = document.getElementById('loadingOverlay');
                    if (loadingOverlay) {
                        loadingOverlay.style.display = 'flex';
                    }
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>