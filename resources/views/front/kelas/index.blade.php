@extends('layouts.front')
@section('content')

<!-- Hero Section -->
<section class="rk-kelas-hero bg-light">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-lg-8 mx-auto text-center">
                <div data-aos="fade-up">
                    <h1 class="display-5 fw-bold mb-3 rk-heading">Up Skill</h1>
                    <p class="lead text-muted">Temukan Up Skill terbaik yang sesuai dengan minat dan kebutuhan belajar Anda</p>
                    
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

<!-- Kelas Section -->
<section class="rk-kelas-section py-5">
    <div class="container">
        <div class="row justify-content-between mb-5">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3 rk-heading">Katalog Labs</h2>
                <p class="text-muted">Temukan berbagai pilihan kelas untuk mengembangkan skill Anda</p>
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

        <div class="row">
            @forelse ($kelas as $item)
            <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="rk-kelas-card rk-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-kelas-thumb position-relative">
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" class="card-img-top" alt="{{ $item->name_kelas }}" 
                             style="height: 200px; object-fit: cover;">
                        <div class="rk-kelas-badge position-absolute top-0 end-0 m-3">
                            @if ($item->type_kelas == 0)
                            <span class="badge bg-success">Gratis</span>
                            @elseif($item->type_kelas == 1)
                            <span class="badge bg-primary">Regular</span>
                            @elseif($item->type_kelas == 2)
                            <span class="badge bg-warning">Premium</span>
                            @endif
                        </div>
                        <div class="rk-kelas-overlay position-absolute w-100 h-100"></div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold rk-heading">
                            <a href="{{ route('kelas.detail', Crypt::encrypt($item->id)) }}" class="text-dark text-decoration-none">
                                {{ $item->name_kelas }}
                            </a>
                        </h5>
                        <p class="card-text text-muted rk-line-clamp-3">
                            {!! strip_tags($item->description_kelas) !!}
                        </p>
                        
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
                            <div class="rk-kelas-price">
                                @if($item->type_kelas == 0)
                                <span class="text-success fw-bold">Gratis</span>
                                @else
                                <span class="text-primary fw-bold">Rp {{ number_format($item->harga_kelas, 0, ',', '.') }}</span>
                                @endif
                            </div>
                            <a href="{{ route('kelas.detail', Crypt::encrypt($item->id)) }}" class="btn btn-sm btn-outline-primary">
                                Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5" data-aos="fade-up">
                <div class="rk-empty-state">
                    <i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada kelas tersedia</h4>
                    <p class="text-muted">Silakan kembali lagi nanti untuk melihat kelas terbaru</p>
                </div>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($kelas->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <nav aria-label="Kelas pagination" data-aos="fade-up">
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($kelas->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $kelas->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($kelas->getUrlRange(1, $kelas->lastPage()) as $page => $url)
                            @if ($page == $kelas->currentPage())
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
                        @if ($kelas->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $kelas->nextPageUrl() }}" rel="next">&raquo;</a>
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
                <h3 class="fw-bold mb-3">Siap Memulai Perjalanan Belajar Anda?</h3>
                <p class="mb-4">Bergabunglah dengan komunitas pembelajar kami dan raih skill baru untuk masa depan yang lebih baik</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('register') }}" class="rk-btn-primary btn-lg">
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
        }
        
        .rk-kelas-search .input-group {
            flex-direction: column;
        }
        
        .rk-kelas-search .form-control {
            border-radius: 50px;
            margin-bottom: 10px;
            border-right: 1px solid #ced4da !important;
        }
        
        .rk-kelas-search .btn {
            border-radius: 50px;
            width: 100%;
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
</style>

@endsection