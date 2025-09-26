@extends('layouts.front')

@section('content')
<div class="container mt-5 pt-5 mb-3">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="rk-login-card">
                <div class="rk-login-header">
                    <div class="rk-login-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3>Masuk ke Akun Anda</h3>
                    <p class="mb-0">Selamat datang kembali! Silakan masuk untuk melanjutkan</p>
                </div>
                
                <div class="rk-login-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="mb-4">
                        <label for="login_field" class="form-label">NIM atau Email</label>
                            <div class="input-group">
                                <span class="input-group-text rk-input-group-text"><i class="fas fa-user"></i></span>
                                <input id="login_field" type="text" class="form-control rk-form-control @error('login_field') is-invalid @enderror"
                                       name="login_field" value="{{ old('login_field') }}" required autocomplete="username"
                                       autofocus placeholder="Masukkan NIM atau Email">
                            </div>
                            @error('login_field')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text rk-input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password" type="password" 
                                       class="form-control rk-form-control @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="current-password" 
                                       placeholder="Masukkan kata sandi">
                                <span class="input-group-text rk-password-toggle" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input rk-form-check-input" type="checkbox" name="remember" 
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                            
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-decoration-none">
                                Lupa Kata Sandi?
                            </a>
                            @endif
                        </div>
                        
                        <button type="submit" class="btn rk-btn-login mb-4">
                            <i class="fas fa-sign-in-alt me-2"></i> Masuk
                        </button>
                        
                        <div class="rk-login-footer">
                            <p class="mb-0">Belum punya akun? 
                                <a href="{{ route('register') }}">Daftar Sekarang</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rk-login-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .rk-login-card:hover {
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
    }
    
    .rk-login-header {
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        color: white;
        padding: 2.5rem 2rem;
        text-align: center;
    }
    
    .rk-login-icon {
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
    
    .rk-login-body {
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
    
    .rk-btn-login {
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
    
    .rk-btn-login:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
    }
    
    .rk-login-footer {
        text-align: center;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e1e5eb;
    }
    
    .rk-login-footer a {
        color: #4361ee;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .rk-login-footer a:hover {
        color: #3a0ca3;
        text-decoration: underline;
    }
    
    .rk-form-check-input:checked {
        background-color: #4361ee;
        border-color: #4361ee;
    }
    
    .rk-form-check-input:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
    }
    
    @media (max-width: 767.98px) {
        .rk-login-header {
            padding: 2rem 1.5rem;
        }
        
        .rk-login-body {
            padding: 2rem 1.5rem;
        }
        
        .rk-login-icon {
            width: 70px;
            height: 70px;
            font-size: 1.8rem;
        }
        
        .container.mt-5.pt-5.mb-3 {
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
    });
</script>
@endsection