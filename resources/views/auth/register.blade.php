@extends('layouts.front')

@section('content')
<div class="container mt-5 pt-3 mb-3">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="rk-register-selection-card">
                <div class="rk-register-header">
                    <div class="rk-register-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h2>Pilih Jenis Registrasi</h2>
                    <p class="mb-0">Pilih kategori yang sesuai dengan status Anda</p>
                </div>
                
                <div class="rk-register-body">
                    <div class="row">
                        <!-- Registrasi Umum -->
                        <div class="col-md-12 mb-4">
                            <div class="rk-user-type-card" onclick="window.location.href='{{ route('register.umum') }}'">
                                <div class="rk-user-type-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h4>Umum</h4>
                                <p class="text-muted mb-3">Untuk masyarakat umum yang ingin bergabung</p>
                                <ul class="rk-features-list">
                                    <li><i class="fas fa-clock text-warning"></i> Perlu approval admin</li>
                                    <li><i class="fas fa-check text-success"></i> Akses ke kelas terbuka</li>
                                    <li><i class="fas fa-check text-success"></i> Sertifikat partisipasi</li>
                                    <li><i class="fas fa-check text-success"></i> Komunitas belajar</li>
                                </ul>
                                <div class="rk-user-type-button">
                                    <span>Daftar sebagai Umum</span>
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="rk-register-footer">
                        <p class="mb-0">Sudah punya akun? 
                            <a href="{{ route('login') }}">Masuk Sekarang</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rk-register-selection-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .rk-register-header {
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        color: white;
        padding: 2.5rem 2rem;
        text-align: center;
    }
    
    .rk-register-header h2 {
        color: #ffffff;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .rk-register-header p {
        color: rgba(255, 255, 255, 0.85);
        font-weight: 400;
    }

    .rk-register-icon {
        width: 80px;
        height: 80px;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2.2rem;
    }
    
    .rk-register-body {
        padding: 2.5rem 2rem;
    }

    .rk-user-type-card {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .rk-user-type-card:hover {
        border-color: #4361ee;
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(67, 97, 238, 0.15);
    }

    .rk-user-type-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 1.8rem;
        color: white;
    }

    .rk-user-type-card h4 {
        color: #212529;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .rk-features-list {
        list-style: none;
        padding: 0;
        margin: 1.5rem 0;
        flex-grow: 1;
    }

    .rk-features-list li {
        padding: 0.5rem 0;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    .rk-features-list li i {
        margin-right: 0.5rem;
        width: 16px;
    }

    .rk-user-type-button {
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        color: white;
        padding: 1rem;
        border-radius: 8px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
    }

    .rk-user-type-card:hover .rk-user-type-button {
        background: linear-gradient(135deg, #3a0ca3 0%, #2d0a87 100%);
    }
    
    .rk-register-footer {
        text-align: center;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e1e5eb;
    }
    
    .rk-register-footer a {
        color: #4361ee;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .rk-register-footer a:hover {
        color: #3a0ca3;
        text-decoration: underline;
    }
    
    @media (max-width: 767.98px) {
        .rk-register-header {
            padding: 2rem 1.5rem;
        }
        
        .rk-register-body {
            padding: 2rem 1.5rem;
        }
        
        .rk-register-icon {
            width: 70px;
            height: 70px;
            font-size: 1.8rem;
        }

        .rk-user-type-card {
            margin-bottom: 1.5rem;
        }
    }
</style>
@endsection
