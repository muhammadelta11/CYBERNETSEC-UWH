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
                        <!-- Avatar and Basic Info -->
                        <div class="text-center mb-4">
                            <div class="rk-profile-avatar d-flex justify-content-center mb-3">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                     style="width: 100px; height: 100px; font-size: 2.5rem;">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <h4 class="mb-1 fw-bold">{{ Auth::user()->name }}</h4>
                            <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                        </div>

                        <!-- Profile Details Table -->
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="ps-0 py-2 fw-semibold text-muted" style="width: 30%;">Nama Lengkap</td>
                                        <td class="py-2">{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0 py-2 fw-semibold text-muted">Email</td>
                                        <td class="py-2">{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0 py-2 fw-semibold text-muted">Tipe Akun</td>
                                        <td class="py-2">
                                            @if(Auth::user()->role == 'admin')
                                                <span class="badge bg-danger">Administrator</span>
                                            @elseif(Auth::user()->role == 'premium')
                                                <span class="badge bg-warning text-dark">Premium</span>
                                            @else
                                                <span class="badge bg-primary">Regular</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if(Auth::user()->nim)
                                    <tr>
                                        <td class="ps-0 py-2 fw-semibold text-muted">NIM</td>
                                        <td class="py-2">{{ Auth::user()->nim }}</td>
                                    </tr>
                                    @endif
                                    @if(Auth::user()->angkatan)
                                    <tr>
                                        <td class="ps-0 py-2 fw-semibold text-muted">Angkatan</td>
                                        <td class="py-2">{{ Auth::user()->angkatan }}</td>
                                    </tr>
                                    @endif
                                    @if(Auth::user()->whatsapp)
                                    <tr>
                                        <td class="ps-0 py-2 fw-semibold text-muted">WhatsApp</td>
                                        <td class="py-2">{{ Auth::user()->whatsapp }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
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
<style>
    /* Dark Mode Styles for Account Page */
    [data-theme="dark"] .rk-kelas-hero {
        background-color: #1a1e22 !important;
    }

    [data-theme="dark"] .rk-kelas-hero .text-muted {
        color: #a0aec0 !important;
    }

    [data-theme="dark"] .rk-kelas-card {
        background-color: #2c3136 !important;
        color: #e2e8f0 !important;
    }

    [data-theme="dark"] .rk-kelas-card .text-muted {
        color: #a0aec0 !important;
    }

    [data-theme="dark"] .table td {
        color: #e2e8f0 !important;
    }

    [data-theme="dark"] .table .text-muted {
        color: #a0aec0 !important;
    }

    [data-theme="dark"] .rk-stat-number h3 {
        color: var(--rk-primary) !important;
    }

    [data-theme="dark"] .rk-stat-number small {
        color: #a0aec0 !important;
    }

    [data-theme="dark"] .btn-outline-primary {
        color: var(--rk-primary) !important;
        border-color: var(--rk-primary) !important;
    }

    [data-theme="dark"] .btn-outline-primary:hover {
        background-color: var(--rk-primary) !important;
        color: white !important;
    }

    [data-theme="dark"] .btn-outline-warning {
        color: #f6ad55 !important;
        border-color: #f6ad55 !important;
    }

    [data-theme="dark"] .btn-outline-warning:hover {
        background-color: #f6ad55 !important;
        color: white !important;
    }
</style>

@endsection
