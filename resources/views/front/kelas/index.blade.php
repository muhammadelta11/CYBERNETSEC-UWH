@extends('layouts.front')
@section('content')

<style>
    /* Override text-muted color for better readability on BrainLab page in bright mode */
    .text-muted {
        color: #495057 !important; /* Darker shade for better readability in bright mode */
    }
    /* Dark mode overrides for better text readability */
    body[data-theme="dark"] .text-muted {
        color: #adb5bd !important;
    }
    body[data-theme="dark"] .card-text.text-muted {
        color: #adb5bd !important;
    }
    body[data-theme="dark"] .card-title.fw-bold.rk-heading a.text-dark {
        color: #f8f9fa !important;
    }
    /* Ensure links in cards are readable in bright mode */
    .card-title a.text-dark {
        color: #212529 !important; /* Dark color for bright mode */
    }
    body[data-theme="dark"] .card-title a.text-dark {
        color: #f8f9fa !important; /* Light color for dark mode */
    }
    /* Dark mode background fixes for better readability */
    body[data-theme="dark"] .bg-light {
        background-color: #2c3136 !important;
        color: #e5e7eb !important;
    }
    body[data-theme="dark"] .rk-kelas-hero {
        background: linear-gradient(135deg, #1a1a1a 0%, #2c3136 100%) !important;
    }
    body[data-theme="dark"] .rk-info-section .alert.alert-info {
        background-color: rgba(13, 110, 253, 0.1) !important;
        border-color: rgba(13, 110, 253, 0.2) !important;
        color: #e5e7eb !important;
    }
    body[data-theme="dark"] .rk-info-section .alert.alert-info .text-info {
        color: #0dcaf0 !important;
    }
    body[data-theme="dark"] .rk-category-card .card-body,
    body[data-theme="dark"] .rk-semester-card .card-body {
        background-color: #2c3136 !important;
        color: #e5e7eb !important;
    }
    body[data-theme="dark"] .rk-category-card .card-text.text-muted,
    body[data-theme="dark"] .rk-semester-card .card-text.text-muted {
        color: #adb5bd !important;
    }
    body[data-theme="dark"] .rk-empty-state {
        color: #e5e7eb !important;
    }
    body[data-theme="dark"] .rk-empty-state i {
        color: #6c757d !important;
    }

    /* Custom color for active "Semua" button text on BrainLab and Upskill pages */
    .rk-kelas-categories .btn-outline-primary.active {
        color: #ffffffff !important; /* Red color */
    }

    /* Add spacing between category and filter buttons on BrainLab and Upskill pages */
    .rk-kelas-categories .btn,
    .rk-kelas-filters .btn {
        margin-right: 8px;
        margin-bottom: 6px;
    }
</style>

<!-- Hero Section -->
<section class="rk-kelas-hero bg-light">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-lg-8 mx-auto text-center">
                <div data-aos="fade-up">
                    <h1 class="display-5 fw-bold mb-3 rk-heading">
                        @if($viewMode == 'upskill')
                            Program Upskill Mahasiswa
                        @else
                            BrainLab
                        @endif
                    </h1>
                    <p class="lead text-muted">
                        @if($viewMode == 'upskill')
                            Program upskill terstruktur khusus untuk mahasiswa dengan kurikulum akademik yang terintegrasi
                        @elseif($isMahasiswa)
                            Temukan program upskill terbaik yang sesuai dengan minat dan kebutuhan belajar Anda
                        @else
                            Temukan berbagai skill dan pengetahuan baru untuk mengembangkan diri Anda
                        @endif
                    </p>
                                        
                    <!-- Search Form -->
                    <div class="rk-kelas-search mt-4" data-aos="fade-up" data-aos-delay="100">
                        <form action="#" method="GET" class="d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-lg" placeholder="Cari kelas..." aria-label="Search classes">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                                        
                    <!-- Category Filters -->
                    <div class="rk-kelas-categories mt-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="#" class="btn btn-sm btn-outline-primary active">Semua</a>
                            <a href="#" class="btn btn-sm btn-outline-primary">Pemrograman</a>
                            <a href="#" class="btn btn-sm btn-outline-primary">Design</a>
                            <a href="#" class="btn btn-sm btn-outline-primary">Marketing</a>
                            <a href="#" class="btn btn-sm btn-outline-primary">Bisnis</a>
                        </div>
                    </div>

                    <!-- Price Filters -->
                    <div class="rk-kelas-filters mt-3" data-aos="fade-up" data-aos-delay="300">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="#" class="btn btn-sm btn-outline-success">Gratis</a>
                            <a href="#" class="btn btn-sm btn-outline-primary">Regular</a>
                            <a href="#" class="btn btn-sm btn-outline-warning">Premium</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Info Section for Non-Mahasiswa -->
@if(!$isMahasiswa)
<section class="rk-info-section py-4 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center" data-aos="fade-up">
                <div class="alert alert-info border-0 shadow-sm">
                    <i class="fas fa-info-circle fa-2x text-info mb-3"></i>
                    <h5 class="fw-bold text-info mb-2">Program Upskill Khusus Mahasiswa</h5>
                    <p class="mb-3">
                        Program upskill dengan kurikulum terstruktur khusus tersedia untuk mahasiswa yang telah terdaftar.
                        Pendaftaran mahasiswa hanya dapat dilakukan melalui admin sistem. Silakan hubungi administrator untuk informasi lebih lanjut.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <a href="{{ route('login') }}" class="btn btn-info">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Kelas Section -->
<section class="rk-kelas-section py-5">
    <div class="container">
        <div class="row justify-content-between mb-5">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3 rk-heading">
                    @if($isMahasiswa)
                        Program Upskill
                    @else
                        Katalog BrainLab
                    @endif
                </h2>
                <p class="text-muted">
                    @if($isMahasiswa)
                        Program upskill terstruktur untuk pengembangan karir mahasiswa
                    @else
                        Temukan berbagai pilihan kelas untuk mengembangkan skill Anda
                    @endif
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="rk-sort-filter" data-aos="fade-left">
                    <select class="form-select">
                        <option selected>Urutkan berdasarkan</option>
                        <option value="popular">Paling Populer</option>
                        <option value="newest">Terbaru</option>
                        <option value="price-low">Harga Terendah</option>
                        <option value="price-high">Harga Tertinggi</option>
                    </select>
                </div>
            </div>
        </div>

        @if($viewMode == 'upskill')
            <!-- Upskill Mode: Step-by-Step Hierarchical Structure -->

            <!-- Semesters Section -->
            <div id="semesters-section" class="rk-upskill-section">
                <div class="row">
                    @forelse ($semesters as $semester)
                    <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="rk-semester-card rk-card h-100 border-0 rk-shadow-hover cursor-pointer" onclick="selectSemester({{ $semester->id }})" data-semester-id="{{ $semester->id }}">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-graduation-cap fa-3x text-primary mb-3"></i>
                                <h5 class="card-title fw-bold mb-2">{{ $semester->name }}</h5>
                                @if($semester->description)
                                <p class="card-text text-muted small mb-3">{{ $semester->description }}</p>
                                @endif
                                <div class="rk-semester-stats">
                                    <span class="badge bg-primary fs-6 px-3 py-2">{{ $semester->upskillCategories->sum(function($cat) { return $cat->kelas->count(); }) }} Kelas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up">
                        <div class="rk-empty-state">
                            <i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada program upskill tersedia untuk angkatan Anda</h4>
                            <p class="text-muted">Silakan kembali lagi nanti untuk melihat program terbaru</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Categories Section -->
            <div id="categories-section" class="rk-upskill-section d-none">
                <div class="rk-navigation mb-4">
                    <button class="btn btn-outline-secondary" id="back-to-semesters" onclick="backToSemesters()">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Semester
                    </button>
                    <h4 class="mb-0 ms-3 d-inline" id="current-semester-title"></h4>
                </div>
                <div id="categories-container" class="row">
                    <!-- Categories will be populated by JavaScript -->
                </div>
            </div>

            <!-- Classes Section -->
            <div id="classes-section" class="rk-upskill-section d-none">
                <div class="rk-navigation mb-4">
                    <button class="btn btn-outline-secondary" id="back-to-categories" onclick="backToCategories()">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Kategori
                    </button>
                    <h4 class="mb-0 ms-3 d-inline" id="current-category-title"></h4>
                </div>
                <div id="classes-container" class="row">
                    <!-- Classes will be populated by JavaScript -->
                </div>
            </div>

            <!-- Hidden data for JavaScript -->
            <div id="upskill-data" class="d-none">
                @foreach ($semesters as $semester)
                <div class="semester-data" data-semester-id="{{ $semester->id }}" data-semester-name="{{ $semester->name }}" data-semester-desc="{{ $semester->description }}">
                    @foreach ($semester->upskillCategories as $category)
                    <div class="category-data" data-category-id="{{ $category->id }}" data-category-name="{{ $category->name }}" data-category-desc="{{ $category->description }}">
                        @foreach ($category->kelas as $kelas)
                        <div class="kelas-data"
                             data-kelas-id="{{ $kelas->id }}"
                             data-name="{{ $kelas->name_kelas }}"
                             data-desc="{{ strip_tags($kelas->description_kelas) }}"
                             data-thumbnail="{{ asset('storage/' . $kelas->thumbnail) }}"
                             data-type="{{ $kelas->type_kelas }}"
                             data-harga="{{ $kelas->harga ?? 0 }}"
                             data-encrypted-id="{{ Crypt::encrypt($kelas->id) }}">
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        @else
            <!-- SkilLab Mode: Step-by-Step Category to Classes -->

            <!-- Categories Section -->
            <div id="skilLab-categories-section" class="rk-upskill-section">
                <div class="row">
                    @forelse ($categories as $category)
                    <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
<div class="rk-category-card rk-card h-100 rk-shadow-hover" data-category-id="{{ $category->id }}">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-folder fa-3x text-warning mb-3"></i>
                                <h5 class="card-title fw-bold mb-2">{{ $category->name }}</h5>
                                @if($category->description)
                                <p class="card-text text-muted small mb-3">{{ $category->description }}</p>
                                @endif
                                <div class="rk-category-stats">
                                <span class="badge bg-secondary fs-6 px-3 py-2 text-white">{{ $category->kelas->count() }} Kelas</span>
                            </div>
                                <button class="btn btn-primary mt-3" onclick="selectSkilLabCategory('{{ $category->id }}')">Lihat Kelas</button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up">
                        <div class="rk-empty-state">
                            <i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada kategori tersedia</h4>
                            <p class="text-muted">Silakan kembali lagi nanti untuk melihat program terbaru</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Classes Section -->
            <div id="skilLab-classes-section" class="rk-upskill-section d-none">
                <div class="rk-navigation mb-4">
                    <button class="btn btn-outline-secondary" onclick="backToSkilLabCategories()">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Kategori
                    </button>
                    <h4 class="mb-0 ms-3 d-inline" id="skilLab-current-category-title"></h4>
                </div>
                <div id="skilLab-classes-container" class="row">
                    <!-- Classes will be populated by JavaScript -->
                </div>
            </div>

            <!-- Hidden data for SkilLab JavaScript -->
            <div id="skilLab-data" class="d-none">
                @foreach ($categories as $category)
                <div class="skilLab-category-data" data-category-id="{{ $category->id }}" data-category-name="{{ $category->name }}" data-category-desc="{{ $category->description }}">
                    @foreach ($category->kelas as $kelas)
                    <div class="skilLab-kelas-data"
                         data-kelas-id="{{ $kelas->id }}"
                         data-name="{{ $kelas->name_kelas }}"
                         data-desc="{{ strip_tags($kelas->description_kelas) }}"
                         data-thumbnail="{{ asset('storage/' . $kelas->thumbnail) }}"
                         data-type="{{ $kelas->type_kelas }}"
                         data-harga="{{ $kelas->harga ?? 0 }}"
                         data-encrypted-id="{{ Crypt::encrypt($kelas->id) }}">
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        @endif
        

    </div>
</section>

@if(!auth()->check())
<!-- CTA Section -->
<section class="rk-cta-section bg-primary py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center text-white" data-aos="fade-up">
                <h3 class="fw-bold mb-3">Siap Memulai Perjalanan Belajar Anda?</h3>
                <p class="mb-4">Bergabunglah dengan komunitas pembelajar kami dan raih skill baru untuk masa depan yang lebih baik</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('register.umum') }}" class="rk-btn-primary btn-lg">
                        Daftar Sekarang <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<style>
    /* Kelas Hero Section */
    .rk-kelas-hero {
        padding: 120px 0 60px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        margin-top: -1px;
    }
    
    .rk-kelas-search .input-group {
        max-width: 500px;
        margin: 0 auto;
    }
    
    .rk-kelas-search .form-control {
        border-right: 0;
        border-radius: 50px 0 0 50px;
        padding-left: 25px;
    }
    
    .rk-kelas-search .btn {
        border-radius: 0 50px 50px 0;
        padding: 0.75rem 1.5rem;
    }
    
    .rk-kelas-categories .btn,
    .rk-kelas-filters .btn {
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    
    .rk-kelas-categories .btn.active,
    .rk-kelas-categories .btn:hover,
    .rk-kelas-filters .btn:hover {
        background: var(--rk-primary);
        color: white;
        border-color: var(--rk-primary);
    }
    
    /* Kelas Cards */
    .rk-kelas-card {
        border-radius: var(--rk-radius);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .rk-kelas-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--rk-shadow) !important;
    }

    /* Change color of specific title "Jaringan Komputer1" to red */
    .rk-kelas-card .judul-brain a.text-dark {
        color: black !important;
    }
    
    .rk-kelas-thumb {
        overflow: hidden;
        position: relative;
    }
    
    .rk-kelas-thumb img {
        transition: transform 0.5s ease;
    }
    
    .rk-kelas-card:hover .rk-kelas-thumb img {
        transform: scale(1.05);
    }
    
    .rk-kelas-overlay {
        top: 0;
        left: 0;
        background: linear-gradient(to bottom, transparent 0%, transparent 50%, rgba(0,0,0,0.01) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .rk-kelas-card:hover .rk-kelas-overlay {
        opacity: 1;
    }
    
    .rk-line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 72px;
    }
    
    /* Sort Filter */
    .rk-sort-filter .form-select {
        border-radius: 50px;
        padding: 0.5rem 1.5rem;
    }

    /* Dark mode styles for dropdown select */
    body[data-theme="dark"] .rk-sort-filter .form-select {
        background-color: #121212 !important;
        color: #e5e7eb !important;
        border-color: #333 !important;
        /* For dropdown arrow color in some browsers */
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3e%3cpath fill='%23e5e7eb' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") !important;
        background-repeat: no-repeat !important;
        background-position: right 0.75rem center !important;
        background-size: 8px 10px !important;
    }
    
    /* CTA Section */
    .rk-cta-section {
        background: var(--rk-gradient) !important;
    }
    
    /* Pagination */
    .rk-kelas-section .pagination {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }
    
    .rk-kelas-section .page-item {
        margin: 0 0.25rem;
    }
    
    .rk-kelas-section .page-link {
        border-radius: 8px;
        border: 1px solid #dee2e6;
        color: var(--rk-dark);
        padding: 0.5rem 0.75rem;
        transition: all 0.3s ease;
    }
    
    .rk-kelas-section .page-item.active .page-link {
        background: var(--rk-primary);
        border-color: var(--rk-primary);
        color: white;
    }
    
    .rk-kelas-section .page-link:hover {
        background: rgba(67, 97, 238, 0.1);
        color: var(--rk-primary);
        border-color: #dee2e6;
    }
    
    .rk-kelas-section .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
    }
    
    /* Empty State */
    .rk-empty-state {
        padding: 3rem 1rem;
    }
    
    /* Responsive Design */
    @media (max-width: 991.98px) {
        .rk-kelas-hero {
            padding: 100px 0 40px;
        }
        
        .rk-sort-filter {
            margin-top: 1rem;
        }
    }
    
    @media (max-width: 768px) {
        .rk-kelas-hero {
            padding: 80px 0 40px;
            overflow: visible !important;
        }
        
        .rk-kelas-hero > .container > .row > .col-lg-8 {
            width: 100% !important;
            padding: 0 15px !important;
        }

        .rk-kelas-search {
            display: block !important;
            width: 100% !important;
        }
        .rk-kelas-search .input-group {
            flex-direction: column;
            width: 100% !important;
        }
        
        .rk-kelas-search .form-control {
            border-radius: 50px;
            margin-bottom: 10px;
            border-right: 1px solid #ced4da !important;
            width: 100% !important;
            box-sizing: border-box;
        }
        
        .rk-kelas-search .btn {
            border-radius: 50px;
            width: 100%;
            box-sizing: border-box;
        }
        
        .rk-kelas-categories,
        .rk-kelas-filters {
            overflow-x: auto;
            padding-bottom: 10px;
        }
        
        .rk-kelas-categories .d-flex,
        .rk-kelas-filters .d-flex {
            flex-wrap: nowrap;
            justify-content: flex-start !important;
        }
        
        .rk-kelas-section .pagination {
            flex-wrap: wrap;
        }
        
        .rk-kelas-section .page-item {
            margin: 0.125rem;
        }
        
        .display-5 {
            font-size: 2.2rem;
        }
        
        .rk-cta-section .d-flex {
            flex-direction: column;
            gap: 1rem !important;
        }
        
        .rk-cta-section .btn {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .rk-kelas-hero > .container > .row > .col-lg-8 {
            padding: 0 10px !important;
        }
        .rk-kelas-search .form-control,
        .rk-kelas-search .btn {
            border-radius: 30px !important;
            font-size: 1rem !important;
            padding: 0.5rem 1rem !important;
        }
    }

    @media (max-width: 400px) {
        .rk-kelas-search .form-control,
        .rk-kelas-search .btn {
            font-size: 0.9rem !important;
            padding: 0.4rem 0.8rem !important;
        }
    }
    
    @media (max-width: 576px) {
        .rk-kelas-thumb {
            height: 180px;
        }
        
        .rk-kelas-hero {
            padding: 70px 0 30px;
        }
        
        .rk-kelas-section {
            padding: 2rem 0;
        }
    }
    
    /* Memastikan konten tidak tertutup oleh fixed navbar */
    .rk-kelas-hero {
        padding-top: calc(80px + 2rem);
    }

    /* Upskill Step-by-Step Styles */
    .rk-upskill-section {
        min-height: 400px;
    }

    .rk-semester-card,
    .rk-category-card {
        border-radius: var(--rk-radius);
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .rk-semester-card:hover,
    .rk-category-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        transform: translateY(-5px);
    }

    .rk-semester-card .card-body,
    .rk-category-card .card-body {
        padding: 2rem 1.5rem;
    }

    .rk-semester-stats .badge,
    .rk-category-stats .badge {
        font-size: 0.9rem;
        padding: 0.6rem 1rem;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .rk-navigation {
        align-items: center;
    }

    .rk-navigation .btn {
        border-radius: 50px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .rk-navigation .btn:hover {
        transform: translateX(-2px);
    }

    /* Responsive adjustments for step-by-step */
    @media (max-width: 768px) {
        .rk-semester-card .card-body,
        .rk-category-card .card-body {
            padding: 1.5rem 1rem;
        }

        .rk-semester-card .fa-graduation-cap,
        .rk-category-card .fa-folder {
            font-size: 2rem !important;
        }

        .rk-navigation {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start !important;
        }

        .rk-navigation h4 {
            margin-left: 0 !important;
            margin-top: 0.5rem;
        }
    }
</style>

@endsection

<script>
let currentSemesterId = null;
let currentCategoryId = null;

function selectSemester(semesterId) {
    currentSemesterId = semesterId;
    const semesterData = $(`.semester-data[data-semester-id="${currentSemesterId}"]`);
    const semesterName = semesterData.data('semester-name');

    // Update title
    $('#current-semester-title').text(semesterName);

    // Populate categories
    const categoriesContainer = $('#categories-container');
    categoriesContainer.empty();

    semesterData.find('.category-data').each(function(index) {
        const categoryId = $(this).data('category-id');
        const categoryName = $(this).data('category-name');
        const categoryDesc = $(this).data('category-desc');
        const kelasCount = $(this).find('.kelas-data').length;

        const categoryCard = `
                <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up">
                    <div class="rk-category-card rk-card h-100 border-0 rk-shadow-hover cursor-pointer" onclick="selectCategory(${categoryId})" data-category-id="${categoryId}">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-folder fa-3x text-warning mb-3"></i>
                        <h5 class="card-title fw-bold mb-2">${categoryName}</h5>
                        ${categoryDesc ? `<p class="card-text text-muted small mb-3">${categoryDesc}</p>` : ''}
                        <div class="rk-category-stats">
                            <span class="badge bg-secondary fs-6 px-3 py-2">${kelasCount} Kelas</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        categoriesContainer.append(categoryCard);
    });

    // Show categories section, hide semesters
    $('#semesters-section').addClass('d-none');
    $('#categories-section').removeClass('d-none');
    $('#classes-section').addClass('d-none');
}

function selectCategory(categoryId) {
    currentCategoryId = categoryId;
    const categoryData = $(`.category-data[data-category-id="${currentCategoryId}"]`);
    const categoryName = categoryData.data('category-name');

    // Update title
    $('#current-category-title').text(categoryName);

    // Populate classes
    const classesContainer = $('#classes-container');
    classesContainer.empty();

    categoryData.find('.kelas-data').each(function(index) {
        const kelasId = $(this).data('kelas-id');
        const name = $(this).data('name');
        const desc = $(this).data('desc');
        const thumbnail = $(this).data('thumbnail');
        const type = $(this).data('type');
        const harga = parseInt($(this).data('harga')) || 0;
        const encryptedId = $(this).data('encrypted-id');

        let priceText = '';
        if (type == 0) {
            priceText = '<span class="text-success fw-bold">Gratis</span>';
        } else if (type == 1) {
            priceText = '<span class="text-primary fw-bold">Regular</span>';
        } else if (type == 2) {
            priceText = '<span class="text-warning fw-bold">Premium</span>';
        } else if (type == 3) {
            priceText = `<span class="text-primary fw-bold">Rp ${new Intl.NumberFormat('id-ID').format(harga)}</span>`;
        } else if (type == 4) {
            priceText = `<span class="text-primary fw-bold">Rp ${new Intl.NumberFormat('id-ID').format(harga)}</span>`;
        } else {
            priceText = '<span class="text-primary fw-bold">Berbayar</span>';
        }

        const kelasCard = `
            <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="${index * 100}">
                <div class="rk-kelas-card rk-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-kelas-thumb position-relative">
                        <img src="${thumbnail}" class="card-img-top" alt="${name}" style="height: 200px; object-fit: cover;">
                        <div class="rk-kelas-badge position-absolute top-0 end-0 m-3">
                            ${type == 0 ? '<span class="badge bg-success">Gratis</span>' :
                              type == 1 ? '<span class="badge bg-primary">Regular</span>' :
                              type == 2 ? '<span class="badge bg-warning">Premium</span>' :
                              type == 3 ? '<span class="badge bg-info">Program Upskill</span>' :
                              type == 4 ? '<span class="badge bg-info">Skillabs</span>' : ''}
                        </div>
                        <div class="rk-kelas-overlay position-absolute w-100 h-100"></div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold rk-heading">
                            <a href="/kelas/detail/${encryptedId}" class="text-dark text-decoration-none">${name}</a>
                        </h5>
                        <p class="card-text text-muted rk-line-clamp-3">${desc}</p>
                        <div class="rk-kelas-meta d-flex justify-content-between align-items-center mt-3">
                            <div class="rk-kelas-rating">
                                <small class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span class="text-muted ms-1">4.5</span>
                                </small>
                            </div>
                            <div class="rk-kelas-students">
                                <small class="text-muted">
                                    <i class="fas fa-users me-1"></i> 250
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="rk-kelas-price">${priceText}</div>
                            <a href="/kelas/detail/${encryptedId}" class="btn btn-sm btn-outline-primary">
                                Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `;
        classesContainer.append(kelasCard);
    });

    // Show classes section, hide categories
    $('#semesters-section').addClass('d-none');
    $('#categories-section').addClass('d-none');
    $('#classes-section').removeClass('d-none');
}

function backToSemesters() {
    $('#semesters-section').removeClass('d-none');
    $('#categories-section').addClass('d-none');
    $('#classes-section').addClass('d-none');
    currentSemesterId = null;
    currentCategoryId = null;
}

function backToCategories() {
    $('#semesters-section').addClass('d-none');
    $('#categories-section').removeClass('d-none');
    $('#classes-section').addClass('d-none');
    currentCategoryId = null;
}

function selectSkilLabCategory(categoryId) {
    const categoryData = $(`.skilLab-category-data[data-category-id="${categoryId}"]`);
    const categoryName = categoryData.data('category-name');

    // Update title
    $('#skilLab-current-category-title').text(categoryName);

    // Populate classes
    const classesContainer = $('#skilLab-classes-container');
    classesContainer.empty();

    categoryData.find('.skilLab-kelas-data').each(function(index) {
        const kelasId = $(this).data('kelas-id');
        const name = $(this).data('name');
        const desc = $(this).data('desc');
        const thumbnail = $(this).data('thumbnail');
        const type = $(this).data('type');
        const harga = parseInt($(this).data('harga')) || 0;
        const encryptedId = $(this).data('encrypted-id');

        let priceText = '';
        if (type == 0) {
            priceText = '<span class="text-success fw-bold">Gratis</span>';
        } else if (type == 1) {
            priceText = '<span class="text-primary fw-bold">Regular</span>';
        } else if (type == 2) {
            priceText = '<span class="text-warning fw-bold">Premium</span>';
        } else if (type == 3) {
            priceText = `<span class="text-primary fw-bold">Rp ${new Intl.NumberFormat('id-ID').format(harga)}</span>`;
        } else if (type == 4) {
            priceText = `<span class="text-primary fw-bold">Rp ${new Intl.NumberFormat('id-ID').format(harga)}</span>`;
        } else {
            priceText = '<span class="text-primary fw-bold">Berbayar</span>';
        }

        const kelasCard = `
            <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="${index * 100}">
                <div class="rk-kelas-card rk-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-kelas-thumb position-relative">
                        <img src="${thumbnail}" class="card-img-top" alt="${name}" style="height: 200px; object-fit: cover;">
                        <div class="rk-kelas-badge position-absolute top-0 end-0 m-3">
                            ${type == 0 ? '<span class="badge bg-success">Gratis</span>' :
                              type == 1 ? '<span class="badge bg-primary">Regular</span>' :
                              type == 2 ? '<span class="badge bg-warning">Premium</span>' :
                              type == 3 ? '<span class="badge bg-info">Program Upskill</span>' :
                              type == 4 ? '<span class="badge bg-info">Skillabs</span>' : ''}
                        </div>
                        <div class="rk-kelas-overlay position-absolute w-100 h-100"></div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title judul-brain fw-bold rk-heading">
                            <a href="/kelas/detail/${encryptedId}" class="text-dark text-decoration-none" style="color: red !important;">${name}</a>
                        </h5>
                        <p class="card-text text-muted rk-line-clamp-3">${desc}</p>
                        <div class="rk-kelas-meta d-flex justify-content-between align-items-center mt-3">
                            <div class="rk-kelas-rating">
                                <small class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span class="text-muted ms-1">4.5</span>
                                </small>
                            </div>
                            <div class="rk-kelas-students">
                                <small class="text-muted">
                                    <i class="fas fa-users me-1"></i> 250
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="rk-kelas-price">${priceText}</div>
                            <a href="/kelas/detail/${encryptedId}" class="btn btn-sm btn-outline-primary">
                                Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `;
        classesContainer.append(kelasCard);
    });

    // Show classes section, hide categories
    $('#skilLab-categories-section').addClass('d-none');
    $('#skilLab-classes-section').removeClass('d-none');
}

function backToSkilLabCategories() {
    $('#skilLab-categories-section').removeClass('d-none');
    $('#skilLab-classes-section').addClass('d-none');
}
</script>
