@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header-text-center">
                    <h4>Akun Menunggu Persetujuan</h4>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-clock fa-4x text-warning mb-3"></i>
                        <h5 class="card-title">Terima kasih telah mendaftar!</h5>
                        <p class="card-text">
                            Akun Anda telah berhasil dibuat dan sedang dalam proses peninjauan oleh administrator.
                            Anda akan menerima notifikasi melalui email setelah akun Anda disetujui.
                        </p>
                    </div>

                    <div class="alert alert-info" role="alert">
                        <strong>Informasi Penting:</strong>
                        <ul class="mb-0 mt-2 text-left">
                            <li>Proses persetujuan biasanya memakan waktu 1-2 hari kerja</li>
                            <li>Pastikan email yang Anda daftarkan dapat diakses</li>
                            <li>Jika ada pertanyaan, silakan hubungi administrator</li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt mr-2"></i>Kembali ke Halaman Login
                        </a>
                    </div>

                    <div class="mt-3">
                        <small class="text-muted">
                            Masalah dengan akun? <a href="https://wa.link/zhihdp">Hubungi Administrator</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
    }

    .card-header-text-center {
        text-align: center;
    }

    .fas.fa-clock {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }
</style>
@endpush
