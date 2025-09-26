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
                <div class="rk-kelas-card rk-card h-100 border-0 rk-shadow-hover">
                    <div class="rk-kelas-thumb position-relative">
                        <div class="rk-sertifikat-placeholder d-flex align-items-center justify-content-center bg-primary text-white"
                             style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="text-center">
                                <i class="fas fa-certificate fa-3x mb-3"></i>
                                <h5 class="mb-0">Sertifikat</h5>
                            </div>
                        </div>
                        <div class="rk-kelas-badge position-absolute top-0 end-0 m-3">
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i>Completed
                            </span>
                        </div>
                        <!-- k<div class="rk-kelas-overlay position-absolute w-100 h-100"></div> -->
                    </div>
                    <br>
                    <div class="card-body">
                        <h5 class="card-title fw-bold rk-heading">
                            {{ $s->nama_sertifikat }}
                        </h5>
                        <p class="card-text text-muted">
                            <i class="fas fa-calendar-alt me-2"></i>Diterbitkan: {{ \Carbon\Carbon::parse($s->tanggal_diterbitkan)->format('d M Y') }}
                        </p>

                        <div class="rk-kelas-meta d-flex justify-content-between align-items-center mt-3">
                            <div class="rk-kelas-rating">
                                <small class="text-success">
                                    <i class="fas fa-award me-1"></i>
                                    <span class="fw-bold">Sertifikat Digital</span>
                                </small>
                            </div>
                            <div class="rk-kelas-students">
                                <small class="text-muted">
                                    <i class="fas fa-user-graduate me-1"></i> {{ Auth::user()->name }}
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="rk-kelas-price">
                                <small class="text-muted">
                                    <i class="fas fa-file-pdf me-1"></i>PDF Format
                                </small>
                            </div>
                            <a href="{{ URL::signedRoute('front.sertifikat.download', ['id' => Crypt::encrypt($s->id)]) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download me-1"></i>Download
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

@endsection
