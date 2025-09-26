@extends('layouts.front')

@section('content')

<!-- Hero Section -->
<section class="rk-kelas-hero bg-light">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-lg-8 mx-auto text-center">
                <div data-aos="fade-up">
                    <h1 class="display-5 fw-bold mb-3 rk-heading">Kursus Saya</h1>
                    <p class="lead text-muted">Lanjutkan perjalanan belajar Anda dan raih sertifikat</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Courses Section -->
<section class="rk-kelas-section py-5">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            @forelse($kelas as $k)
            <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="rk-kelas-card rk-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-kelas-thumb position-relative">
                        <img src="{{ asset('storage/' . $k->thumbnail) }}" class="card-img-top" alt="{{ $k->name_kelas }}" 
                             style="height: 200px; object-fit: cover;">
                        <div class="rk-kelas-badge position-absolute top-0 end-0 m-3">
                            @if ($k->type_kelas == 0)
                            <span class="badge bg-success">Gratis</span>
                            @elseif($k->type_kelas == 1)
                            <span class="badge bg-primary">Regular</span>
                            @elseif($k->type_kelas == 2)
                            <span class="badge bg-warning">Premium</span>
                            @elseif($k->type_kelas == 3)
                            <span class="badge bg-info">Program Upskill</span>
                            @endif
                        </div>
                        <div class="rk-kelas-overlay position-absolute w-100 h-100"></div>
                    </div>
                    <br>
                    <div class="card-body">
                        <h5 class="card-title fw-bold rk-heading">
                            <a href="{{ route('kelas.detail', Crypt::encrypt($k->id)) }}" class="text-dark text-decoration-none">
                                {{ $k->name_kelas }}
                            </a>
                        </h5>
                        <p class="card-text text-muted rk-line-clamp-3">
                            {!! strip_tags($k->description_kelas) !!}
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
                                @if($k->type_kelas == 0)
                                <span class="text-success fw-bold">Gratis</span>
                                @elseif($k->type_kelas == 3)
                                <span class="text-primary fw-bold">Rp {{ number_format($k->harga, 0, ',', '.') }}</span>
                                @else
                                <span class="text-primary fw-bold">Berbayar</span>
                                @endif
                            </div>
                            <a href="{{ route('kelas.detail', Crypt::encrypt($k->id)) }}" class="btn btn-sm btn-outline-primary">
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
                    <h4 class="text-muted">Belum ada kursus yang diambil</h4>
                    <p class="text-muted">Mulai perjalanan belajar Anda dengan mengambil kursus pertama</p>
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

@endsection
