@extends('layouts.front')
@section('content')

<!-- Hero Section -->
<section class="rk-blog-detail-hero bg-light py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog') }}" class="text-decoration-none">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Artikel</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Blog Detail Section -->
<section class="rk-blog-detail-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <article class="rk-blog-detail-article">
                    <!-- Header -->
                    <header class="rk-blog-detail-header mb-5" data-aos="fade-up">
                        <h1 class="display-5 fw-bold mb-3 rk-heading">{{ $blog->name_blog }}</h1>
                        
                        <div class="rk-blog-meta d-flex flex-wrap align-items-center gap-4 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="rk-author-avatar me-2">
                                    <img src="https://ui-avatars.com/api/?name=Admin&background=4361ee&color=fff" alt="Author" class="rounded-circle" width="40">
                                </div>
                                <div>
                                    <p class="mb-0 fw-medium">Admin</p>
                                    <small class="text-muted">Penulis</small>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <i class="far fa-calendar-alt text-primary me-2"></i>
                                <small class="text-muted">{{ date('d F Y', strtotime($blog->created_at)) }}</small>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <i class="far fa-clock text-primary me-2"></i>
                                <small class="text-muted">5 min read</small>
                            </div>
                        </div>
                        
                        <div class="rk-blog-tags mb-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary me-2">Education</span>
                            <span class="badge bg-primary bg-opacity-10 text-primary me-2">Learning</span>
                            <span class="badge bg-primary bg-opacity-10 text-primary">Tips</span>
                        </div>
                    </header>

                    <!-- Featured Image -->
                    <div class="rk-blog-featured-image mb-5" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('storage/'.$blog->thumbnail_blog) }}" alt="{{ $blog->name_blog }}" class="img-fluid rounded-3 shadow">
                    </div>

                    <!-- Content -->
                    <div class="rk-blog-content" data-aos="fade-up" data-aos-delay="200">
                        <div class="rk-content-body">
                            {!! $blog->content_blog !!}
                        </div>
                    </div>

                    <!-- Share Buttons -->
                    <div class="rk-blog-share mt-5 pt-4 border-top" data-aos="fade-up" data-aos-delay="300">
                        <h6 class="fw-bold mb-3">Bagikan Artikel</h6>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-sm btn-outline-primary d-flex align-items-center">
                                <i class="fab fa-facebook-f me-2"></i> Facebook
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-info d-flex align-items-center">
                                <i class="fab fa-twitter me-2"></i> Twitter
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-danger d-flex align-items-center">
                                <i class="fab fa-instagram me-2"></i> Instagram
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-secondary d-flex align-items-center">
                                <i class="fas fa-link me-2"></i> Copy Link
                            </a>
                        </div>
                    </div>
                </article>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <aside class="rk-blog-sidebar" data-aos="fade-left" data-aos-delay="400">
                    <!-- About Author -->
                    <div class="rk-sidebar-widget mb-5">
                        <div class="rk-card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="rk-author-profile mb-3">
                                    <img src="https://ui-avatars.com/api/?name=Admin&background=4361ee&color=fff&size=100" alt="Author" class="rounded-circle mb-3" width="80">
                                    <h5 class="fw-bold mb-1 rk-heading">Admin</h5>
                                    <p class="text-muted small">Content Writer & Educator</p>
                                </div>
                                <p class="text-muted">Penulis dengan passion dalam dunia pendidikan dan teknologi. Berpengalaman menulis artikel edukatif selama 5+ tahun.</p>
                                <div class="rk-author-social d-flex justify-content-center gap-2 mt-3">
                                    <a href="#" class="text-primary"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="text-primary"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="text-primary"><i class="fab fa-instagram"></i></a>
                                    <a href="#" class="text-primary"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Posts -->
                    <div class="rk-sidebar-widget mb-5">
                        <h5 class="fw-bold mb-4 rk-heading">Artikel Terbaru</h5>
                        <div class="rk-recent-posts">
                            @php
                                // Mengambil recent blogs dari database jika tidak disediakan oleh controller
                                if (!isset($recentBlogs) || empty($recentBlogs)) {
                                    try {
                                        // Coba ambil dari model Blog jika ada
                                        if (class_exists('App\Models\Blog')) {
                                            $recentBlogs = App\Models\Blog::latest()->take(5)->get();
                                        } else {
                                            $recentBlogs = [];
                                        }
                                    } catch (Exception $e) {
                                        $recentBlogs = [];
                                    }
                                }
                            @endphp
                            
                            @if(!empty($recentBlogs) && count($recentBlogs) > 0)
                                @foreach($recentBlogs as $recent)
                                <div class="rk-recent-post-item d-flex mb-3">
                                    <div class="rk-post-thumb me-3">
                                        <img src="{{ asset('storage/'.$recent->thumbnail_blog) }}" alt="{{ $recent->name_blog }}" class="rounded" width="60" height="60" style="object-fit: cover;">
                                    </div>
                                    <div class="rk-post-content">
                                        <h6 class="fw-medium mb-1">
                                            <a href="{{ route('blog.detail', Crypt::encrypt($recent->id)) }}" class="text-dark text-decoration-none">
                                                {{ Str::limit($recent->name_blog, 40) }}
                                            </a>
                                        </h6>
                                        <small class="text-muted">{{ date('d M Y', strtotime($recent->created_at)) }}</small>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <!-- Fallback content jika tidak ada artikel -->
                                <div class="rk-recent-post-item d-flex mb-3">
                                    <div class="rk-post-thumb me-3">
                                        <div class="bg-primary bg-opacity-10 rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <i class="fas fa-newspaper text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="rk-post-content">
                                        <h6 class="fw-medium mb-1">
                                            <a href="#" class="text-dark text-decoration-none">
                                                Tips Belajar Programming
                                            </a>
                                        </h6>
                                        <small class="text-muted">15 Nov 2023</small>
                                    </div>
                                </div>
                                <div class="rk-recent-post-item d-flex mb-3">
                                    <div class="rk-post-thumb me-3">
                                        <div class="bg-primary bg-opacity-10 rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                            <i class="fas fa-newspaper text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="rk-post-content">
                                        <h6 class="fw-medium mb-1">
                                            <a href="#" class="text-dark text-decoration-none">
                                                Framework Terbaru 2023
                                            </a>
                                        </h6>
                                        <small class="text-muted">10 Nov 2023</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="rk-sidebar-widget mb-5">
                        <h5 class="fw-bold mb-4 rk-heading">Kategori</h5>
                        <div class="rk-categories-list">
                            @php
                                // Data kategori - bisa diganti dengan data dinamis dari database
                                $categories = [
                                    ['name' => 'Teknologi', 'count' => 12],
                                    ['name' => 'Pendidikan', 'count' => 8],
                                    ['name' => 'Web Development', 'count' => 15],
                                    ['name' => 'Tips & Trik', 'count' => 7],
                                    ['name' => 'Design', 'count' => 9]
                                ];
                            @endphp
                            
                            @foreach($categories as $category)
                            <a href="#" class="d-flex justify-content-between align-items-center py-2 border-bottom text-decoration-none">
                                <span class="text-dark">{{ $category['name'] }}</span>
                                <span class="badge bg-primary bg-opacity-10 text-primary">{{ $category['count'] }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div class="rk-sidebar-widget">
                        <div class="rk-card bg-primary text-white">
                            <div class="card-body text-center">
                                <h5 class="fw-bold mb-3">Newsletter</h5>
                                <p class="small mb-3">Dapatkan update artikel terbaru langsung ke email Anda</p>
                                <form class="rk-newsletter-form">
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" placeholder="Email Anda" aria-label="Email">
                                        <button class="btn btn-light" type="submit">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </form>
                                <small class="opacity-75">Kami menghargai privasi Anda</small>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

<!-- Related Articles -->
@php
    // Mengambil related blogs dari database jika tidak disediakan oleh controller
    if (!isset($relatedBlogs) || empty($relatedBlogs)) {
        try {
            // Coba ambil dari model Blog jika ada
            if (class_exists('App\Models\Blog')) {
                $relatedBlogs = App\Models\Blog::where('id', '!=', $blog->id)
                    ->inRandomOrder()
                    ->take(3)
                    ->get();
            } else {
                $relatedBlogs = [];
            }
        } catch (Exception $e) {
            $relatedBlogs = [];
        }
    }
@endphp

@if(!empty($relatedBlogs) && count($relatedBlogs) > 0)
<section class="rk-related-articles py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-3 rk-heading">Artikel Terkait</h2>
                <p class="text-muted">Temukan lebih banyak konten menarik yang mungkin Anda sukai</p>
            </div>
        </div>
        <div class="row">
            @foreach($relatedBlogs as $related)
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="rk-blog-card rk-card h-100 border-0 shadow-sm">
                    <div class="rk-blog-card-img position-relative">
                        <img src="{{ asset('storage/'.$related->thumbnail_blog) }}" class="card-img-top" alt="{{ $related->name_blog }}">
                        <div class="rk-blog-date position-absolute top-0 start-0 bg-primary text-white m-3 px-2 py-1 rounded">
                            <small>{{ date('d M Y', strtotime($related->created_at)) }}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold rk-heading">
                            <a href="{{ route('blog.detail', Crypt::encrypt($related->id)) }}" class="text-dark text-decoration-none">
                                {{ Str::limit($related->name_blog, 50) }}
                            </a>
                        </h5>
                        <p class="card-text text-muted small">
                            {{ Str::limit(strip_tags($related->content_blog), 100) }}
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <a href="{{ route('blog.detail', Crypt::encrypt($related->id)) }}" class="btn btn-sm btn-outline-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
    /* Blog Detail Hero */
    .rk-blog-detail-hero {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        margin-top: -1px;
    }
    
    .rk-blog-detail-hero .breadcrumb {
        margin-bottom: 0;
        padding: 0.75rem 0;
    }
    
    .rk-blog-detail-hero .breadcrumb-item a {
        color: var(--rk-dark);
        transition: color 0.3s ease;
    }
    
    .rk-blog-detail-hero .breadcrumb-item a:hover {
        color: var(--rk-primary);
    }
    
    .rk-blog-detail-hero .breadcrumb-item.active {
        color: var(--rk-primary);
    }
    
    /* Blog Detail Header */
    .rk-blog-detail-header {
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 1.5rem;
    }
    
    .rk-blog-meta {
        color: #6c757d;
    }
    
    /* Featured Image */
    .rk-blog-featured-image img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: var(--rk-radius);
    }
    
    /* Blog Content */
    .rk-blog-content {
        line-height: 1.8;
        color: #4a5568;
    }
    
    .rk-blog-content h2,
    .rk-blog-content h3,
    .rk-blog-content h4 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: var(--rk-dark);
    }
    
    .rk-blog-content p {
        margin-bottom: 1.5rem;
    }
    
    .rk-blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5rem 0;
    }
    
    .rk-blog-content blockquote {
        border-left: 4px solid var(--rk-primary);
        padding-left: 1.5rem;
        margin: 2rem 0;
        font-style: italic;
        color: #6c757d;
        background: rgba(67, 97, 238, 0.05);
        padding: 1.5rem;
        border-radius: var(--rk-radius);
    }
    
    /* Share Buttons */
    .rk-blog-share .btn {
        border-radius: 50px;
        padding: 0.375rem 1rem;
    }
    
    /* Sidebar */
    .rk-sidebar-widget .rk-card {
        border-radius: var(--rk-radius);
    }
    
    .rk-recent-post-item {
        transition: transform 0.3s ease;
    }
    
    .rk-recent-post-item:hover {
        transform: translateX(5px);
    }
    
    .rk-categories-list a {
        transition: all 0.3s ease;
    }
    
    .rk-categories-list a:hover {
        background: rgba(67, 97, 238, 0.05);
        padding-left: 10px;
    }
    
    /* Related Articles */
    .rk-related-articles .rk-blog-card {
        transition: all 0.3s ease;
    }
    
    .rk-related-articles .rk-blog-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--rk-shadow) !important;
    }
    
    .rk-blog-card-img {
        height: 200px;
        overflow: hidden;
    }
    
    .rk-blog-card-img img {
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .rk-blog-card:hover .rk-blog-card-img img {
        transform: scale(1.05);
    }
    
    /* Responsive Design */
    @media (max-width: 991.98px) {
        .rk-blog-detail-section {
            padding: 3rem 0;
        }
    }
    
    @media (max-width: 768px) {
        .rk-blog-detail-header h1 {
            font-size: 2rem;
        }
        
        .rk-blog-meta {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem !important;
        }
        
        .rk-blog-featured-image img {
            height: 250px;
        }
        
        .rk-blog-share .btn {
            margin-bottom: 0.5rem;
        }
        
        .rk-blog-sidebar {
            margin-top: 3rem;
        }
    }
    
    @media (max-width: 576px) {
        .rk-blog-detail-hero {
            padding: 1.5rem 0;
        }
        
        .rk-blog-detail-section {
            padding: 2rem 0;
        }
        
        .display-5 {
            font-size: 2rem;
        }
    }
    
    /* Memastikan konten tidak tertutup oleh fixed navbar */
    .rk-blog-detail-hero {
        padding-top: calc(80px + 1rem);
    }
</style>

@endsection