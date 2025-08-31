@extends('layouts.front')
@section('content')

<!-- Hero Section -->
<section class="rk-page-hero bg-gradient">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="rk-hero-content">
                    <h1 class="display-4 fw-bold text-white mb-4 rk-heading">Tentang <span class="text-warning">Ceybernetsec ID</span></h1>
                    <p class="lead text-light mb-4">Platform belajar online terdepan yang menghubungkan mentor berkualitas dengan pelajar passionate di seluruh Indonesia</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}" class="text-light">Home</a></li>
                            <li class="breadcrumb-item active text-warning" aria-current="page">Tentang Kami</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="rk-hero-image text-center">
                    <img src="{{ asset('frontemplate') }}/img/gallery/wel.png" alt="About Us" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>



<!-- About Content Section -->
<section class="rk-section py-5 bg-light">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <img src="{{ asset('frontemplate') }}/img/learning_img.png" alt="About Us" class="img-fluid rounded-3 shadow">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="ps-lg-5">
                    <h6 class="text-primary mb-2">Visi & Misi</h6>
                    <h2 class="fw-bold mb-4 rk-heading">Belajar Online Dimanapun & Kapanpun</h2>
                    @php
                    $setting = \App\Setting::first()
                    @endphp
                    {!! $setting->about ?? '<p>Selamat datang di platform e-learning kami. Platform ini dirancang untuk membantu Anda belajar secara online dengan mudah dan fleksibel.</p>' !!}
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary p-2 rounded-circle me-3">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Materi Terupdate</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary p-2 rounded-circle me-3">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Akses Fleksibel</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary p-2 rounded-circle me-3">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Konsultasi Mentor</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary p-2 rounded-circle me-3">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Sertifikat Resmi</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="rk-section py-5">
    <div class="container py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h6 class="text-primary mb-2">Tim Kami</h6>
                <h2 class="fw-bold mb-3 rk-heading">Bertemu Dengan Tim Expert Kami</h2>
                <p class="text-muted">Dibimbing oleh profesional berpengalaman di bidangnya masing-masing</p>
            </div>
        </div>
        <div class="row">
            <!-- Team Member 1 -->
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-team-img-wrapper position-relative">
                        <img src="{{ asset('frontemplate') }}/img/masud.png" class="card-img-top" alt="Team Member">
                        <div class="rk-team-social-overlay">
                            <div class="rk-social-icons2">
                                <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold mb-1 rk-heading">Muhammad Mas'ud</h5>
                        <p class="text-primary mb-3">Founder & CEO</p>
                        <p class="card-text text-muted">Pengembang platform dengan pengalaman 10+ tahun di industri edukasi teknologi</p>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 2 -->
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-team-img-wrapper position-relative">
                        <img src="{{ asset('frontemplate') }}/img/haromain.png" class="card-img-top" alt="Team Member">
                        <div class="rk-team-social-overlay">
                            <div class="rk-social-icons2">
                                <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold mb-1 rk-heading">Muhammad Nur Haromaen</h5>
                        <p class="text-primary mb-3">Head of Education</p>
                        <p class="card-text text-muted">Spesialis kurikulum dengan latar belakang pendidikan dan teknologi pembelajaran</p>
                    </div>
                </div>
            </div>
            
            <!-- Team Member 3 -->
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-team-img-wrapper position-relative">
                        <img src="{{ asset('frontemplate') }}/img/arief.png" class="card-img-top" alt="Team Member">
                        <div class="rk-team-social-overlay">
                            <div class="rk-social-icons2">
                                <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold mb-1 rk-heading">Muhammad Arief Maulana</h5>
                        <p class="text-primary mb-3">Tech Lead</p>
                        <p class="card-text text-muted">Ahli pengembangan platform dengan fokus pada user experience dan skalabilitas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-team-img-wrapper position-relative">
                        <img src="{{ asset('frontemplate') }}/img/nanda.jpg" class="card-img-top" alt="Team Member">
                        <div class="rk-team-social-overlay">
                            <div class="rk-social-icons2">
                                <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold mb-1 rk-heading">Nanda Bagus Ramadhani</h5>
                        <p class="text-primary mb-3">Tech Lead</p>
                        <p class="card-text text-muted">Ahli pengembangan platform dengan fokus pada user experience dan skalabilitas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-team-img-wrapper position-relative">
                        <img src="{{ asset('frontemplate') }}/img/vian.jpg" class="card-img-top" alt="Team Member">
                        <div class="rk-team-social-overlay">
                            <div class="rk-social-icons2">
                                <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold mb-1 rk-heading">Arvian Raditya Pratama</h5>
                        <p class="text-primary mb-3">Tech Lead</p>
                        <p class="card-text text-muted">Ahli pengembangan platform dengan fokus pada user experience dan skalabilitas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-team-img-wrapper position-relative">
                        <img src="{{ asset('frontemplate') }}/img/mala.png" class="card-img-top" alt="Team Member">
                        <div class="rk-team-social-overlay">
                            <div class="rk-social-icons2">
                                <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold mb-1 rk-heading">Mala Fillatunnida</h5>
                        <p class="text-primary mb-3">Tech Lead</p>
                        <p class="card-text text-muted">Ahli pengembangan platform dengan fokus pada user experience dan skalabilitas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-team-img-wrapper position-relative">
                        <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Team Member">
                        <div class="rk-team-social-overlay">
                            <div class="rk-social-icons2">
                                <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold mb-1 rk-heading">Nadia Rizky Chairunnisa</h5>
                        <p class="text-primary mb-3">Tech Lead</p>
                        <p class="card-text text-muted">Ahli pengembangan platform dengan fokus pada user experience dan skalabilitas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-team-img-wrapper position-relative">
                        <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Team Member">
                        <div class="rk-team-social-overlay">
                            <div class="rk-social-icons2">
                                <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold mb-1 rk-heading">Dwi Putri</h5>
                        <p class="text-primary mb-3">Tech Lead</p>
                        <p class="card-text text-muted">Ahli pengembangan platform dengan fokus pada user experience dan skalabilitas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="rk-card rk-team-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-team-img-wrapper position-relative">
                        <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Team Member">
                        <div class="rk-team-social-overlay">
                            <div class="rk-social-icons2">
                                <a href="#" class="rk-social-icon"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="rk-social-icon"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold mb-1 rk-heading">Rizky Subekti</h5>
                        <p class="text-primary mb-3">Tech Lead</p>
                        <p class="card-text text-muted">Ahli pengembangan platform dengan fokus pada user experience dan skalabilitas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Feature Section -->
<section class="rk-section py-5">
    <div class="container py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h2 class="fw-bold mb-3 rk-heading">Jenis Up Skill yang Kami Tawarkan</h2>
                <p class="text-muted">Pilih metode belajar yang paling sesuai dengan kebutuhan dan preferensi Anda</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="rk-card rk-feature-card h-100 border-0 rk-shadow-hover">
                    <div class="card-body p-4 text-center">
                        <div class="rk-icon-wrapper bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                            <i class="fas fa-layer-group fs-3 text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3 rk-heading">Up Skill Gratis</h4>
                        <p class="text-muted">Akses materi pembelajaran dasar tanpa biaya untuk semua pengunjung website</p>
                        <div class="mt-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary py-2 px-3">Tanpa Registrasi</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="rk-card rk-feature-card h-100 border-0 rk-shadow-hover">
                    <div class="card-body p-4 text-center">
                        <div class="rk-icon-wrapper bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                            <i class="fas fa-user-plus fs-3 text-success"></i>
                        </div>
                        <h4 class="fw-bold mb-3 rk-heading">Up Skill Regular</h4>
                        <p class="text-muted">Up Skill eksklusif untuk anggota terdaftar dengan materi lebih lengkap dan terstruktur</p>
                        <div class="mt-4">
                            <span class="badge bg-success bg-opacity-10 text-success py-2 px-3">Free Membership</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="rk-card rk-feature-card h-100 border-0 rk-shadow-hover">
                    <div class="card-body p-4 text-center">
                        <div class="rk-icon-wrapper bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                            <i class="fas fa-crown fs-3 text-warning"></i>
                        </div>
                        <h4 class="fw-bold mb-3 rk-heading">Up Skill Premium</h4>
                        <p class="text-muted">Pengalaman belajar premium dengan mentor dedicated, sertifikat, dan konsultasi privat</p>
                        <div class="mt-4">
                            <span class="badge bg-warning bg-opacity-10 text-warning py-2 px-3">Fitur Eksklusif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="rk-stats py-5 bg-primary">
    <div class="container py-5">
        <div class="row text-center">
            <div class="col-md-3 col-6 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                <div class="rk-stat-item">
                    <h2 class="display-4 fw-bold text-white mb-2" data-count="500">0</h2>
                    <p class="text-light mb-0">Up Skill Online</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="200">
                <div class="rk-stat-item">
                    <h2 class="display-4 fw-bold text-white mb-2" data-count="25000">0</h2>
                    <p class="text-light mb-0">Siswa Aktif</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                <div class="rk-stat-item">
                    <h2 class="display-4 fw-bold text-white mb-2" data-count="98">0</h2>
                    <p class="text-light mb-0">Kepuasan Siswa</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="400">
                <div class="rk-stat-item">
                    <h2 class="display-4 fw-bold text-white mb-2" data-count="50">0</h2>
                    <p class="text-light mb-0">Mentor Expert</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Page Hero Section */
    .rk-page-hero {
        padding: 120px 0;
        background: var(--rk-gradient);
        position: relative;
        overflow: hidden;
        margin-top: -1px;
    }
    
    .rk-page-hero::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        z-index: 1;
    }
    
    .rk-page-hero::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        z-index: 1;
    }
    
    .rk-hero-content {
        position: relative;
        z-index: 2;
    }
    
    .rk-page-hero .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 0;
    }
    
    .rk-page-hero .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
    }
    
    .rk-page-hero .breadcrumb-item.active {
        color: var(--warning);
    }
    
    .rk-page-hero .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.8);
    }
    /* Perbaikan untuk Team Card */
.rk-team-card .card-body {
    min-height: 150px; /* Menjaga tinggi card body agar konsisten */
}
.rk-team-card img {
    height: 300px; /* Mengatur tinggi gambar agar seragam */
    object-fit: cover; /* Memastikan gambar mengisi area tanpa distorsi */
    object-position: top; /* Mengatur fokus gambar di bagian atas */
}

/* Overlay untuk efek hover */
.rk-team-social-overlay {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.6); /* Warna overlay lebih solid */
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.rk-team-card:hover .rk-team-social-overlay {
    opacity: 1;
}

.rk-social-icons2 {
    display: flex;
    gap: 15px;
}

.rk-social-icon2 {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    background: var(--rk-primary);
    color: white;
    border-radius: 50%;
    text-decoration: none;
    transition: all 0.3s ease;
}

.rk-social-icon2:hover {
    background: white;
    color: var(--rk-primary);
    transform: translateY(-3px);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .rk-team-card img {
        height: 250px; /* Mengurangi tinggi gambar di layar mobile */
    }
}
    
    /* Feature Cards */
    .rk-feature-card {
        border-radius: var(--rk-radius);
        transition: all 0.3s ease;
    }
    
    .rk-feature-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--rk-shadow) !important;
    }
    
    .rk-icon-wrapper {
        width: 80px;
        height: 80px;
    }
    
    /* Team Section */
    .rk-team-card {
        border-radius: var(--rk-radius);
        transition: all 0.3s ease;
    }
    
    .rk-team-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--rk-shadow) !important;
    }
    
    .rk-team-img-wrapper {
        overflow: hidden;
        border-top-left-radius: var(--rk-radius);
        border-top-right-radius: var(--rk-radius);
    }
    
    .rk-team-img-wrapper img {
        transition: transform 0.5s ease;
        height: 250px;
        object-fit: cover;
    }
    
    .rk-team-card:hover .rk-team-img-wrapper img {
        transform: scale(1.05);
    }
    
    .rk-team-social-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        padding: 20px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .rk-team-card:hover .rk-team-social-overlay {
        opacity: 1;
    }
    
    /* Stats Section */
    .rk-stat-item h2 {
        font-size: 3rem;
    }
    
    /* Responsive Design */
    @media (max-width: 991.98px) {
        .rk-page-hero {
            padding: 100px 0;
        }
        
        .rk-hero-image {
            margin-top: 3rem;
        }
    }
    
    @media (max-width: 768px) {
        .rk-page-hero {
            padding: 80px 0;
            text-align: center;
        }
        
        .rk-stat-item h2 {
            font-size: 2.5rem;
        }
        
        .display-4 {
            font-size: 2.5rem;
        }
        
        .rk-team-card {
            margin-bottom: 2rem;
        }
    }
    
    @media (max-width: 576px) {
        .rk-page-hero {
            padding: 70px 0;
        }
        
        .rk-section {
            padding: 2rem 0;
        }
        
        .rk-stat-item h2 {
            font-size: 2rem;
        }
    }
    
    /* Memastikan konten tidak tertutup oleh fixed navbar */
    .rk-page-hero {
        padding-top: calc(80px + 2rem);
    }
</style>

<script>
    // Counter animation for stats
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('[data-count]');
        const speed = 200;
        
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-count');
            const count = +counter.innerText;
            const increment = target / speed;
            
            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(updateCount, 1);
            } else {
                counter.innerText = target;
            }
            
            function updateCount() {
                const current = +counter.innerText;
                if (current < target) {
                    counter.innerText = Math.ceil(current + increment);
                    setTimeout(updateCount, 1);
                } else {
                    counter.innerText = target;
                }
            }
        });
    });
</script>

@endsection