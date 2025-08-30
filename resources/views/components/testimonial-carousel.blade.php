@php
$testimonials = [
    [
        'name' => 'Ahmad Rizki',
        'role' => 'Mahasiswa Teknik Informatika',
        'rating' => 5,
        'text' => 'Platform ini sangat membantu saya dalam memahami konsep cyber security. Materi yang disajikan sangat lengkap dan mudah dipahami.',
        'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80'
    ],
    [
        'name' => 'Sari Dewi',
        'role' => 'Developer Fullstack',
        'rating' => 5,
        'text' => 'Kelas AI dan Cloud Computing sangat recommended! Mentor sangat berpengalaman dan responsive dalam menjawab pertanyaan.',
        'avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b612b47c?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80'
    ],
    [
        'name' => 'Budi Santoso',
        'role' => 'Network Engineer',
        'rating' => 4,
        'text' => 'Materi network engineering sangat up-to-date dengan teknologi terbaru. Sangat berguna untuk karir saya.',
        'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80'
    ],
    [
        'name' => 'Rina Wijaya',
        'role' => 'Data Scientist',
        'rating' => 5,
        'text' => 'Platform belajar online terbaik yang pernah saya coba. Interface user-friendly dan konten sangat berkualitas.',
        'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80'
    ]
];
@endphp

<section class="rk-section py-5 bg-light">
    <div class="container py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h6 class="text-primary mb-2">Testimonial</h6>
                <h2 class="fw-bold mb-3 rk-heading">Apa Kata Mereka?</h2>
                <p class="text-muted">Lihat pengalaman langsung dari siswa dan alumni kami</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="rk-testimonial-carousel owl-carousel">
                    @foreach ($testimonials as $testimonial)
                    <div class="rk-testimonial-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="rk-testimonial-card">
                            <div class="rk-testimonial-header">
                                <div class="rk-testimonial-avatar">
                                    <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['name'] }}" class="img-fluid">
                                </div>
                                <div class="rk-testimonial-info">
                                    <h5 class="fw-bold mb-1 rk-heading">{{ $testimonial['name'] }}</h5>
                                    <p class="text-muted mb-2">{{ $testimonial['role'] }}</p>
                                    <div class="rk-rating">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fas fa-star {{ $i < $testimonial['rating'] ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="rk-testimonial-content">
                                <p class="mb-0">"{{ $testimonial['text'] }}"</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .rk-testimonial-carousel {
        position: relative;
    }
    
    .rk-testimonial-card {
        background: white;
        border-radius: var(--rk-radius);
        padding: 2rem;
        box-shadow: var(--rk-shadow);
        margin: 1rem;
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .rk-testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }
    
    .rk-testimonial-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .rk-testimonial-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 1rem;
        border: 3px solid var(--rk-primary);
        padding: 2px;
    }
    
    .rk-testimonial-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }
    
    .rk-testimonial-info {
        flex: 1;
    }
    
    .rk-testimonial-content {
        position: relative;
    }
    
    .rk-testimonial-content::before {
        content: '"';
        font-size: 4rem;
        color: var(--rk-primary);
        opacity: 0.1;
        position: absolute;
        top: -1rem;
        left: -0.5rem;
        font-family: Georgia, serif;
    }
    
    .rk-rating {
        font-size: 0.9rem;
    }
    
    /* Owl Carousel Customization */
    .rk-testimonial-carousel .owl-stage {
        padding: 2rem 0;
    }
    
    .rk-testimonial-carousel .owl-nav {
        position: absolute;
        top: 50%;
        width: 100%;
        transform: translateY(-50%);
        display: flex;
        justify-content: space-between;
        padding: 0 2rem;
    }
    
    .rk-testimonial-carousel .owl-prev,
    .rk-testimonial-carousel .owl-next {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: white !important;
        color: var(--rk-primary) !important;
        box-shadow: var(--rk-shadow);
        display: flex !important;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .rk-testimonial-carousel .owl-prev:hover,
    .rk-testimonial-carousel .owl-next:hover {
        background: var(--rk-primary) !important;
        color: white !important;
    }
    
    .rk-testimonial-carousel .owl-dots {
        text-align: center;
        margin-top: 2rem;
    }
    
    .rk-testimonial-carousel .owl-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #ddd !important;
        margin: 0 5px;
        transition: all 0.3s ease;
    }
    
    .rk-testimonial-carousel .owl-dot.active {
        background: var(--rk-primary) !important;
        transform: scale(1.2);
    }
    
    @media (max-width: 768px) {
        .rk-testimonial-card {
            padding: 1.5rem;
            margin: 0.5rem;
        }
        
        .rk-testimonial-header {
            flex-direction: column;
            text-align: center;
        }
        
        .rk-testimonial-avatar {
            margin-right: 0;
            margin-bottom: 1rem;
        }
        
        .rk-testimonial-carousel .owl-nav {
            display: none;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize testimonial carousel
        $('.rk-testimonial-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1200: {
                    items: 3
                }
            }
        });
    });
</script>
