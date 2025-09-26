@extends('layouts.front')

@section('content')

<!-- Hero Section -->
<section class="rk-kelas-hero bg-light">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-lg-8 mx-auto text-center">
                <div data-aos="fade-up">
                    <h1 class="display-5 fw-bold mb-3 rk-heading">Akun Saya</h1>
                    <p class="lead text-muted">Kelola informasi profil dan pengaturan akun Anda</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Account Section -->
<section class="rk-kelas-section py-5">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Profile Card -->
                <div class="rk-kelas-card rk-card border-0 rk-shadow-hover mb-5" data-aos="fade-up">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-3 text-center">
                                <div class="rk-profile-avatar mx-auto mb-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 80px; height: 80px; font-size: 2rem;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <h5 class="mb-0 fw-bold">{{ Auth::user()->name }}</h5>
                                <small class="text-muted">{{ Auth::user()->email }}</small>
                            </div>
                            <div class="col-md-9">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="rk-profile-info">
                                            <label class="form-label text-muted small mb-1">Nama Lengkap</label>
                                            <p class="mb-0 fw-semibold">{{ Auth::user()->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="rk-profile-info">
                                            <label class="form-label text-muted small mb-1">Email</label>
                                            <p class="mb-0 fw-semibold">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="rk-profile-info">
                                            <label class="form-label text-muted small mb-1">Tipe Akun</label>
                                            <p class="mb-0">
                                                @if(Auth::user()->role == 'admin')
                                                    <span class="badge bg-danger">Administrator</span>
                                                @elseif(Auth::user()->role == 'premium')
                                                    <span class="badge bg-warning text-dark">Premium</span>
                                                @else
                                                    <span class="badge bg-primary">Regular</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    @if(Auth::user()->nim)
                                    <div class="col-sm-6">
                                        <div class="rk-profile-info">
                                            <label class="form-label text-muted small mb-1">NIM</label>
                                            <p class="mb-0 fw-semibold">{{ Auth::user()->nim }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @if(Auth::user()->angkatan)
                                    <div class="col-sm-6">
                                        <div class="rk-profile-info">
                                            <label class="form-label text-muted small mb-1">Angkatan</label>
                                            <p class="mb-0 fw-semibold">{{ Auth::user()->angkatan }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @if(Auth::user()->whatsapp)
                                    <div class="col-sm-6">
                                        <div class="rk-profile-info">
                                            <label class="form-label text-muted small mb-1">WhatsApp</label>
                                            <p class="mb-0 fw-semibold">{{ Auth::user()->whatsapp }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row g-4">
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="rk-kelas-card rk-card h-100 border-0 rk-shadow-hover">
                            <div class="card-body text-center p-4">
                                <div class="rk-action-icon mb-3">
                                    <i class="fas fa-user-edit fa-3x text-primary"></i>
                                </div>
                                <h5 class="card-title fw-bold mb-3">Edit Profil</h5>
                                <p class="card-text text-muted mb-4">Perbarui informasi pribadi dan data akun Anda</p>
                                <a href="{{ route('akun.editprofil') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-edit me-2"></i>Edit Profil
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="rk-kelas-card rk-card h-100 border-0 rk-shadow-hover">
                            <div class="card-body text-center p-4">
                                <div class="rk-action-icon mb-3">
                                    <i class="fas fa-lock fa-3x text-warning"></i>
                                </div>
                                <h5 class="card-title fw-bold mb-3">Ubah Kata Sandi</h5>
                                <p class="card-text text-muted mb-4">Perbarui kata sandi untuk keamanan akun</p>
                                <a href="{{ route('akun.editkatasandi') }}" class="btn btn-outline-warning">
                                    <i class="fas fa-key me-2"></i>Ubah Kata Sandi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Statistics -->
                <div class="rk-kelas-card rk-card border-0 rk-shadow-hover mt-5" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-4">
                            <i class="fas fa-chart-bar me-2 text-primary"></i>Statistik Akun
                        </h5>
                        <div class="row g-4">
                            <div class="col-md-4 text-center">
                                <div class="rk-stat-number">
                                    <h3 class="text-primary mb-1">{{ Auth::user()->kelas ? Auth::user()->kelas->count() : 0 }}</h3>
                                    <small class="text-muted">Kursus Diambil</small>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="rk-stat-number">
                                    <h3 class="text-success mb-1">{{ Auth::user()->sertifikats ? Auth::user()->sertifikats->count() : 0 }}</h3>
                                    <small class="text-muted">Sertifikat</small>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="rk-stat-number">
                                    <h3 class="text-info mb-1">{{ Auth::user()->eventRegistrations ? Auth::user()->eventRegistrations->count() : 0 }}</h3>
                                    <small class="text-muted">Event Terdaftar</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Course Details Area =================-->
@endsection
