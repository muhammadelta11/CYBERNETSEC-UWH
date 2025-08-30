@extends('layouts.front')
@section('content')

<!-- Hero Section -->
<section class="rk-podcast-hero bg-light">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-lg-8 mx-auto text-center">
                <div data-aos="fade-up">
                    <h1 class="display-5 fw-bold mb-3 rk-heading">Video & Podcast</h1>
                    <p class="lead text-muted">Temukan konten video pembelajaran dan podcast inspiratif untuk meningkatkan skill dan pengetahuan Anda</p>
                    
                    <!-- Search Form -->
                    <div class="rk-podcast-search mt-4" data-aos="fade-up" data-aos-delay="100">
                        <form action="#" method="GET" class="d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-lg" placeholder="Cari video..." aria-label="Search videos">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Category Filters -->
                    <div class="rk-podcast-categories mt-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="#" class="btn btn-sm btn-outline-primary active">Semua</a>
                            <a href="#" class="btn btn-sm btn-outline-primary">Tutorial</a>
                            <a href="#" class="btn btn-sm btn-outline-primary">Webinar</a>
                            <a href="#" class="btn btn-sm btn-outline-primary">Interview</a>
                            <a href="#" class="btn btn-sm btn-outline-primary">Tips & Trik</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Podcast/Video Section -->
<section class="rk-podcast-section py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h2 class="fw-bold mb-3 rk-heading">Koleksi Video Kami</h2>
                <p class="text-muted">Jelajahi berbagai video pembelajaran yang dirancang khusus untuk membantu perkembangan karir Anda</p>
            </div>
        </div>
        
        <div class="row">
            @forelse ($podcasts as $item)
            <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="rk-podcast-card rk-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-podcast-thumb position-relative">
                        <img src="http://img.youtube.com/vi/{{ $item->url_podcast }}/maxresdefault.jpg" 
                             onerror="this.src='http://img.youtube.com/vi/{{ $item->url_podcast }}/0.jpg'" 
                             class="card-img-top" alt="{{ $item->name_podcast }}"
                             style="height: 200px; object-fit: cover;">
                        <div class="rk-play-overlay position-absolute top-50 start-50 translate-middle">
                            <div class="rk-play-button bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                        <div class="rk-video-badge position-absolute top-0 end-0 m-3">
                            <span class="badge bg-dark">Video</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold rk-heading">
                            <a href="{{ route('podcast.detail', Crypt::encrypt($item->id)) }}" class="text-dark text-decoration-none">
                                {{ $item->name_podcast }}
                            </a>
                        </h5>
                        <p class="card-text text-muted rk-line-clamp-3">
                            {!! strip_tags($item->description_podcast) !!}
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="rk-video-duration">
                                <small class="text-muted"><i class="far fa-clock me-1"></i> 15:30</small>
                            </div>
                            <a href="{{ route('podcast.detail', Crypt::encrypt($item->id)) }}" class="btn btn-sm btn-outline-primary">
                                Tonton <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5" data-aos="fade-up">
                <div class="rk-empty-state">
                    <i class="fas fa-video fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada video</h4>
                    <p class="text-muted">Silakan kembali lagi nanti untuk melihat video terbaru</p>
                </div>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($podcasts->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <nav aria-label="Podcast pagination" data-aos="fade-up">
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($podcasts->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $podcasts->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($podcasts->getUrlRange(1, $podcasts->lastPage()) as $page => $url)
                            @if ($page == $podcasts->currentPage())
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
                        @if ($podcasts->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $podcasts->nextPageUrl() }}" rel="next">&raquo;</a>
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

<!-- CTA Section -->
<section class="rk-cta-section bg-primary py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center text-white" data-aos="fade-up">
                <h3 class="fw-bold mb-3">Ingin Video Pembelajaran Lainnya?</h3>
                <p class="mb-4">Bergabunglah dengan premium membership untuk mengakses semua video pembelajaran eksklusif</p>
                <a href="{{ route('register') }}" class="rk-btn-primary btn-lg">
                    Daftar Sekarang <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    /* Podcast Hero Section */
    .rk-podcast-hero {
        padding: 120px 0 60px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        margin-top: -1px;
    }
    
    .rk-podcast-search .input-group {
        max-width: 500px;
        margin: 0 auto;
    }
    
    .rk-podcast-search .form-control {
        border-right: 0;
        border-radius: 50px 0 0 50px;
        padding-left: 25px;
    }
    
    .rk-podcast-search .btn {
        border-radius: 0 50px 50px 0;
        padding: 0.75rem 1.5rem;
    }
    
    .rk-podcast-categories .btn {
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    
    .rk-podcast-categories .btn.active,
    .rk-podcast-categories .btn:hover {
        background: var(--rk-primary);
        color: white;
        border-color: var(--rk-primary);
    }
    
    /* Podcast Cards */
    .rk-podcast-card {
        border-radius: var(--rk-radius);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .rk-podcast-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--rk-shadow) !important;
    }
    
    .rk-podcast-thumb {
        overflow: hidden;
        position: relative;
    }
    
    .rk-podcast-thumb img {
        transition: transform 0.5s ease;
    }
    
    .rk-podcast-card:hover .rk-podcast-thumb img {
        transform: scale(1.05);
    }
    
    .rk-play-overlay {
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 2;
    }
    
    .rk-play-button {
        width: 60px;
        height: 60px;
        font-size: 1.2rem;
    }
    
    .rk-podcast-card:hover .rk-play-overlay {
        opacity: 1;
    }
    
    .rk-line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 72px;
    }
    
    /* CTA Section */
    .rk-cta-section {
        background: var(--rk-gradient) !important;
    }
    
    /* Pagination */
    .rk-podcast-section .pagination {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }
    
    .rk-podcast-section .page-item {
        margin: 0 0.25rem;
    }
    
    .rk-podcast-section .page-link {
        border-radius: 8px;
        border: 1px solid #dee2e6;
        color: var(--rk-dark);
        padding: 0.5rem 0.75rem;
        transition: all 0.3s ease;
    }
    
    .rk-podcast-section .page-item.active .page-link {
        background: var(--rk-primary);
        border-color: var(--rk-primary);
        color: white;
    }
    
    .rk-podcast-section .page-link:hover {
        background: rgba(67, 97, 238, 0.1);
        color: var(--rk-primary);
        border-color: #dee2e6;
    }
    
    .rk-podcast-section .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
    }
    
    /* Empty State */
    .rk-empty-state {
        padding: 3rem 1rem;
    }
    
    /* Responsive Design */
    @media (max-width: 991.98px) {
        .rk-podcast-hero {
            padding: 100px 0 40px;
        }
    }
    
    @media (max-width: 768px) {
        .rk-podcast-hero {
            padding: 80px 0 40px;
        }
        
        .rk-podcast-search .input-group {
            flex-direction: column;
        }
        
        .rk-podcast-search .form-control {
            border-radius: 50px;
            margin-bottom: 10px;
            border-right: 1px solid #ced4da !important;
        }
        
        .rk-podcast-search .btn {
            border-radius: 50px;
            width: 100%;
        }
        
        .rk-podcast-categories {
            overflow-x: auto;
            padding-bottom: 10px;
        }
        
        .rk-podcast-categories .d-flex {
            flex-wrap: nowrap;
            justify-content: flex-start !important;
        }
        
        .rk-podcast-section .pagination {
            flex-wrap: wrap;
        }
        
        .rk-podcast-section .page-item {
            margin: 0.125rem;
        }
        
        .display-5 {
            font-size: 2.2rem;
        }
    }
    
    @media (max-width: 576px) {
        .rk-podcast-thumb {
            height: 180px;
        }
        
        .rk-podcast-hero {
            padding: 70px 0 30px;
        }
        
        .rk-podcast-section {
            padding: 2rem 0;
        }
        
        .rk-play-button {
            width: 50px;
            height: 50px;
            font-size: 1rem;
        }
    }
    
    /* Memastikan konten tidak tertutup oleh fixed navbar */
    .rk-podcast-hero {
        padding-top: calc(80px + 2rem);
    }
</style>

@endsection