@extends('layouts.front')
@section('content')

<!-- Hero Section -->
<section class="rk-learning-hero bg-light py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kelas') }}" class="text-decoration-none">Kelas</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kelas.detail', Crypt::encrypt($kelas->id)) }}" class="text-decoration-none">{{ $kelas->name_kelas }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Belajar</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Learning Section -->
<section class="rk-learning-section py-5">
    <div class="container">
        <div class="row">
            <!-- Video Player -->
            <div class="col-lg-8">
                <div class="rk-learning-content">
                    <!-- Materi Content -->
                    <div class="rk-materi-content mb-4" data-aos="fade-up">
                        @if($materi->type == 'video')
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/{{ $materi->url }}"
                                        allowfullscreen
                                        class="rounded-3 shadow"></iframe>
                            </div>
                        @elseif($materi->type == 'text')
                            <div class="rk-text-content bg-light p-4 rounded-3">
                                <div class="text-content-display">{!! $materi->content !!}</div>
                            </div>
                        @elseif($materi->type == 'document')
                            <div class="rk-document-content text-center p-4 bg-light rounded-3">
                                <i class="fas fa-file-alt fa-4x text-primary mb-3"></i>
                                <h5>{{ $materi->title }}</h5>
                                <p class="text-muted mb-4">Dokumen materi yang dapat dilihat</p>
                                <a href="{{ route('materi.download', ['id' => Crypt::encrypt($materi->id)]) }}" target="_blank" class="btn btn-primary">
                                    <i class="fas fa-eye me-2"></i> Lihat Dokumen
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Materi Info -->
                    <div class="rk-materi-info mb-5" data-aos="fade-up" data-aos-delay="100">
                        <h1 class="fw-bold mb-3 rk-heading">{{ $materi->title }}</h1>
                        
                        <div class="rk-materi-meta d-flex flex-wrap align-items-center gap-4 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clock text-primary me-2"></i>
                                <small class="text-muted">Durasi: 15:30</small>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <i class="fas fa-eye text-primary me-2"></i>
                                <small class="text-muted">250x Ditonton</small>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <i class="fas fa-graduation-cap text-primary me-2"></i>
                                <small class="text-muted">
                                    @php
                                        // Calculate current position safely
                                        $currentPosition = 1;
                                        $totalMateri = $kelas->materi->count();

                                        // Find current materi index if not provided
                                        if (!isset($currentIndex)) {
                                            $currentIndex = 0;
                                            foreach ($kelas->materi as $index => $item) {
                                                if ($item->id == $materi->id) {
                                                    $currentIndex = $index;
                                                    $currentPosition = $index + 1;
                                                    break;
                                                }
                                            }
                                        } else {
                                            $currentPosition = $currentIndex + 1;
                                        }
                                    @endphp
                                    Materi {{ $currentPosition }}/{{ $totalMateri }}
                                </small>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="rk-progress-container mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <small class="text-muted">Progress Belajar</small>
                                <small class="text-muted">
                                    @php
                                        // Calculate progress percentage based on completed materi
                                        $completedCount = count($completedMateri);
                                        $progress = $totalMateri > 0 ?
                                                   round(($completedCount / $totalMateri) * 100) : 0;
                                        $progress = min($progress, 100); // Ensure max 100%
                                    @endphp
                                    {{ $progress }}%
                                </small>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $progress }}%"
                                     aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <!-- Video Description -->
                        <div class="rk-video-description">
                            <h5 class="fw-bold mb-3">Deskripsi Materi</h5>
                            <div class="text-muted">
                                {!! $materi->content !!}
                            </div>
                        </div>

                        <!-- Mark as Completed Button -->
                        <div class="rk-completion-section mb-4">
                            @php
                                $isCompleted = in_array($materi->id, $completedMateri);
                            @endphp
                            @if(!$isCompleted)
                            <button id="markCompletedBtn" class="btn btn-success" onclick="markMateriCompleted({{ $materi->id }})">
                                <i class="fas fa-check me-2"></i> Tandai sebagai Selesai
                            </button>
                            @else
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                <div>Anda telah menyelesaikan materi ini!</div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="rk-navigation-buttons d-flex gap-3" data-aos="fade-up" data-aos-delay="200">
                        @php
                            // Find previous and next materi if not provided
                            if (!isset($prevMateri) || !isset($nextMateri)) {
                                $materiList = $kelas->materi;
                                $prevMateri = null;
                                $nextMateri = null;

                                foreach ($materiList as $index => $item) {
                                    if ($item->id == $materi->id) {
                                        if ($index > 0) {
                                            $prevMateri = $materiList[$index - 1];
                                        }
                                        if ($index < count($materiList) - 1) {
                                            $nextMateri = $materiList[$index + 1];
                                        }
                                        break;
                                    }
                                }
                            }
                        @endphp

                        @if($prevMateri)
                        <a href="{{ route('kelas.belajar', [
                            'id' => Crypt::encrypt($kelas->id),
                            'idmateri' => Crypt::encrypt($prevMateri->id)
                        ]) }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i> Sebelumnya
                        </a>
                        @endif

                        @if($nextMateri)
                        <a href="{{ route('kelas.belajar', [
                            'id' => Crypt::encrypt($kelas->id),
                            'idmateri' => Crypt::encrypt($nextMateri->id)
                        ]) }}" class="btn btn-primary ms-auto">
                            Selanjutnya <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                        @else
                        <button class="btn btn-success ms-auto" data-bs-toggle="modal" data-bs-target="#completionModal">
                            Selesaikan Kelas <i class="fas fa-trophy ms-2"></i>
                        </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <aside class="rk-learning-sidebar" data-aos="fade-left" data-aos-delay="300">
                    <!-- Course Info -->
                    <div class="rk-sidebar-card rk-card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Informasi Kelas</h6>
                            <ul class="list-unstyled">
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">Kelas</span>
                                    <span class="fw-medium">{{ $kelas->name_kelas }}</span>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">Tipe</span>
                                    <span class="fw-medium">
                                        @if ($kelas->type_kelas == 0)
                                        Gratis
                                        @elseif($kelas->type_kelas == 1)
                                        Regular
                                        @elseif($kelas->type_kelas == 2)
                                        Premium
                                        @endif
                                    </span>
                                </li>
                                <li class="d-flex justify-content-between py-2">
                                    <span class="text-muted">Progress</span>
                                    <span class="fw-medium text-primary">{{ $progress }}%</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Curriculum -->
                    <div class="rk-sidebar-card rk-card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Daftar Materi</h6>
                            <div class="rk-curriculum-list">
                                @foreach ($kelas->materi as $index => $item)
                                @php
                                    $isCurrent = $materi->id == $item->id;
                                    $isCompleted = in_array($item->id, $completedMateri);
                                @endphp
                                <div class="rk-curriculum-item mb-2">
                                    <a href="{{ route('kelas.belajar', [
                                        'id' => Crypt::encrypt($kelas->id),
                                        'idmateri' => Crypt::encrypt($item->id)
                                    ]) }}"
                                       class="d-flex align-items-center p-3 rounded-3 text-decoration-none {{ $isCurrent ? 'bg-primary text-white' : 'bg-light' }}">
                                        <div class="rk-item-icon me-3">
                                            @if($isCurrent)
                                            <i class="fas fa-play-circle fa-lg"></i>
                                            @elseif($isCompleted)
                                            <i class="fas fa-check-circle text-success fa-lg"></i>
                                            @else
                                            <i class="fas fa-circle text-muted fa-lg"></i>
                                            @endif
                                        </div>
                                        <div class="rk-item-content flex-grow-1">
                                            <p class="mb-1 {{ $isCurrent ? 'text-white' : 'text-dark' }} fw-medium">
                                                {{ $item->title }}
                                            </p>
                                            <small class="{{ $isCurrent ? 'text-white-50' : 'text-muted' }}">
                                                15:30
                                            </small>
                                        </div>
                                        @if($isCompleted)
                                        <div class="rk-item-badge">
                                            <span class="badge bg-success">Selesai</span>
                                        </div>
                                        @endif
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                </aside>
            </div>
        </div>
    </div>
</section>

<!-- Completion Modal -->
<div class="modal fade" id="completionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Selamat!</h5>
                <button type="button" class="btn-close" data-bs dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="rk-completion-icon mb-4">
                    <i class="fas fa-trophy text-warning" style="font-size: 4rem;"></i>
                </div>
                <h4 class="fw-bold mb-3">Anda telah menyelesaikan kelas!</h4>
                <p class="text-muted mb-4">
                    Selamat! Anda telah berhasil menyelesaikan semua materi dalam kelas 
                    <strong>{{ $kelas->name_kelas }}</strong>.
                </p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('kelas.detail', Crypt::encrypt($kelas->id)) }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>
                    <a href="{{ route('kelas') }}" class="btn btn-primary">
                        Lihat Kelas Lain <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Learning Hero */
    .rk-learning-hero {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        margin-top: -1px;
    }
    
    .rk-learning-hero .breadcrumb {
        margin-bottom: 0;
        padding: 0.75rem 0;
    }
    
    .rk-learning-hero .breadcrumb-item a {
        color: var(--rk-dark);
        transition: color 0.3s ease;
    }
    
    .rk-learning-hero .breadcrumb-item a:hover {
        color: var(--rk-primary);
    }
    
    .rk-learning-hero .breadcrumb-item.active {
        color: var(--rk-primary);
    }
    
    /* Video Player */
    .rk-video-player iframe {
        border-radius: var(--rk-radius);
    }
    
    /* Video Info */
    .rk-video-info h1 {
        font-size: 1.8rem;
    }
    
    .rk-video-meta {
        color: #6c757d;
    }
    
    .rk-progress-container {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: var(--rk-radius);
    }
    
    /* Navigation Buttons */
    .rk-navigation-buttons .btn {
        border-radius: 50px;
        padding: 0.75rem 1.5rem;
    }
    
    /* Sidebar */
    .rk-sidebar-card {
        border-radius: var(--rk-radius);
    }
    
    .rk-curriculum-list {
        max-height: 400px;
        overflow-y: auto;
    }
    
    .rk-curriculum-item a {
        transition: all 0.3s ease;
    }
    
    .rk-curriculum-item a:hover {
        background: var(--rk-primary) !important;
        color: white !important;
    }
    
    .rk-curriculum-item a:hover .text-dark {
        color: white !important;
    }
    
    .rk-curriculum-item a:hover .text-muted {
        color: rgba(255, 255, 255, 0.7) !important;
    }
    
    /* Resources */
    .rk-resources-list a {
        transition: all 0.3s ease;
    }
    
    .rk-resources-list a:hover {
        background: var(--rk-primary) !important;
        color: white !important;
    }
    
    .rk-resources-list a:hover .text-dark {
        color: white !important;
    }
    
    /* Modal */
    .modal-content {
        border-radius: var(--rk-radius);
        border: none;
    }
    
    /* Responsive Design */
    @media (max-width: 991.98px) {
        .rk-learning-section {
            padding: 3rem 0;
        }
    }
    
    @media (max-width: 768px) {
        .rk-video-info h1 {
            font-size: 1.5rem;
        }
        
        .rk-video-meta {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem !important;
        }
        
        .rk-learning-sidebar {
            margin-top: 3rem;
        }
        
        .rk-navigation-buttons {
            flex-direction: column;
        }
        
        .rk-navigation-buttons .btn {
            width: 100%;
        }
    }
    
    @media (max-width: 576px) {
        .rk-learning-hero {
            padding: 1.5rem 0;
        }
        
        .rk-learning-section {
            padding: 2rem 0;
        }
    }
    
    /* Memastikan konten tidak tertutup oleh fixed navbar */
    .rk-learning-hero {
        padding-top: calc(80px + 1rem);
    }
    
    /* Scrollbar styling */
    .rk-curriculum-list::-webkit-scrollbar {
        width: 6px;
    }

    .rk-curriculum-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .rk-curriculum-list::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }

    .rk-curriculum-list::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>

<script>
function markMateriCompleted(materiId) {
    const btn = document.getElementById('markCompletedBtn');
    const originalText = btn.innerHTML;

    // Disable button and show loading
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Menyimpan...';

    // Send AJAX request
    fetch('{{ route("kelas.markCompleted") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            materi_id: materiId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload page to update progress
            location.reload();
        } else {
            alert('Terjadi kesalahan saat menyimpan progress.');
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan progress.');
        btn.disabled = false;
        btn.innerHTML = originalText;
    });
}
</script>

@endsection
