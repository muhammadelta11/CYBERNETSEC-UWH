@extends('layouts.front')

@section('content')

<!-- Hero Section -->
<section class="rk-kelas-hero bg-light">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-lg-8 mx-auto text-center">
                <div data-aos="fade-up">
                    <h1 class="display-5 fw-bold mb-3 rk-heading">E-Sertifikat</h1>
                    <p class="lead text-muted">Koleksi sertifikat penyelesaian kursus Anda</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Certificates Section -->
<section class="rk-kelas-section py-5">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            @forelse($sertifikats as $s)
            <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="rk-sertifikat-card rk-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-sertifikat-thumb position-relative">
                        <div class="rk-sertifikat-placeholder d-flex align-items-center justify-content-center text-white position-relative overflow-hidden"
                             style="height: 220px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px 15px 0 0;">
                            <!-- Certificate Border Effect -->
                            <div class="position-absolute top-0 start-0 w-100 h-100 border border-white opacity-25" style="border-radius: 15px 15px 0 0;"></div>
                            <div class="position-absolute top-50 start-50 translate-middle">
                                <div class="text-center">
                                    <i class="fas fa-certificate fa-4x mb-3 opacity-90"></i>
                                    <h4 class="mb-1 fw-bold">Certificate</h4>
                                    
                                </div>
                            </div>
                            <!-- Decorative Elements -->
                            <div class="position-absolute top-0 end-0 p-2 opacity-30">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="position-absolute bottom-0 start-0 p-2 opacity-30">
                                <i class="fas fa-award"></i>
                            </div>
                        </div>
                        <div class="rk-sertifikat-badge position-absolute top-50 start-100 translate-middle-y ms-3" style="z-index: 10;">
                            <span class="badge bg-success rounded-pill px-3 py-2 d-flex align-items-center">
                                <i class="fas fa-check-circle me-1"></i>Completed
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold rk-heading mb-3" style="font-size: 1.1rem;">
                            {{ $s->nama_sertifikat }}
                        </h5>
                        <div class="rk-sertifikat-info mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>
                                <small class="text-muted fw-medium">Issued: {{ \Carbon\Carbon::parse($s->tanggal_diterbitkan)->format('d M Y') }}</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-graduate text-primary me-2"></i>
                                <small class="text-muted fw-medium">{{ Auth::user()->name }}</small>
                            </div>
                        </div>
                        <div class="rk-sertifikat-type mb-3">
                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1">
                                <i class="fas fa-award me-1"></i>Digital Certificate
                            </span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 p-4 pt-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="rk-sertifikat-format">
                                <small class="text-muted d-flex align-items-center">
                                    <i class="fas fa-file-pdf me-1 text-danger"></i>
                                    <span class="fw-medium">PDF Format</span>
                                </small>
                            </div>
                            <a href="{{ URL::signedRoute('front.sertifikat.download', ['id' => Crypt::encrypt($s->id)]) }}"
                               class="btn btn-primary btn-sm rounded-pill px-3">
                                <i class="fas fa-download me-2"></i>Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5" data-aos="fade-up">
                <div class="rk-empty-state">
                    <i class="fas fa-certificate fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada sertifikat</h4>
                    <p class="text-muted">Selesaikan kursus untuk mendapatkan sertifikat</p>
                    <a href="{{ route('kelas.index') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-graduation-cap me-2"></i>Jelajahi Kursus
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($sertifikats->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <nav aria-label="Sertifikat pagination" data-aos="fade-up">
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($sertifikats->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $sertifikats->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($sertifikats->getUrlRange(1, $sertifikats->lastPage()) as $page => $url)
                            @if ($page == $sertifikats->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($sertifikats->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $sertifikats->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
        @endif
    </div>
</section>

<style>
    /* Sertifikat Card Styles */
    .rk-sertifikat-card {
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .rk-sertifikat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .rk-sertifikat-placeholder {
        position: relative;
    }

    .rk-sertifikat-placeholder::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        border-radius: 15px 15px 0 0;
    }

    .rk-sertifikat-info {
        background: #f8f9fa;
        padding: 12px;
        border-radius: 8px;
        margin: 0 -4px;
    }

    .rk-sertifikat-type {
        text-align: center;
    }

    .rk-sertifikat-format small {
        font-size: 0.85rem;
    }

    /* Dark Mode Styles */
    [data-theme="dark"] .rk-kelas-hero {
        background-color: #1a1e22 !important;
    }

    [data-theme="dark"] .rk-kelas-hero .text-muted {
        color: #a0aec0 !important;
    }

    [data-theme="dark"] .rk-sertifikat-card {
        background-color: #2c3136 !important;
        color: #e2e8f0 !important;
    }

    [data-theme="dark"] .rk-sertifikat-info {
        background: rgba(255, 255, 255, 0.05);
    }

    [data-theme="dark"] .rk-sertifikat-card .text-muted {
        color: #a0aec0 !important;
    }

    [data-theme="dark"] .rk-sertifikat-card .text-primary {
        color: var(--rk-primary) !important;
    }

    [data-theme="dark"] .rk-sertifikat-card .badge {
        background-color: rgba(67, 97, 238, 0.2) !important;
        color: var(--rk-primary) !important;
    }

    [data-theme="dark"] .rk-sertifikat-card .btn-primary {
        background-color: var(--rk-primary) !important;
        border-color: var(--rk-primary) !important;
    }

    [data-theme="dark"] .rk-sertifikat-card .btn-primary:hover {
        background-color: #4a5fe7 !important;
        border-color: #4a5fe7 !important;
    }

    [data-theme="dark"] .rk-empty-state .text-muted {
        color: #a0aec0 !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .rk-sertifikat-placeholder {
            height: 180px !important;
        }

        .rk-sertifikat-card .card-body {
            padding: 1rem !important;
        }

        .rk-sertifikat-info {
            padding: 8px !important;
            margin: 0 !important;
        }

        .rk-sertifikat-card .card-footer {
            padding: 1rem !important;
        }

        .rk-sertifikat-card .btn {
            width: 100%;
            margin-top: 10px;
        }

        .rk-sertifikat-format {
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        .rk-sertifikat-placeholder {
            height: 160px !important;
        }

        .rk-sertifikat-card .card-title {
            font-size: 1rem !important;
        }

        .rk-sertifikat-info small {
            font-size: 0.8rem;
        }
    }
</style>

@endsection
