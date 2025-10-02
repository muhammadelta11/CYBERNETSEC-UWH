@extends('layouts.front')

@section('content')

<!-- Hero Section -->
<section class="rk-sertifikat-hero">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-lg-8 mx-auto text-center">
                <div data-aos="fade-up">
                    <div class="rk-hero-icon mb-4">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h1 class="display-5 fw-bold mb-3 rk-heading">E-Sertifikat</h1>
                    <p class="lead rk-hero-description mb-4">Koleksi sertifikat penyelesaian kursus Anda</p>
                    <div class="rk-hero-stats">
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <div class="rk-stat-item">
                                    <span class="rk-stat-number">{{ $sertifikats->total() }}</span>
                                    <small class="rk-stat-label">Sertifikat</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Certificates Section -->
<section class="rk-sertifikat-section py-5">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($sertifikats->count() > 0)
            <!-- Filter and Sort Section -->
            <div class="rk-filter-section mb-5" data-aos="fade-up">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="rk-section-title mb-0">Sertifikat Saya</h3>
                        <p class="text-muted mb-0">Total {{ $sertifikats->total() }} sertifikat</p>
                    </div>
            <div class="col-md-6 text-md-end">
                <!-- Removed view toggle buttons as per user request -->
            </div>
                </div>
            </div>

            <!-- Certificates Grid -->
            <div class="row" id="certificatesGrid">
                @foreach($sertifikats as $s)
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="rk-sertifikat-card rk-card h-100">
                    <div class="rk-sertifikat-header">
                        <div class="rk-certificate-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div class="rk-certificate-badge">
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i>Selesai
                            </span>
                        </div>
                    </div>
                    
                    <div class="rk-sertifikat-body">
                        <h5 class="rk-certificate-title">{{ $s->nama_sertifikat }}</h5>
                        
                        <div class="rk-certificate-info">
                            <div class="rk-info-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Diterbitkan: {{ \Carbon\Carbon::parse($s->tanggal_diterbitkan)->format('d M Y') }}</span>
                            </div>
                            <div class="rk-info-item">
                                <i class="fas fa-user-graduate"></i>
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                            <div class="rk-info-item">
                                <i class="fas fa-file-pdf"></i>
                                <span>Format PDF</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="rk-sertifikat-footer">
                        <a href="{{ URL::signedRoute('front.sertifikat.download', ['id' => Crypt::encrypt($s->id)]) }}"
                           class="btn btn-primary w-100">
                            <i class="fas fa-download me-2"></i>Download Sertifikat
                        </a>
                    </div>
                </div>
            </div>
                @endforeach
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
        @else
            <!-- Empty State -->
            <div class="rk-empty-state text-center py-5" data-aos="fade-up">
                <div class="rk-empty-icon mb-4">
                    <i class="fas fa-certificate"></i>
                </div>
                <h3 class="rk-empty-title">Belum ada sertifikat</h3>
                <p class="rk-empty-description">Selesaikan kursus untuk mendapatkan sertifikat digital</p>
                <a href="{{ route('kelas.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-graduation-cap me-2"></i>Jelajahi Kursus
                </a>
            </div>
        @endif
    </div>
</section>

<style>
    /* Hero Section */
    .rk-sertifikat-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        position: relative;
        overflow: hidden;
    }

    .rk-sertifikat-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .rk-hero-icon {
        font-size: 4rem;
        opacity: 0.9;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
    }

    .rk-hero-stats {
        margin-top: 2rem;
    }

    .rk-stat-item {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 1.5rem 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .rk-stat-number {
        display: block;
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1;
    }

    .rk-stat-label {
        font-size: 0.9rem;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .rk-hero-description {
        color: #fbbf24;
        font-weight: 500;
    }

    /* Section Styling */
    .rk-sertifikat-section {
        background: #f8f9fa;
        min-height: 60vh;
    }

    .rk-section-title {
        color: #2d3748;
        font-weight: 700;
        font-size: 1.5rem;
    }

    .rk-filter-section {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    /* Certificate Card */
    .rk-sertifikat-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
    }

    .rk-sertifikat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .rk-sertifikat-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem 1.5rem 1rem;
        position: relative;
        text-align: center;
    }

    .rk-certificate-icon {
        font-size: 3rem;
        color: white;
        margin-bottom: 1rem;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
    }

    .rk-certificate-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
    }

    .rk-sertifikat-body {
        padding: 1.5rem;
    }

    .rk-certificate-title {
        color: #2d3748;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 1rem;
        line-height: 1.4;
    }

    .rk-certificate-info {
        margin-bottom: 1rem;
    }

    .rk-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
        color: #4a5568;
        font-size: 0.9rem;
    }

    .rk-info-item i {
        color: #667eea;
        margin-right: 0.75rem;
        width: 16px;
        text-align: center;
    }

    .rk-sertifikat-footer {
        padding: 0 1.5rem 1.5rem;
    }

    .rk-sertifikat-footer .btn {
        border-radius: 12px;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
    }

    .rk-sertifikat-footer .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    /* Empty State */
    .rk-empty-state {
        background: white;
        border-radius: 20px;
        padding: 4rem 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
    }

    .rk-empty-icon {
        font-size: 4rem;
        color: #cbd5e0;
        margin-bottom: 1.5rem;
    }

    .rk-empty-title {
        color: #2d3748;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .rk-empty-description {
        color: #4a5568;
        margin-bottom: 2rem;
    }

    /* View Options */
    .rk-view-options .btn-group .btn {
        border-radius: 8px;
        margin: 0 2px;
    }

    .rk-view-options .btn-group .btn.active {
        background: #667eea;
        border-color: #667eea;
        color: white;
    }

    /* Pagination */
    .pagination .page-link {
        border-radius: 8px;
        margin: 0 2px;
        border: 1px solid #e2e8f0;
        color: #4a5568;
    }

    .pagination .page-item.active .page-link {
        background: #667eea;
        border-color: #667eea;
    }

    .pagination .page-link:hover {
        background: #f7fafc;
        border-color: #667eea;
        color: #667eea;
    }

    /* Dark Mode Styles */
    [data-theme="dark"] .rk-sertifikat-hero {
        background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
    }

    [data-theme="dark"] .rk-sertifikat-section {
        background: #1a202c;
    }

    [data-theme="dark"] .rk-filter-section {
        background: #2d3748;
        border-color: #4a5568;
    }

    [data-theme="dark"] .rk-section-title {
        color: #f7fafc;
    }

    [data-theme="dark"] .rk-sertifikat-card {
        background: #2d3748;
        border-color: #4a5568;
    }

    [data-theme="dark"] .rk-certificate-title {
        color: #f7fafc;
    }

    [data-theme="dark"] .rk-info-item {
        color: #a0aec0;
    }

    [data-theme="dark"] .rk-info-item i {
        color: #667eea;
    }

    [data-theme="dark"] .rk-empty-state {
        background: #2d3748;
        border-color: #4a5568;
    }

    [data-theme="dark"] .rk-empty-title {
        color: #f7fafc;
    }

    [data-theme="dark"] .rk-empty-description {
        color: #a0aec0;
    }

    [data-theme="dark"] .rk-empty-icon {
        color: #4a5568;
    }

    [data-theme="dark"] .pagination .page-link {
        background: #2d3748;
        border-color: #4a5568;
        color: #a0aec0;
    }

    [data-theme="dark"] .pagination .page-link:hover {
        background: #4a5568;
        border-color: #667eea;
        color: #667eea;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .rk-hero-icon {
            font-size: 3rem;
        }

        .rk-stat-item {
            padding: 1rem 1.5rem;
        }

        .rk-stat-number {
            font-size: 2rem;
        }

        .rk-sertifikat-header {
            padding: 1.5rem 1rem 0.75rem;
        }

        .rk-certificate-icon {
            font-size: 2.5rem;
        }

        .rk-sertifikat-body {
            padding: 1rem;
        }

        .rk-sertifikat-footer {
            padding: 0 1rem 1rem;
        }

        .rk-filter-section {
            padding: 1rem;
        }

        .rk-view-options {
            margin-top: 1rem;
        }
    }

    @media (max-width: 576px) {
        .rk-hero-icon {
            font-size: 2.5rem;
        }

        .rk-stat-item {
            padding: 0.75rem 1rem;
        }

        .rk-stat-number {
            font-size: 1.75rem;
        }

        .rk-empty-state {
            padding: 2rem 1rem;
        }

        .rk-empty-icon {
            font-size: 3rem;
        }
    }
</style>

<script>
// Removed view toggle functionality script as per user request
</script>

@endsection
