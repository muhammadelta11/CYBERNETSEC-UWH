@extends('layouts.front')

@section('content')
<div class="container mt-5 pt-5 mb-3">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="rk-register-card">
                <div class="rk-register-header">
                    <div class="rk-register-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Registrasi Akun</h3>
                    <p class="mb-0">Bergabung dengan komunitas pembelajaran!</p>
                </div>

                <div class="rk-register-body">
                    {{-- <form method="POST" action="{{ route('register.umum.submit') }}"> --}}
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
                            <small class="text-muted">Email akan digunakan sebagai username untuk login</small>
                        </div>

                        <div class="mb-4">
                            <label for="whatsapp" class="form-label">WhatsApp (Opsional)</label>
                            <div class="input-group">
                                <span class="input-group-text rk-input-group-text"><i class="fab fa-whatsapp"></i></span>
                                <input id="whatsapp" type="text" class="form-control rk-form-control @error('whatsapp') is-invalid @enderror"
                                    name="whatsapp" value="{{ old('whatsapp') }}" autocomplete="tel" placeholder="081234567890">
                            </div>
                            @error('whatsapp')
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

                        <div class="alert alert-warning mb-4">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Perhatian:</strong> Akun Anda akan menunggu persetujuan dari administrator sebelum dapat digunakan. Anda akan menerima notifikasi email setelah akun disetujui.
                        </div>

                        <button type="submit" class="btn rk-btn-register mb-4">
                            <i class="fas fa-users me-2"></i> Konfirmasi Registrasi
                        </button>

                        <div class="rk-register-footer Daftar">
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
    /* Dark mode improvements for register form */
    .rk-register-card {
        background: var(--rk-light);
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        transition: all 0.3s ease;
        color: var(--rk-dark);
        border: 1px solid var(--rk-secondary);
    }

    .rk-register-card:hover {
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        transform: translateY(-5px);
    }

    .rk-register-header {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        color: var(--rk-dark);
        padding: 2.5rem 2rem;
        text-align: center;
        border-bottom: 1px solid var(--rk-secondary);
    }

    .rk-register-icon {
        width: 80px;
        height: 80px;
        background-color: rgba(255, 255, 255, 0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2.2rem;
        color: var(--rk-dark);
    }

    .rk-register-body {
        padding: 2.5rem 2rem;
    }

    .rk-form-control {
        padding: 0.9rem 1.2rem;
        border-radius: 8px;
        border: 1px solid var(--rk-secondary);
        transition: all 0.3s;
        font-family: 'Inter', sans-serif;
        background-color: var(--rk-light);
        color: var(--rk-dark);
    }

    .rk-form-control:focus {
        border-color: var(--rk-primary);
        box-shadow: 0 0 0 0.3rem rgba(99, 102, 241, 0.4);
        background-color: var(--rk-light);
        color: var(--rk-dark);
    }

    .rk-input-group-text {
        background-color: var(--rk-light);
        border-radius: 8px 0 0 8px;
        border: 1px solid var(--rk-secondary);
        border-right: none;
        color: var(--rk-primary);
    }

    .rk-password-toggle {
        cursor: pointer;
        background-color: var(--rk-light);
        border: 1px solid var(--rk-secondary);
        border-left: none;
        border-radius: 0 8px 8px 0;
        color: #9ca3af;
    }

    .rk-btn-register {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        border: none;
        color: var(--rk-dark);
        padding: 0.9rem;
        border-radius: 8px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        transition: all 0.3s ease;
        width: 100%;
    }

    .rk-btn-register:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
    }

    .rk-register-footer {
        text-align: center;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--rk-secondary);
        color: var(--rk-dark);
    }

    .rk-register-footer a {
        color: var(--rk-primary);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .rk-register-footer a:hover {
        color: #4338ca;
        text-decoration: underline;
    }

    .rk-register-body label {
        color: var(--rk-dark);
        font-weight: 600;
    }

    .rk-form-control::placeholder {
        color: #9ca3af;
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
