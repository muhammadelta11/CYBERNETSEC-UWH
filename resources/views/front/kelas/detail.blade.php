@extends('layouts.front')
@section('content')

<section class="rk-kelas-detail-hero">
    <div class="container pt-4 pb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kelas') }}" class="text-decoration-none">Kelas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Kelas</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Course Details Section -->
<section class="rk-kelas-detail-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="rk-kelas-detail-content">
                    <!-- Course Header -->
                    <header class="rk-kelas-header mb-5" data-aos="fade-up">
                        <h1 class="display-5 fw-bold mb-3 rk-heading">{{ $kelas->name_kelas }}</h1>

                        <div class="rk-kelas-meta d-flex flex-column align-items-start gap-2 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-graduation-cap text-primary me-2"></i>
                                <span class="text-muted">{{ $kelas->materi->count() }} Materi</span>
                            </div>

                            <div class="d-flex align-items-center">
                                <i class="fas fa-users text-primary me-2"></i>
                                <span class="text-muted">250+ Siswa</span>
                            </div>

                            <div class="d-flex align-items-center">
                                <i class="fas fa-star text-warning me-2"></i>
                                <span class="text-muted">4.8 (120 reviews)</span>
                            </div>
                        </div>

                        <div class="rk-kelas-badges mb-3">
                            @if ($kelas->type_kelas == 0)
                            <span class="badge bg-success me-2">Gratis</span>
                            @elseif($kelas->type_kelas == 1)
                            <span class="badge bg-primary me-2">Regular</span>
                            @elseif($kelas->type_kelas == 2)
                            <span class="badge bg-warning me-2">Premium</span>
                            @elseif($kelas->type_kelas == 3)
                            <span class="badge bg-info me-2">Program Upskill</span>
                            @elseif($kelas->type_kelas == 4)
                            <span class="badge bg-info me-2">Brainlabs</span>
                            @endif
                            @if($kelas->is_course_conversion)
                            <span class="badge bg-success me-2">
                                <i class="fas fa-graduation-cap me-1"></i>Konversi MK
                            </span>
                            @endif
                            <span class="badge bg-info">Bestseller</span>
                        </div>
                    </header>

                    <!-- Course Description -->
                    <div class="rk-kelas-description mb-5" data-aos="fade-up" data-aos-delay="200">
                        <h4 class="fw-bold mb-4 rk-heading">Deskripsi Kelas</h4>
                        <div class="rk-content">
                            {!! $kelas->description_kelas !!}
                        </div>
                    </div>

                    <!-- Course Curriculum -->
                    <div class="rk-kelas-curriculum" data-aos="fade-up" data-aos-delay="300">
                        <h4 class="fw-bold mb-4 rk-heading">Daftar Materi</h4>
                        <div class="rk-curriculum-list">
                            @if ($kelas->materi->count() < 1)
                            <div class="rk-empty-curriculum text-center py-4">
                                <i class="fas fa-book-open fa-2x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada materi untuk kelas ini</p>
                            </div>
                            @else
                            <div class="accordion" id="curriculumAccordion">
                                @foreach ($kelas->materi as $index => $item)
                                <div class="rk-curriculum-item card border-0 mb-2">
                                    <div class="card-header border-0 bg-light" id="heading{{ $index }}">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link text-decoration-none w-100 text-start d-flex justify-content-between align-items-center" 
                                                    type="button" data-bs-toggle="collapse" 
                                                    data-bs-target="#collapse{{ $index }}" 
                                                    aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" 
                                                    aria-controls="collapse{{ $index }}">
                                                <span>
                                                    <i class="fas fa-play-circle text-primary me-2"></i>
                                                    {{ $item->title }}
                                                </span>
                                                <span class="badge bg-secondary">15:30</span>
                                            </button>
                                        </h5>
                                    </div>

                                        <div id="collapse{{ $index }}" 
                                             class="collapse {{ $index == 0 ? 'show' : '' }}" 
                                             aria-labelledby="heading{{ $index }}" 
                                             data-bs-parent="#curriculumAccordion">
                                            <div class="card-body">
                                                <p class="text-muted mb-3">Materi pembelajaran untuk topik ini.</p>
                                                @if($kelas->type_kelas == 0 || (Auth::check() && ($kelas->type_kelas == 1 || (Auth::user()->role == 'premium' && $kelas->type_kelas == 2))))
                                                <a href="{{ route('kelas.belajar', [
                                                    'id' => Crypt::encrypt($kelas->id),
                                                    'idmateri' => Crypt::encrypt($item->id)
                                                ]) }}" class="btn btn-sm btn-primary">
                                                    Lihat Materi <i class="fas fa-arrow-right ms-1"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <aside class="rk-kelas-sidebar" data-aos="fade-left" data-aos-delay="400">
                    <!-- Course Action Card -->
                    <div class="rk-sidebar-card rk-card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="rk-course-price text-center mb-4">
                                @if($kelas->type_kelas == 0)
                                <h3 class="text-success fw-bold">Gratis</h3>
                                @elseif($kelas->type_kelas == 1)
                                <h3 class="text-primary fw-bold">Regular</h3>
                                <p class="text-muted small">Hubungi Admin</p>
                                @elseif($kelas->type_kelas == 2)
                                <h3 class="text-warning fw-bold">Premium</h3>
                                <p class="text-muted small">Upgrade ke Premium</p>
                                @elseif($kelas->type_kelas == 3)
                                <h3 class="text-primary fw-bold">Rp {{ number_format($kelas->harga, 0, ',', '.') }}</h3>
                                <p class="text-muted small">Satu kali pembayaran</p>
                                @elseif($kelas->type_kelas == 4)
                                <h3 class="text-primary fw-bold">Rp {{ number_format($kelas->harga, 0, ',', '.') }}</h3>
                                <p class="text-muted small">Satu kali pembayaran</p>
                                @else
                                <h3 class="text-primary fw-bold">Berbayar</h3>
                                <p class="text-muted small">Hubungi Admin</p>
                                @endif
                            </div>

                            <div class="rk-course-features mb-4">
                                <h6 class="fw-bold mb-3">Benefit Kelas:</h6>
                                <ul class="list-unstyled">
                            @if($kelas->features)
                                @foreach(json_decode($kelas->features) as $feature)
                                <li class="d-flex align-items-center mb-2" style="gap: 8px;">
                                    <i class="fas fa-check text-success"></i>
                                    <span>{{ $feature }}</span>
                                </li>
                                @endforeach
                            @else
                            <!-- <li class="d-flex align-items-center mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                <span>Akses selamanya</span>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                <span>Sertifikat kelulusan</span>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                <span>Dukungan mentor</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="fas fa-check text-success me-2"></i>
                                <span>Download materi</span>
                            </li> -->
                            @endif
                                </ul>
                            </div>

                            @if ($kelas->materi->count() > 0)
                                @if ($kelas->type_kelas == 0)
                                <a href="{{ route('kelas.belajar',[
                                    'id' => Crypt::encrypt($kelas->id),
                                    'idmateri' => Crypt::encrypt($kelas->materi[0]->id)
                                ]) }}" class="rk-btn-primary w-100 text-center">
                                    <i class="fas fa-play-circle me-2"></i> Mulai Belajar
                                </a>
                                @else
                                @guest
                                <div class="alert alert-info mb-3">
                                    <small>Anda harus membuat akun untuk mengakses kelas ini</small>
                                </div>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">
                                    Daftar Sekarang
                                </a>
                                @else
                                @if($kelas->type_kelas == 1)
                                <a href="{{ route('kelas.belajar',[
                                    'id' => Crypt::encrypt($kelas->id),
                                    'idmateri' => Crypt::encrypt($kelas->materi[0]->id)
                                ]) }}" class="rk-btn-primary w-100 text-center">
                                    <i class="fas fa-play-circle me-2"></i> Lanjutkan Belajar
                                </a>
                                @else
                                @if($kelas->type_kelas == 3 || $kelas->type_kelas == 4)
                                @php
                                    $transaksi = \App\Transaksi::where('users_id', Auth::user()->id)
                                        ->where('kelas_id', $kelas->id)
                                        ->where('status', 1)
                                        ->first();
                                @endphp
                                @if($transaksi)
                                <a href="{{ route('kelas.belajar',[
                                    'id' => Crypt::encrypt($kelas->id),
                                    'idmateri' => Crypt::encrypt($kelas->materi[0]->id)
                                ]) }}" class="rk-btn-primary w-100 text-center">
                                    <i class="fas fa-play-circle me-2"></i> Akses Kelas
                                </a>
                                @else
                                <a href="{{ route('transaksi.kelas', $kelas->id) }}" class="btn btn-success w-100">
                                    <i class="fas fa-credit-card me-2"></i> Bayar Sekarang
                                </a>
                                @endif
                                @else
                                @if (Auth::user()->role == 'premium')
                                <a href="{{ route('kelas.belajar',[
                                    'id' => Crypt::encrypt($kelas->id),
                                    'idmateri' => Crypt::encrypt($kelas->materi[0]->id)
                                ]) }}" class="rk-btn-primary w-100 text-center">
                                    <i class="fas fa-play-circle me-2"></i> Akses Kelas
                                </a>
                                @else
                                <div class="alert alert-warning mb-3">
                                    <small>Upgrade akun Anda ke premium untuk mengakses kelas ini</small>
                                </div>
                                <a href="{{ route('upgradepremium') }}" class="btn btn-warning w-100">
                                    Upgrade Premium
                                </a>
                                @endif
                                @endif
                                @endif
                                @endguest
                                @endif
                            @else
                            <div class="alert alert-secondary">
                                <small>Belum ada materi pada kelas ini</small>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Course Info Card -->
                    <div class="rk-sidebar-card rk-card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Informasi Kelas</h6>
                            <ul class="list-unstyled">
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">Tipe Kelas</span>
                                    <span class="fw-medium">
                                        @if ($kelas->type_kelas == 0)
                                        Gratis
                                        @elseif($kelas->type_kelas == 1)
                                        Regular
                                        @elseif($kelas->type_kelas == 2)
                                        Premium
                                        @elseif($kelas->type_kelas == 3)
                                        Program Upskill
                                        @elseif($kelas->type_kelas == 4)
                                        Skillabs
                                        @endif
                                    </span>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">Jumlah Materi</span>
                                    <span class="fw-medium">{{ $kelas->materi->count() }} Materi</span>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">Durasi</span>
                                    <span class="fw-medium">5 jam</span>
                                </li>
                                <li class="d-flex justify-content-between py-2">
                                    <span class="text-muted">Level</span>
                                    <span class="fw-medium">Pemula - Menengah</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

<style>
    /* Kelas Detail Hero */
    .rk-kelas-detail-hero {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        margin-top: -1px;
    }
    
    .rk-kelas-detail-hero .breadcrumb {
        margin-bottom: 0;
        padding: 0.75rem 0;
    }
    
    .rk-kelas-detail-hero .breadcrumb-item a {
        color: var(--rk-dark);
        transition: color 0.3s ease;
    }
    
    .rk-kelas-detail-hero .breadcrumb-item a:hover {
        color: var(--rk-primary);
    }
    
    .rk-kelas-detail-hero .breadcrumb-item.active {
        color: var(--rk-primary);
    }
    
    /* Kelas Header */
    .rk-kelas-header {
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 1.5rem;
    }
    
    .rk-kelas-meta {
        color: #6c757d;
    }
    
    /* Kelas Thumbnail */
    .rk-kelas-thumbnail img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: var(--rk-radius);
    }
    
    /* Kelas Description */
    .rk-kelas-description .rk-content {
        line-height: 1.8;
        color: #4a5568;
    }
    
    .rk-kelas-description .rk-content h2,
    .rk-kelas-description .rk-content h3,
    .rk-kelas-description .rk-content h4 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: var(--rk-dark);
    }
    
    .rk-kelas-description .rk-content p {
        margin-bottom: 1.5rem;
    }
    
    .rk-kelas-description .rk-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5rem 0;
    }
    
    /* Curriculum */
    .rk-curriculum-item .card-header {
        padding: 1rem;
        border-radius: var(--rk-radius) !important;
    }
    
    .rk-curriculum-item .btn-link {
        color: var(--rk-dark);
        font-weight: 500;
        padding: 0;
    }
    
    .rk-curriculum-item .btn-link:hover {
        color: var(--rk-primary);
    }
    
    .rk-curriculum-item .card-body {
        padding: 1.5rem;
        background: #f8f9fa;
        border-radius: 0 0 var(--rk-radius) var(--rk-radius);
    }
    
    .rk-empty-curriculum {
        background: #f8f9fa;
        border-radius: var(--rk-radius);
    }
    
    /* Sidebar */
    .rk-sidebar-card {
        border-radius: var(--rk-radius);
    }
    
    .rk-course-price h3 {
        font-size: 2.5rem;
    }
    
    .rk-course-features li {
        padding: 0.3rem 0;
    }
    
    /* Responsive Design */
    @media (max-width: 991.98px) {
        .rk-kelas-detail-section {
            padding: 3rem 0;
        }
    }
    
    @media (max-width: 768px) {
        .rk-kelas-header h1 {
            font-size: 2rem;
        }
        
        .rk-kelas-meta {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem !important;
        }
        
        .rk-kelas-thumbnail img {
            height: 250px;
        }
        
        .rk-kelas-sidebar {
            margin-top: 3rem;
        }
    }
    
    @media (max-width: 576px) {
        .rk-kelas-detail-hero {
            padding: 1.5rem 0;
        }
        
        .rk-kelas-detail-section {
            padding: 2rem 0;
        }
        
        .display-5 {
            font-size: 2rem;
        }
        
        .rk-course-price h3 {
            font-size: 2rem;
        }
    }
    
    /* Memastikan konten tidak tertutup oleh fixed navbar */
    .rk-kelas-detail-hero {
        padding-top: calc(80px + 1rem);
    }
</style>

@endsection