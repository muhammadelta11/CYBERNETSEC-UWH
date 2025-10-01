@extends('layouts.front')
@section('content')

<!-- Hero Section -->
<section class="rk-podcast-hero bg-light">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-lg-8 mx-auto text-center">
                <div data-aos="fade-up">
                    <h1 class="display-5 fw-bold mb-3 rk-heading">Jadwal Event</h1>
                    <p class="lead text-muted">Temukan Jadwal Event inspiratif untuk meningkatkan skill dan pengetahuan Anda</p>

                    <!-- Search Form -->
                    <div class="rk-podcast-search mt-4" data-aos="fade-up" data-aos-delay="100">
                        <form action="#" method="GET" class="d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-lg" placeholder="Cari event..." aria-label="Search events">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Category Filters -->
                    <div class="rk-podcast-categories mt-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="#" class="btn btn-sm btn-outline-primary active w-auto">Semua</a>
                            <a href="#" class="btn btn-sm btn-outline-primary w-auto">Online</a>
                            <a href="#" class="btn btn-sm btn-outline-primary w-auto">Offline</a>
                            <a href="#" class="btn btn-sm btn-outline-primary w-auto">Hybrid</a>
                            <a href="#" class="btn btn-sm btn-outline-primary w-auto">Workshop</a>
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
                <h2 class="fw-bold mb-3 rk-heading">Event Kami</h2>
                <p class="text-muted">Event yang dirancang khusus untuk membantu perkembangan karir Anda</p>
            </div>
        </div>
        
        <div class="row">
            @forelse ($podcasts as $item)
            <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="rk-podcast-card rk-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-podcast-thumb position-relative" style="overflow: hidden; border: 1px solid red;">
                        @if($item->thumbnail)
                            <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                 class="card-img-top" alt="{{ $item->name_podcast }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-event.jpg') }}"
                                 class="card-img-top" alt="{{ $item->name_podcast }}"
                                 style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="rk-event-badge position-absolute top-0 start-0 m-3" style="z-index: 9999; background-color: rgba(0,0,0,0.5);">
                            <span class="badge text-white px-3 py-1 rounded-2 bg-{{ $item->event_type == 'online' ? 'success' : ($item->event_type == 'offline' ? 'primary' : 'warning') }}" style="font-weight: 600; font-size: 0.85rem;">
                                {{ ucfirst($item->event_type ?? 'Event') }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold rk-heading">
                            <a href="{{ route('podcast.detail', Crypt::encrypt($item->id)) }}" class="text-dark text-decoration-none">
                                {{ $item->name_podcast }}
                            </a>
                        </h5>
                        <div class="rk-event-info mb-2">
                            @if($item->event_date)
                                <small class="text-muted d-block">
                                    <i class="far fa-calendar me-1"></i>
                                    {{ \Carbon\Carbon::parse($item->event_date)->format('d M Y') }}
                                    @if($item->event_time)
                                        {{ $item->event_time }}
                                    @endif
                                </small>
                            @endif
                            @if($item->location)
                                <small class="text-muted d-block">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    {{ $item->location }}
                                </small>
                            @endif
                            @if($item->speaker)
                                <small class="text-muted d-block">
                                    <i class="fas fa-user me-1"></i>
                                    {{ $item->speaker }}
                                </small>
                            @endif
                        </div>
                        <p class="card-text text-muted rk-line-clamp-3">
                            {!! strip_tags($item->description_podcast) !!}
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                            <div class="rk-event-price">
                                @if($item->registration_fee > 0)
                                    <small class="text-success fw-bold">
                                        <i class="fas fa-ticket-alt me-1"></i>
                                        Rp {{ number_format($item->registration_fee, 0, ',', '.') }}
                                    </small>
                                @else
                                    <small class="text-success">
                                        <i class="fas fa-ticket-alt me-1"></i>
                                        Gratis
                                    </small>
                                @endif
                            </div>
                            <a href="{{ route('podcast.detail', Crypt::encrypt($item->id)) }}" class="btn btn-sm btn-outline-primary">
                                Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5" data-aos="fade-up">
                <div class="rk-empty-state">
                    <i class="fas fa-calendar-alt fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada event</h4>
                    <p class="text-muted">Silakan kembali lagi nanti untuk melihat event terbaru</p>
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
                <h3 class="fw-bold mb-3">Ingin Mengikuti Event Lainnya?</h3>
                <p class="mb-4">Bergabunglah dengan komunitas kami untuk mendapatkan informasi event terbaru dan eksklusif</p>
                <a href="{{ route('register') }}" class="rk-btn-primary btn-lg">
                    Daftar Sekarang <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>



<style>
    /* Dark Mode Styles for Podcast/Event Page */
    [data-theme="dark"] .rk-podcast-hero {
        background-color: #1a1e22 !important;
    }

    [data-theme="dark"] .rk-podcast-hero .text-muted {
        color: #a0aec0 !important;
    }

    [data-theme="dark"] .rk-podcast-categories .btn-outline-primary {
        color: var(--rk-primary) !important;
        border-color: var(--rk-primary) !important;
    }

    [data-theme="dark"] .rk-podcast-categories .btn-outline-primary:hover,
    [data-theme="dark"] .rk-podcast-categories .btn-outline-primary.active {
        background-color: var(--rk-primary) !important;
        color: white !important;
    }

    [data-theme="dark"] .rk-podcast-card .text-dark {
        color: #e2e8f0 !important;
    }

    [data-theme="dark"] .rk-podcast-card .text-muted {
        color: #a0aec0 !important;
    }

    [data-theme="dark"] .rk-podcast-card .btn-outline-primary {
        color: var(--rk-primary) !important;
        border-color: var(--rk-primary) !important;
    }

    [data-theme="dark"] .rk-podcast-card .btn-outline-primary:hover {
        background-color: var(--rk-primary) !important;
        color: white !important;
    }

    [data-theme="dark"] .rk-event-badge .badge {
        background-color: rgba(67, 97, 238, 0.2) !important;
        color: var(--rk-primary) !important;
    }

    [data-theme="dark"] .rk-event-info .text-muted {
        color: #a0aec0 !important;
    }

    [data-theme="dark"] .rk-event-price .text-success {
        color: #48bb78 !important;
    }

    [data-theme="dark"] .rk-empty-state .text-muted {
        color: #a0aec0 !important;
    }

    [data-theme="dark"] .rk-cta-section {
        background-color: var(--rk-primary) !important;
    }

    /* Pagination */
    [data-theme="dark"] .pagination .page-link {
        background-color: #2c3136 !important;
        border-color: #555 !important;
        color: #e2e8f0 !important;
    }

    [data-theme="dark"] .pagination .page-item.active .page-link {
        background-color: var(--rk-primary) !important;
        border-color: var(--rk-primary) !important;
        color: white !important;
    }

    [data-theme="dark"] .pagination .page-link:hover {
        background-color: rgba(67, 97, 238, 0.2) !important;
        color: var(--rk-primary) !important;
    }
</style>

@endsection
