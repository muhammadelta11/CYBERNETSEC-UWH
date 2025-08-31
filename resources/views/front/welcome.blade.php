@extends('layouts.front')
@section('content')

<section class="rk-hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-delay="100">
                <div class="rk-hero-content">
                    <h6 class="rk-text-accent mb-2"><i class="fas fa-graduation-cap me-2"></i>Official Research Hub</h6>
                    <h1 class="display-4 fw-bold mb-4 rk-heading">UNWAHAS <span class="rk-text-primary">CYBERNETSEC LABORATORY</span></h1>
                    <p class="lead mb-4 text-muted">Pusat riset dan inovasi di bidang Cyber Security, Artificial Intelligence, Network Engineering, dan Cloud Computing. Kami hadir untuk membangun masa depan teknologi digital yang lebih aman dan cerdas.</p>
                    <div class="d-flex flex-wrap gap-3 mb-4"> {{-- Tambah mb-4 untuk jarak --}}
                        <a href="{{ route('about') }}" class="rk-btn-primary">Tentang Kami</a>
                        <a href="#feature" class="btn btn-outline-primary d-flex align-items-center">
                            <i class="fas fa-play-circle me-2"></i> Riset Kami
                        </a>
                    </div>
                    <div class="d-flex flex-wrap gap-4 justify-content-center justify-content-lg-start"> {{-- Ganti mb-4 dengan gap-4 dan responsive justify --}}
                        <div class="text-center text-lg-start">
                            <h4 class="fw-bold mb-0 rk-heading">8+</h4>
                            <p class="text-muted mb-0">Proyek Riset</p>
                        </div>
                        <div class="text-center text-lg-start">
                            <h4 class="fw-bold mb-0 rk-heading">7+</h4>
                            <p class="text-muted mb-0">Anggota Aktif</p>
                        </div>
                        <div class="text-center text-lg-start">
                            <h4 class="fw-bold mb-0 rk-heading">5+</h4>
                            <p class="text-muted mb-0">Kolaborasi Industri</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                <div class="rk-hero-image position-relative text-center"> {{-- Tambah text-center untuk responsivitas --}}
                    <img src="{{ asset('frontemplate') }}/img/gallery/fotbar.png" alt="Hero Image" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="rk-section" id="feature"> {{-- Hapus py-5, sudah ada di .rk-section --}}
    <div class="container"> {{-- Hapus py-5, sudah ada di .rk-section --}}
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h2 class="fw-bold mb-3 rk-heading">Bidang Riset Utama</h2>
                <p class="text-muted">Fokus kami dalam pengembangan teknologi digital dan keamanan siber</p>
            </div>
        </div>
        <div class="row justify-content-center"> {{-- Tambah justify-content-center untuk tata letak di mobile --}}
            <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100"> {{-- col-md-6 agar 2 kolom di tablet --}}
                <div class="rk-card h-100 border-0 rk-shadow-hover">
                    <div class="card-body p-4 text-center">
                        <div class="rk-icon-wrapper bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                            <i class="fas fa-shield-alt fs-3 text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3 rk-heading">Cyber Security</h4>
                        <p class="text-muted">Proteksi sistem, jaringan, dan data dari ancaman digital modern.</p>
                        <div class="mt-4">
                            <span class="badge bg-primary">Akses Tanpa Batas</span> {{-- Gunakan class badge yang baru --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="rk-card h-100 border-0 rk-shadow-hover">
                    <div class="card-body p-4 text-center">
                        <div class="rk-icon-wrapper bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                            <i class="fas fa-brain fs-3 text-success"></i>
                        </div>
                        <h4 class="fw-bold mb-3 rk-heading">Artificial Intelligence & Cloud Computing</h4>
                        <p class="text-muted">Pemanfaatan AI untuk solusi inovatif di pendidikan & industri.</p>
                        <div class="mt-4">
                            <span class="badge bg-success">Daftar Gratis</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="rk-card h-100 border-0 rk-shadow-hover">
                    <div class="card-body p-4 text-center">
                        <div class="rk-icon-wrapper bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                            <i class="fas fa-network-wired fs-3 text-warning"></i>
                        </div>
                        <h4 class="fw-bold mb-3 rk-heading">Network Engineering</h4>
                        <p class="text-muted">Optimasi jaringan & keamanan untuk menunjang aktivitas digital.</p>
                        <div class="mt-4">
                            <span class="badge bg-warning">Fitur Eksklusif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="rk-section bg-light"> {{-- Hapus py-5 --}}
    <div class="container"> {{-- Hapus py-5 --}}
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <img src="{{ asset('frontemplate') }}/img/learning_img.png" alt="About Us" class="img-fluid rounded-3 shadow">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="ps-lg-5">
                    <h6 class="text-primary mb-2">Tentang Kami</h6>
                    <h2 class="fw-bold mb-4 rk-heading">Mencetak Inovasi Digital</h2>
                    @php
                    $setting = \App\Setting::first();
                    $aboutContent = $setting ? $setting->about : '<p class="text-muted">Unwahas Cybernetsec Lab adalah laboratorium riset resmi Universitas Wahid Hasyim Semarang yang berfokus pada keamanan jaringan, kecerdasan buatan, dan cloud computing. Kami menghubungkan akademisi, mahasiswa, dan industri dalam satu ekosistem riset kolaboratif.</p>';
                    @endphp
                    <div class="text-muted">{!! $aboutContent !!}</div> {{-- Wrap dalam div dengan text-muted --}}
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary p-2 rounded-circle me-3">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 rk-heading">Berbasis Riset Nyata</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary p-2 rounded-circle me-3">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 rk-heading">Kolaborasi Industri</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary p-2 rounded-circle me-3">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 rk-heading">Fokus Keamanan Digital</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary p-2 rounded-circle me-3">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 rk-heading">Didukung Akademisi & Mahasiswa</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="rk-section"> {{-- Hapus py-5 --}}
    <div class="container"> {{-- Hapus py-5 --}}
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h2 class="fw-bold mb-3 rk-heading">Materi Up Skill</h2>
                <p class="text-muted">Membangun masa depan teknologi digital yang lebih aman dan cerdas.</p>
            </div>
        </div>
        <div class="row justify-content-center"> {{-- Tambah justify-content-center untuk tata letak di mobile --}}
            @foreach ($kelas as $item)
            <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="rk-card course-card h-100 border-0 rk-shadow-hover">
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" class="card-img-top" alt="{{ $item->name_kelas }}" style="height: 200px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-3">
                            @if ($item->type_kelas == 0)
                            <span class="badge bg-success">Gratis</span>
                            @elseif($item->type_kelas == 1)
                            <span class="badge bg-primary">Regular</span>
                            @elseif($item->type_kelas == 2)
                            <span class="badge bg-warning">Premium</span>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="card-body">
                        <h5 class="card-title fw-bold rk-heading">{{ $item->name_kelas }}</h5>
                        <p class="card-text rk-line-clamp-3 text-muted">{!! strip_tags($item->description_kelas) !!}</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-primary fw-bold">Rp {{ number_format($item->harga_kelas, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('kelas.detail', Crypt::encrypt($item->id)) }}" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5" data-aos="fade-up"> {{-- Tambah mt-5 untuk jarak lebih --}}
            <a href="{{ route('kelas') }}" class="btn btn-outline-primary btn-lg">Lihat Semua Kelas <i class="fas fa-arrow-right ms-2"></i></a> {{-- Tambah btn-lg --}}
        </div>
    </div>
</section>

@endsection