@extends('layouts.front')

@section('content')
<div class="container mt-5 pt-3 mb-3">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="rk-register-card">
                <div class="rk-register-header">
                    <div class="rk-register-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h2>Buat Akun Baru</h2>
                    <p class="mb-0">Bergabunglah dengan komunitas Ruang Kelas dan mulai belajar</p>
                </div>
                
                <div class="rk-register-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text rk-input-group-text"><i class="fas fa-user"></i></span>
                                <input id="name" type="text" class="form-control rk-form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Masukkan nama lengkap">
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text rk-input-group-text"><i class="fas fa-envelope"></i></span>
                                <input id="email" type="email" class="form-control rk-form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="nama@gmail.com">
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text rk-input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password" type="password"
                                    class="form-control rk-form-control @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="new-password" placeholder="Buat kata sandi yang kuat">
                                <span class="input-group-text rk-password-toggle" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">Konfirmasi Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text rk-input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password-confirm" type="password" class="form-control rk-form-control" 
                                    name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi Anda">
                                <span class="input-group-text rk-password-toggle" id="toggleConfirmPassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn rk-btn-register mb-4">
                            <i class="fas fa-user-plus me-2"></i> Buat Akun
                        </button>
                        
                        <div class="rk-register-footer">
                            <p class="mb-0">Sudah punya akun? 
                                <a href="{{ route('login') }}">Masuk Sekarang</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rk-register-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .rk-register-card:hover {
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
    }
    
    .rk-register-header {
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        color: white;
        padding: 2.5rem 2rem;
        text-align: center;
    }
    
    /* Tambahan styling judul & keterangan */
    .rk-register-header h2 {
        color: #ffffff; /* putih bersih */
        font-weight: 600;
    }

    .rk-register-header p {
        color: rgba(255, 255, 255, 0.85); /* putih lembut/transparan */
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
    
    .rk-form-control {
        padding: 0.9rem 1.2rem;
        border-radius: 8px;
        border: 1px solid #e1e5eb;
        transition: all 0.3s;
        font-family: 'Inter', sans-serif;
    }
    
    .rk-form-control:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.15);
    }
    
    .rk-input-group-text {
        background-color: white;
        border-radius: 8px 0 0 8px;
        border: 1px solid #e1e5eb;
        border-right: none;
        color: #4361ee;
    }
    
    .rk-password-toggle {
        cursor: pointer;
        background-color: white;
        border: 1px solid #e1e5eb;
        border-left: none;
        border-radius: 0 8px 8px 0;
        color: #6c757d;
    }
    
    .rk-btn-register {
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        border: none;
        color: white;
        padding: 0.9rem;
        border-radius: 8px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        transition: all 0.3s ease;
        width: 100%;
    }
    
    .rk-btn-register:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
    }
    
    .rk-register-footer {
        text-align: center;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
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

    /* Tambahan revisi warna label & placeholder */
    .rk-register-body label {
        color: #212529;  /* lebih gelap */
        font-weight: 600;
    }

    .rk-form-control::placeholder {
        color: #6c757d;  /* abu-abu lembut */
        font-weight: 400;
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
        
        .container.mt-5.pt-3.mb-3 {
            margin-top: 2rem !important;
            padding-top: 2rem !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
        
        // Toggle confirm password visibility
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const confirmPasswordInput = document.getElementById('password-confirm');
            const icon = this.querySelector('i');
            
            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                confirmPasswordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>
@endsection