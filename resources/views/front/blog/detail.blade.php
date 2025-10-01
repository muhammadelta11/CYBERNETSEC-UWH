@extends('layouts.front')
@section('content')

<style>
.rk-content-body {
    color: #c4c4c4ff!important;
}

/* Custom color for active "Semua" button text on Artikel page */
.rk-article-categories .btn-outline-primary.active {
    color: #ff0000ff !important; /* Red color */
}
</style>

<section class="rk-blog-detail-hero">
    <div class="container pt-4 pb-4">
        <nav aria-label="breadcrumb blog-detail-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog') }}" class="text-decoration-none">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Artikel</li>
            </ol>
        </nav>
    </div>
</section>

<section class="rk-blog-detail-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <article class="rk-blog-detail-article">
                    <header class="rk-blog-detail-header mb-5" data-aos="fade-up">
                        <h1 class="display-5 fw-bold mb-3 rk-heading">{{ $blog->name_blog }}</h1>
                        
                    <div class="rk-blog-meta mb-4 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="rk-author-avatar me-3">
                                <img src="https://ui-avatars.com/api/?name=Admin&background=4361ee&color=fff" alt="Author" class="rounded-circle" width="50">
                            </div>
                            <div>
                                <p class="mb-1 fw-semibold fs-5">Admin</p>
                                <small class="text-muted">Penulis & Editor</small>
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex align-items-center">
                                <i class="far fa-calendar-alt text-primary me-3"></i>
                                <span class="text-muted fw-medium">{{ date('d F Y', strtotime($blog->created_at)) }}</span>
                            </div>

                            <div class="d-flex align-items-center">
                                <i class="far fa-clock text-primary me-3"></i>
                                <span class="text-muted fw-medium">5 min read</span> 
                            </div>
                        </div>
                    </div>
                        
                        <div class="rk-blog-tags mb-3">
                            @if($blog->category)
                                <span class="badge bg-primary bg-opacity-10 text-primary">{{ $blog->category->name }}</span>
                            @endif
                        </div>
                    </header>

                    <div class="rk-blog-featured-image mb-5" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('storage/'.$blog->thumbnail_blog) }}" alt="{{ $blog->name_blog }}" class="img-fluid rounded-3 shadow">
                    </div>

                    <div class="rk-blog-content" data-aos="fade-up" data-aos-delay="200">
                        <div class="rk-content-body">
                            {!! $blog->content_blog !!}
                        </div>
                    </div>

                    <div class="rk-blog-share mt-5 pt-4 border-top" data-aos="fade-up" data-aos-delay="300">
                        <h6 class="fw-bold mb-3">Bagikan Artikel</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode(url()->current()) . '&quote=' . urlencode($blog->name_blog) }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-primary d-flex align-items-center"
                               onclick="trackShare('facebook')">
                                <i class="fab fa-facebook-f me-2"></i> Facebook
                            </a>
                            <a href="{{ 'https://twitter.com/intent/tweet?text=' . urlencode($blog->name_blog) . '&url=' . urlencode(url()->current()) }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-info d-flex align-items-center"
                               onclick="trackShare('twitter')">
                                <i class="fab fa-twitter me-2"></i> Twitter
                            </a>
                            <a href="{{ 'https://wa.me/?text=' . urlencode($blog->name_blog . ' - ' . url()->current()) }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-success d-flex align-items-center"
                               onclick="trackShare('whatsapp')">
                                <i class="fab fa-whatsapp me-2"></i> WhatsApp
                            </a>
                            <a href="{{ 'https://www.linkedin.com/sharing/share-offsite/?url=' . urlencode(url()->current()) }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-primary d-flex align-items-center"
                               onclick="trackShare('linkedin')">
                                <i class="fab fa-linkedin-in me-2"></i> LinkedIn
                            </a>
                            <button type="button"
                                    class="btn btn-sm btn-outline-secondary d-flex align-items-center"
                                    id="copyLinkBtn"
                                    onclick="copyToClipboard()">
                                <i class="fas fa-link me-2"></i>
                                <span id="copyText">Copy Link</span>
                            </button>
                        </div>
                        <div id="copySuccess" class="mt-2 text-success small d-none">
                            <i class="fas fa-check me-1"></i> Link berhasil disalin!
                        </div>
                    </div>
                </article>
            </div>
            
            <div class="col-lg-4 mt-5 mt-lg-0">
                <aside class="rk-blog-sidebar" data-aos="fade-left" data-aos-delay="400">
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

                    <div class="rk-sidebar-widget mb-5">
                        <h5 class="fw-bold mb-4 rk-heading">Artikel Terbaru</h5>
                        <div class="rk-recent-posts">
                            
                            @if(!empty($recentBlogs) && count($recentBlogs) > 0)
                                @foreach($recentBlogs as $recent)
                                <a href="{{ route('blog.detail', Crypt::encrypt($recent->id)) }}" class="rk-recent-post-item d-flex mb-3 text-decoration-none">
                                    <div class="rk-post-thumb me-3">
                                        <img src="{{ asset('storage/'.$recent->thumbnail_blog) }}" alt="{{ $recent->name_blog }}" class="rounded" width="60" height="60" style="object-fit: cover;">
                                    </div>
                                    <div class="rk-post-content">
                                        <h6 class="fw-medium mb-1 rk-heading">
                                            {{ Str::limit($recent->name_blog, 40) }}
                                        </h6>
                                        <small class="text-muted">{{ date('d M Y', strtotime($recent->created_at)) }}</small>
                                    </div>
                                </a>
                                @endforeach
                            @else
                                <div class="text-muted small">Belum ada artikel terbaru</div>
                            @endif
                        </div>
                    </div>

                    <div class="rk-sidebar-widget mb-5">
                        <h5 class="fw-bold mb-4 rk-heading">Kategori</h5>
                        <div class="rk-categories-list">
                            @if(!empty($categories))
                                @foreach($categories as $category)
                                <a href="{{ route('blog', ['category' => $category->id]) }}" class="d-flex justify-content-between align-items-center py-2 border-bottom text-decoration-none rk-category-link">
                                    <span class="text-dark">{{ $category->name }}</span>
                                    <span class="badge bg-primary bg-opacity-10 text-primary">{{ $category->blogs_count }}</span>
                                </a>
                                @endforeach
                            @else
                                <p class="text-muted small">Belum ada kategori</p>
                            @endif
                        </div>
                    </div>

                    <div class="rk-sidebar-widget">
                        <div class="rk-card bg-primary text-white">
                            <div class="card-body text-center">
                                <h5 class="fw-bold mb-3 rk-heading">Newsletter</h5>
                                <p class="small mb-3 opacity-75">Dapatkan update artikel terbaru langsung ke email Anda</p>
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
                <div class="rk-blog-card rk-card h-100 border-0 shadow-sm rk-shadow-hover">
                    <div class="rk-blog-card-img position-relative">
                        <img src="{{ asset('storage/'.$related->thumbnail_blog) }}" class="card-img-top" alt="{{ $related->name_blog }}" style="height: 200px; object-fit: cover;">
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
                        <p class="card-text text-muted small rk-line-clamp-3">
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
    /* Perbaikan untuk Blog Meta */
.rk-blog-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 1.5rem; /* Mengatur jarak yang lebih konsisten antar item */
}

.rk-blog-meta .d-flex {
    flex-shrink: 0; /* Mencegah item menyusut */
}

/* Perbaikan untuk Avatar Penulis */
.rk-author-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
}

.rk-author-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Perbaikan untuk Ikon Sosial Media di Sidebar */
.rk-author-social {
    display: flex;
    justify-content: center;
    gap: 0.75rem; /* Menambah jarak antar ikon */
}

.rk-author-social a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 35px; /* Mengatur ukuran ikon */
    height: 35px;
    border: 1px solid var(--rk-primary);
    border-radius: 50%;
    color: var(--rk-primary);
    transition: all 0.3s ease;
}

.rk-author-social a:hover {
    background-color: var(--rk-primary);
    color: white;
}

/* Perbaikan untuk Ikon di Tombol Bagikan */
.rk-blog-share .btn {
    border-radius: 50px;
    padding: 0.375rem 1rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem; /* Jarak antara ikon dan teks */
    transition: all 0.3s ease;
}

.rk-blog-share .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Copy Success Message */
#copySuccess {
    animation: fadeInOut 3s ease-in-out;
}

@keyframes fadeInOut {
    0% { opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% { opacity: 0; }
}
/* Blog Detail Hero */
.rk-blog-detail-hero {
    background: transparent;
    margin-top: -1px;
    padding-top: calc(80px + 2rem);
    padding-bottom: 2rem;
}

.rk-blog-detail-hero .breadcrumb {
    margin-bottom: 0;
    padding: 0;
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
    height: 450px; /* Sedikit lebih besar untuk layar lebar */
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
    font-size: 1.2rem;
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
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05) !important;
}

.rk-recent-post-item {
    transition: transform 0.3s ease;
}

.rk-recent-post-item:hover {
    transform: translateX(5px);
}
.rk-recent-post-item:hover h6,
.rk-recent-post-item:hover small {
    color: var(--rk-primary) !important;
}

.rk-categories-list a {
    transition: all 0.3s ease;
    padding-left: 1rem;
}

.rk-categories-list a:hover {
    background: rgba(67, 97, 238, 0.08);
    padding-left: 1.5rem;
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
    width: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.rk-blog-card:hover .rk-blog-card-img img {
    transform: scale(1.05);
}

/* Dark Mode styles for blog page */
body.dark-mode .rk-blog-detail-hero,
body.dark-mode .rk-related-articles {
    background-color: #1a1e22 !important;
}
body.dark-mode .rk-blog-detail-hero .breadcrumb-item a,
body.dark-mode .rk-blog-detail-hero .breadcrumb-item.active {
    color: #f8f9fa !important;
    
}
body.dark-mode .rk-blog-detail-header,
body.dark-mode .rk-blog-detail-section .border-top {
    border-color: rgba(255, 255, 255, 0.1) !important;
}
body.dark-mode .rk-blog-meta small,
body.dark-mode .rk-blog-meta p {
    color: #a0aec0 !important;
}
body.dark-mode .rk-blog-content,
body.dark-mode .rk-blog-content p,
body.dark-mode .rk-blog-content a {
    color: #e2e8f0;
}
body.dark-mode .rk-blog-content h2,
body.dark-mode .rk-blog-content h3,
body.dark-mode .rk-blog-content h4 {
    color: #f8f9fa;
}
body.dark-mode .rk-blog-content blockquote {
    background: rgba(67, 97, 238, 0.1);
    color: #a0aec0;
}
body.dark-mode .rk-blog-card,
body.dark-mode .rk-sidebar-widget .rk-card {
    background-color: #2c3136;
    color: #e2e8f0;
}
body.dark-mode .rk-blog-card .card-text {
    color: #a0aec0 !important;
}
body.dark-mode .rk-blog-card .btn-outline-primary {
    color: var(--rk-primary);
    border-color: var(--rk-primary);
}
body.dark-mode .rk-blog-card .btn-outline-primary:hover {
    background-color: var(--rk-primary);
    color: white;
}
body.dark-mode .rk-recent-post-item .text-dark,
body.dark-mode .rk-recent-post-item .text-muted {
    color: #e2e8f0 !important;
}
body.dark-mode .rk-recent-post-item:hover h6,
body.dark-mode .rk-recent-post-item:hover small {
    color: var(--rk-primary) !important;
}
body.dark-mode .rk-categories-list a {
    color: #f8f9fa;
}
body.dark-mode .rk-categories-list a:hover {
    background: rgba(67, 97, 238, 0.2);
    color: var(--rk-primary) !important;
}
body.dark-mode .rk-newsletter-form .form-control {
    background-color: #3b3f42;
    border-color: #555;
    color: #fff;
}
body.dark-mode .rk-newsletter-form .form-control::placeholder {
    color: #a0aec0;
}
body.dark-mode .rk-newsletter-form .btn-light {
    background-color: #555;
    border-color: #555;
    color: #fff;
}
body.dark-mode .rk-newsletter-form .btn-light:hover {
    background-color: #666;
}

/* Additional Dark Mode Improvements for Author Info */
[data-theme="dark"] .rk-blog-meta i {
    color: var(--rk-primary) !important;
}

[data-theme="dark"] .rk-author-avatar img {
    border: 2px solid #a0aec0;
}

[data-theme="dark"] .rk-author-profile img {
    border: 3px solid #a0aec0;
}

[data-theme="dark"] .badge {
    background-color: rgba(67, 97, 238, 0.2) !important;
    color: var(--rk-primary) !important;
}

[data-theme="dark"] .rk-categories-list .text-dark {
    color: #e2e8f0 !important;
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
</style>

@endsection