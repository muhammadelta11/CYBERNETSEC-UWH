@extends('layouts.front')
@section('content')

<!-- Hero Section -->
<section class="rk-blog-hero bg-light">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-lg-8 mx-auto text-center">
                <div data-aos="fade-up">
                    <h1 class="display-5 fw-bold mb-3 rk-heading">Blog & Artikel</h1>
                    <p class="lead text-muted">Temukan tips, tutorial, dan insight terbaru seputar dunia pendidikan dan pengembangan skill</p>
                    
                    <!-- Search Form -->
                    <div class="rk-blog-search mt-4" data-aos="fade-up" data-aos-delay="100">
                        <form action="#" method="GET" class="d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-lg" placeholder="Cari artikel..." aria-label="Search articles">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Category Filters -->
                    <div class="rk-blog-categories mt-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="{{ route('blog') }}" class="btn btn-sm btn-outline-primary {{ !$selectedCategory ? 'active' : '' }}">Semua</a>
                            @foreach(\App\BlogCategory::all() as $category)
                                <a href="{{ route('blog', ['category' => $category->id]) }}" class="btn btn-sm btn-outline-primary {{ $selectedCategory == $category->id ? 'active' : '' }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Posts Section -->
<section class="rk-blog-posts py-5">
    <div class="container">
        <div class="row">
            @forelse ($blogs as $item)
            <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <article class="rk-blog-card rk-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-blog-card-img position-relative">
                        <img src="{{ asset('storage/'.$item->thumbnail_blog) }}" class="card-img-top" alt="{{ $item->name_blog }}">
                        <div class="rk-blog-date position-absolute top-0 start-0 bg-primary text-white m-3 px-3 py-2 rounded">
                            <small>{{ date('d M Y', strtotime($item->created_at)) }}</small>
                        </div>
                        <div class="rk-blog-overlay position-absolute w-100 h-100"></div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <div class="rk-blog-author d-flex align-items-center me-4">
                                <div class="rk-author-avatar me-3">
                                    <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Author" class="rounded-circle" width="30">
                                </div>
                                <small class="text-muted">By Admin</small>
                            </div>
                            <span class="text-muted mx-3">•</span>
                            <div class="rk-blog-read-time ms-3">
                                <small class="text-muted"><i class="far fa-clock me-1"></i> 5 min read</small>
                            </div>
                        </div>
                        
                        <h3 class="h5 card-title fw-bold rk-heading">
                            <a href="{{ route('blog.detail', Crypt::encrypt($item->id)) }}" class="text-dark text-decoration-none">
                                {{ $item->name_blog }}
                            </a>
                        </h3>
                        
                        <p class="card-text text-muted rk-line-clamp-3">
                            {{ Str::limit(strip_tags($item->content_blog), 120) }}
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="rk-blog-tags">
                                <span class="badge bg-light text-dark">{{ $item->category->name ?? 'Education' }}</span>
                            </div>
                            <a href="{{ route('blog.detail', Crypt::encrypt($item->id)) }}" class="rk-blog-read-more">
                                <i class="fas fa-arrow-right text-primary"></i>
                            </a>
                        </div>
                    </div>
                </article>
            </div>
            @empty
            <div class="col-12 text-center py-5" data-aos="fade-up">
                <div class="rk-empty-state">
                    <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada artikel</h4>
                    <p class="text-muted">Silakan kembali lagi nanti untuk melihat artikel terbaru</p>
                </div>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination - Fixed Version -->
        @if($blogs->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <nav aria-label="Blog pagination" data-aos="fade-up">
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($blogs->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $blogs->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                            @if ($page == $blogs->currentPage())
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
                        @if ($blogs->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $blogs->nextPageUrl() }}" rel="next">&raquo;</a>
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

<!-- Newsletter Section -->
<section class="rk-newsletter bg-primary py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center text-white" data-aos="fade-up">
                <h3 class="fw-bold mb-3">Dapatkan Update Terbaru</h3>
                <p class="mb-4">Berlangganan newsletter kami untuk mendapatkan artikel terbaru langsung ke email Anda</p>
                
                <form class="rk-newsletter-form">
                    <div class="input-group input-group-lg mb-3">
                        <input type="email" class="form-control" placeholder="Masukkan email Anda" aria-label="Email address">
                        <button class="btn btn-light text-primary" type="submit">Berlangganan</button>
                    </div>
                    <small class="form-text">Kami tidak akan membagikan email Anda kepada siapapun</small>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    /* Blog Hero Section */
    .rk-blog-hero {
        padding: 120px 0 60px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        margin-top: -1px;
    }
    
    .rk-blog-search .input-group {
        max-width: 500px;
        margin: 0 auto;
    }
    
    .rk-blog-search .form-control {
        border-right: 0;
        border-radius: 50px 0 0 50px;
        padding-left: 25px;
    }
    
    .rk-blog-search .btn {
        border-radius: 0 50px 50px 0;
        padding: 0.75rem 1.5rem;
    }
    
    .rk-blog-categories .btn {
        border-radius: 50px;
        transition: all 0.3s ease;
        margin-right: 8px; /* Added spacing between buttons */
        margin-bottom: 6px; /* Added spacing for wrapping rows */
    }
    
    .rk-blog-categories .btn.active,
    .rk-blog-categories .btn:hover {
        background: var(--rk-primary);
        color: white;
        border-color: var(--rk-primary);
    }

    /* Custom color for active "Semua" button text on Blog index page */
    .rk-blog-categories .btn-outline-primary.active {
        color: #ffffffff !important; /* Red color */
    }
    
    /* Blog Cards */
    .rk-blog-card {
        border-radius: var(--rk-radius);
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .rk-blog-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--rk-shadow) !important;
    }
    
    .rk-blog-card-img {
        overflow: hidden;
        height: 200px;
    }
    
    .rk-blog-card-img img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .rk-blog-card:hover .rk-blog-card-img img {
        transform: scale(1.05);
    }
    
    .rk-blog-overlay {
        top: 0;
        left: 0;
        background: linear-gradient(to bottom, transparent 0%, transparent 50%, rgba(0,0,0,0.01) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .rk-blog-card:hover .rk-blog-overlay {
        opacity: 1;
    }
    
    .rk-blog-date {
        font-size: 0.8rem;
        z-index: 2;
    }
    
    .rk-line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 72px;
    }
    
    .rk-blog-read-more {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(67, 97, 238, 0.1);
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .rk-blog-read-more:hover {
        background: var(--rk-primary);
        color: white;
    }
    
    .rk-blog-read-more:hover i {
        color: white !important;
    }
    
    /* Newsletter Section */
    .rk-newsletter {
        background: var(--rk-gradient) !important;
    }
    
    .rk-newsletter-form .form-control {
        border-radius: 50px 0 0 50px;
        border: none;
        padding-left: 25px;
    }
    
    .rk-newsletter-form .btn {
        border-radius: 0 50px 50px 0;
        border: none;
        font-weight: 600;
    }
    
    /* Pagination */
    .rk-blog-posts .pagination {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }
    
    .rk-blog-posts .page-item {
        margin: 0 0.25rem;
    }
    
    .rk-blog-posts .page-link {
        border-radius: 8px;
        border: 1px solid #dee2e6;
        color: var(--rk-dark);
        padding: 0.5rem 0.75rem;
        transition: all 0.3s ease;
    }
    
    .rk-blog-posts .page-item.active .page-link {
        background: var(--rk-primary);
        border-color: var(--rk-primary);
        color: white;
    }
    
    .rk-blog-posts .page-link:hover {
        background: rgba(67, 97, 238, 0.1);
        color: var(--rk-primary);
        border-color: #dee2e6;
    }
    
    .rk-blog-posts .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
    }
    
    /* Empty State */
    .rk-empty-state {
        padding: 3rem 1rem;
    }
    
    /* Responsive Design */
    @media (max-width: 991.98px) {
        .rk-blog-hero {
            padding: 100px 0 40px;
        }
    }
    
    @media (max-width: 768px) {
        .rk-blog-hero {
            padding: 80px 0 40px;
        }
        
        .rk-blog-search .input-group {
            flex-direction: column;
        }
        
        .rk-blog-search .form-control {
            border-radius: 50px;
            margin-bottom: 10px;
            border-right: 1px solid #ced4da !important;
        }
        
        .rk-blog-search .btn {
            border-radius: 50px;
            width: 100%;
        }
        
        .rk-blog-categories {
            overflow-x: auto;
            padding-bottom: 10px;
        }
        
        .rk-blog-categories .d-flex {
            flex-wrap: nowrap;
            justify-content: flex-start !important;
        }
        
        .rk-blog-posts .pagination {
            flex-wrap: wrap;
        }
        
        .rk-blog-posts .page-item {
            margin: 0.125rem;
        }
        
        .display-5 {
            font-size: 2.2rem;
        }
    }
    
    @media (max-width: 576px) {
        .rk-blog-card-img {
            height: 180px;
        }
        
        .rk-blog-hero {
            padding: 70px 0 30px;
        }
        
        .rk-blog-posts {
            padding: 2rem 0;
        }
    }
    
    /* Memastikan konten tidak tertutup oleh fixed navbar */
    .rk-blog-hero {
        padding-top: calc(80px + 2rem);
    }

    /* Dark Mode Styles for Blog Index */
    [data-theme="dark"] .rk-blog-author small,
    [data-theme="dark"] .rk-blog-read-time small,
    [data-theme="dark"] .rk-blog-author + span {
        color: #a0aec0 !important;
    }

    [data-theme="dark"] .rk-blog-author .rk-author-avatar img {
        border: 2px solid #a0aec0;
    }

    [data-theme="dark"] .rk-blog-card .text-dark {
        color: #e2e8f0 !important;
    }

    [data-theme="dark"] .rk-blog-card .text-muted {
        color: #a0aec0 !important;
    }

    [data-theme="dark"] .rk-blog-tags .badge {
        background-color: rgba(67, 97, 238, 0.2) !important;
        color: var(--rk-primary) !important;
    }
</style>

@endsection