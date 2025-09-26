@extends('layouts.admin')

@section('title', 'Test Email Configuration')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Test Email Configuration</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="text-muted">
                                Gunakan form ini untuk menguji konfigurasi email. Email test akan dikirim menggunakan template notifikasi penolakan user.
                            </p>

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <i class="icon fas fa-check"></i> {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <i class="icon fas fa-ban"></i> {{ session('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.test-email.send') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="{{ old('email', 'test@cybernetsec-uwh.com') }}" required>
                                    <small class="form-text text-muted">
                                        Masukkan alamat email yang akan menerima email test. Gunakan email yang valid untuk testing.
                                    </small>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Kirim Email Test
                                </button>
                            </form>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Informasi Email</h3>
                                </div>
                                <div class="card-body">
                                    <p><strong>Template:</strong> UserRejectedNotification</p>
                                    <p><strong>Subject:</strong> Notifikasi: Akun Anda Ditolak</p>
                                    <p><strong>Content:</strong> Email dalam Bahasa Indonesia</p>
                                    <p><strong>Features:</strong></p>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success"></i> Personalized greeting</li>
                                        <li><i class="fas fa-check text-success"></i> Contact information</li>
                                        <li><i class="fas fa-check text-success"></i> Professional formatting</li>
                                        <li><i class="fas fa-check text-success"></i> Error handling</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Troubleshooting</h3>
                                </div>
                                <div class="card-body">
                                    <p>Jika email tidak terkirim:</p>
                                    <ol class="text-sm">
                                        <li>Periksa konfigurasi di <code>.env</code></li>
                                        <li>Pastikan SMTP credentials benar</li>
                                        <li>Cek firewall/antivirus</li>
                                        <li>Test dengan Gmail SMTP</li>
                                        <li>Periksa log Laravel</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert-dismissible').fadeOut();
    }, 5000);
});
</script>
@endpush
