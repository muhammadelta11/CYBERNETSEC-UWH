@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header-text-center">
                    <h4>Akun Ditolak</h4>
                </div>
                <div class="card-body-text-center">
                    <div class="mb-4">
                        <i class="fas fa-times-circle fa-4x text-danger mb-3"></i>
                        <h5 class="card-title">Maaf, Akun Anda Ditolak</h5>
                        <p class="card-text">
                            Setelah ditinjau oleh administrator, akun Anda tidak dapat disetujui untuk saat ini.
                            Hal ini mungkin disebabkan oleh ketidaksesuaian dengan persyaratan yang berlaku.
                        </p>
                    </div>

                    <div class="alert alert-danger" role="alert">
                        <strong>Alasan Penolakan:</strong>
                        <ul class="mb-0 mt-2 text-left">
                            <li>Data yang Anda berikan tidak lengkap atau tidak valid</li>
                            <li>Tidak memenuhi kriteria yang ditetapkan</li>
                            <li>Ada masalah dengan verifikasi identitas</li>
                        </ul>
                    </div>

                    <div class="alert alert-info" role="alert">
                        <strong>Langkah Selanjutnya:</strong>
                        <ul class="mb-0 mt-2 text-left">
                            <li>Silakan hubungi administrator untuk informasi lebih lanjut</li>
                            <li>Anda dapat mencoba mendaftar ulang dengan data yang benar</li>
                            <li>Pastikan semua persyaratan terpenuhi sebelum mendaftar kembali</li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            <i class="fas fa-user-plus mr-2"></i>Daftar Ulang
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-secondary ml-2">
                            <i class="fas fa-sign-in-alt mr-2"></i>Kembali ke Login
                        </a>
                    </div>

                    <div class="mt-3">
                        <small class="text-muted">
                            Butuh bantuan? <a href="mailto:admin@cybernetsec-uwh.com">Hubungi Administrator</a>
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
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
        color: white;
        border: none;
    }

    .fas.fa-times-circle {
        animation: shake 2s infinite;
    }

    @keyframes shake {
        0%, 100% {
            transform: translateX(0);
        }
        25% {
            transform: translateX(-5px);
        }
        75% {
            transform: translateX(5px);
        }
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
</style>
@endpush
