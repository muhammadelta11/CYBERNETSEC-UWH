@extends('layouts.front')
@section('content')

<!-- Hero Section -->
<section class="rk-hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                <div class="rk-hero-content">
                    <h6 class="rk-text-accent mb-2"><i class="fas fa-graduation-cap me-2"></i>Official Research Hub</h6>
                    <h1 class="display-4 fw-bold mb-4">UNWAHAS <span class="rk-text-primary">CYBERNETSEC LABORATORY</span></h1>
                    <p class="lead mb-4">Pusat riset dan inovasi di bidang Cyber Security, Artificial Intelligence, Network Engineering, dan Cloud Computing. Kami hadir untuk membangun masa depan teknologi digital yang lebih aman dan cerdas.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('kelas') }}" class="rk-btn-primary">Tentang Kami</a>
                        <a href="#feature" class="btn btn-outline-primary d-flex align-items-center">
                            <i class="fas fa-play-circle me-2"></i> Riset Kami
                        </a>
                    </div>
                    <div class="d-flex mt-4">
                        <div class="me-4">
                            <h4 class="fw-bold mb-0">8+</h4>
                            <p class="text-muted mb-0">Proyek Riset</p>
                        </div>
                        <div class="me-4">
                            <h4 class="fw-bold mb-0">7+</h4>
                            <p class="text-muted mb-0">Anggota Aktif</p>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">5+</h4>
                            <p class="text-muted mb-0">Kolaborasi Industri</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                <div class="rk-hero-image position-relative">
                    <img src="{{ asset('frontemplate') }}/img/gallery/fotbar.png" alt="Hero Image" class="img-fluid rounded-3 shadow">
                    <!-- <div class="position-absolute top-0 start-0 bg-primary text-white p-3 rounded-circle shadow" style="transform: translate(-30%, -30%);">
                        <i class="fas fa-play fs-5"></i>
                    </div> -->
                    <!-- <div class="position-absolute bottom-0 end-0 bg-white p-3 rounded-3 shadow" style="transform: translate(-20%, -20%); width: 200px;">
                        <div class="d-flex align-items-center">
                            <div class="bg-success p-2 rounded-circle me-2">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-bold">Materi Terbaru</p>
                                <small class="text-muted">Update Setiap Minggu</small>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="rk-section py-5" id="feature">
    <div class="container py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h2 class="fw-bold mb-3 rk-heading">Bidang Riset Utama</h2>
                <p class="text-muted">Fokus kami dalam pengembangan teknologi digital dan keamanan siber</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="rk-card h-100 border-0 rk-shadow-hover">
                    <div class="card-body p-4 text-center">
                        <div class="rk-icon-wrapper bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                            <i class="fas fa-layer-group fs-3 text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3 rk-heading">Cyber Security</h4>
                        <p class="text-muted">Proteksi sistem, jaringan, dan data dari ancaman digital modern.</p>
                        <div class="mt-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary py-2 px-3">Akses Tanpa Batas</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="rk-card h-100 border-0 rk-shadow-hover">
                    <div class="card-body p-4 text-center">
                        <div class="rk-icon-wrapper bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                            <i class="fas fa-user-plus fs-3 text-success"></i>
                        </div>
                        <h4 class="fw-bold mb-3 rk-heading">Artificial Intelligence & Cloud Computing</h4>
                        <p class="text-muted">Pemanfaatan AI untuk solusi inovatif di pendidikan & industri.</p>
                        <div class="mt-4">
                            <span class="badge bg-success bg-opacity-10 text-success py-2 px-3">Daftar Gratis</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="rk-card h-100 border-0 rk-shadow-hover">
                    <div class="card-body p-4 text-center">
                        <div class="rk-icon-wrapper bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                            <i class="fas fa-crown fs-3 text-warning"></i>
                        </div>
                        <h4 class="fw-bold mb-3 rk-heading">Network Engineering</h4>
                        <p class="text-muted">Optimasi jaringan & keamanan untuk menunjang aktivitas digital.</p>
                        <div class="mt-4">
                            <span class="badge bg-warning bg-opacity-10 text-warning py-2 px-3">Fitur Eksklusif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="rk-section py-5 bg-light">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <img src="{{ asset('frontemplate') }}/img/learning_img.png" alt="About Us" class="img-fluid rounded-3 shadow">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="ps-lg-5">
                    <h6 class="text-primary mb-2">Tentang Kami</h6>
                    <h2 class="fw-bold mb-4 rk-heading">Mencetak Inovasi Digital</h2>
                    @php
                    $setting = \App\Setting::first();
                    $aboutContent = $setting ? $setting->about : '<p>Unwahas Cybernetsec Lab adalah laboratorium riset resmi Universitas Wahid Hasyim Semarang yang berfokus pada keamanan jaringan, kecerdasan buatan, dan cloud computing. Kami menghubungkan akademisi, mahasiswa, dan industri dalam satu ekosistem riset kolaboratif.</p>';
                    @endphp
                    {!! $aboutContent !!}
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary p-2 rounded-circle me-3">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Berbasis Riset Nyata</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary p-2 rounded-circle me-3">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Kolaborasi Industri</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary p-2 rounded-circle me-3">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Fokus Keamanan Digital</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary p-2 rounded-circle me-3">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Didukung Akademisi & Mahasiswa</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Courses -->
<section class="rk-section py-5">
    <div class="container py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h2 class="fw-bold mb-3 rk-heading">Materi Pembelajaran</h2>
                <p class="text-muted">Membangun masa depan teknologi digital yang lebih aman dan cerdas.</p>
            </div>
        </div>
        <div class="row">
            @foreach ($kelas as $item)
            <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="rk-card course-card h-100 border-0 rk-shadow-hover">
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" class="card-img-top" alt="{{ $item->name_kelas }}" style="height: 200px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-3">
                            @if ($item->type_kelas == 0)
                            <br>
                            <span class="badge bg-success">Gratis</span>
                            @elseif($item->type_kelas == 1)
                            <br>
                            <span class="badge bg-primary">Regular</span>
                            @elseif($item->type_kelas == 2)
                            <br>
                            <span class="badge bg-warning">Premium</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold rk-heading">{{ $item->name_kelas }}</h5>
                        <p class="card-text text-muted rk-line-clamp-3">{!! strip_tags($item->description_kelas) !!}</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-primary fw-bold">Rp {{ number_format($item->harga_kelas, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('kelas.detail', Crypt::encrypt($item->id)) }}" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="{{ route('kelas') }}" class="btn btn-outline-primary">Lihat Semua Kelas <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<style>
    /* Custom styles untuk halaman welcome */
    .rk-hero-section {
        padding: 120px 0 80px;
        background: linear-gradient(135deg, rgba(255,255,255,1) 0%, rgba(245,247,255,1) 100%);
        position: relative;
        overflow: hidden;
        margin-top: -1px;
    }
    
    .rk-hero-section::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.1) 0%, rgba(58, 12, 163, 0.05) 100%);
        z-index: 0;
    }
    
    .rk-hero-content {
        position: relative;
        z-index: 2;
    }
    
    .rk-text-accent {
        color: var(--rk-accent);
    }
    
    .rk-text-primary {
        color: var(--rk-primary);
    }
    
    .rk-section {
        position: relative;
        z-index: 1;
    }
    
    .rk-shadow-hover {
        transition: all 0.3s ease;
    }
    
    .rk-shadow-hover:hover {
        transform: translateY(-5px);
        box-shadow: var(--rk-shadow) !important;
    }
    
    .rk-line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 72px;
    }
    
    .rk-icon-wrapper {
        width: 80px;
        height: 80px;
    }
    
    .course-card {
        border-radius: var(--rk-radius);
        overflow: hidden;
    }
    
    /* Responsive adjustments */
    @media (max-width: 991.98px) {
        .rk-hero-section {
            padding: 100px 0 60px;
            text-align: center;
        }
        
        .rk-hero-content .d-flex {
            justify-content: center;
        }
        
        .rk-hero-image {
            margin-top: 3rem;
        }
    }
    
    @media (max-width: 767.98px) {
        .rk-hero-section {
            padding: 80px 0 40px;
        }
        
        .display-4 {
            font-size: 2.5rem;
        }
        
        .rk-hero-content .d-flex.flex-wrap {
            flex-direction: column;
            gap: 1rem !important;
        }
        
        .rk-hero-content .d-flex.flex-wrap .rk-btn-primary,
        .rk-hero-content .d-flex.flex-wrap .btn {
            width: 100%;
            justify-content: center;
        }
    }
    
    /* Memastikan konten tidak tertutup oleh fixed navbar */
    .rk-hero-section {
        padding-top: calc(80px + 2rem);
    }
</style>

@endsection