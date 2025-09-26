@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Import Data Mahasiswa</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Import Form -->
                        <div class="col-md-6">
                            <div class="card border-left-success">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Import dari File CSV
                                            </div>
                                            <div class="mb-3">
                                                <p class="text-gray-600 mb-2">Upload file CSV berisi data mahasiswa untuk registrasi otomatis.</p>
                                                <small class="text-muted">
                                                    Format yang didukung: CSV<br>
                                                    Maksimal ukuran file: 2MB
                                                </small>
                                            </div>
                                            <a href="{{ route('admin.import.form') }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-upload"></i> Mulai Import
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-csv fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Download Template -->
                        <div class="col-md-6">
                            <div class="card border-left-info">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Template CSV
                                            </div>
                                            <div class="mb-3">
                                                <p class="text-gray-600 mb-2">Download template CSV untuk format yang benar.</p>
                                                <small class="text-muted">
                                                    Template berisi header dan contoh data mahasiswa.
                                                </small>
                                            </div>
                                            <a href="{{ route('admin.import.template') }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-download"></i> Download Template
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-download fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Instructions -->
                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-gray-800 mb-3">Petunjuk Import Data Mahasiswa</h5>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card border-left-warning">
                                        <div class="card-body">
                                            <h6 class="text-warning">Format File CSV</h6>
                                            <ul class="text-sm text-gray-600 mb-0">
                                                <li>Header: <code>nama,nim,email,whatsapp</code></li>
                                                <li>Nama: Nama lengkap mahasiswa</li>
                                                <li>NIM: Nomor Induk Mahasiswa (unik)</li>
                                                <li>Email: Alamat email (unik)</li>
                                                <li>WhatsApp: Nomor WhatsApp (opsional)</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card border-left-primary">
                                        <div class="card-body">
                                            <h6 class="text-primary">Catatan Penting</h6>
                                            <ul class="text-sm text-gray-600 mb-0">
                                                <li>Akun mahasiswa akan langsung aktif</li>
                                                <li>Password default = NIM mahasiswa</li>
                                                <li>Data duplikat akan dilewati</li>
                                                <li>Validasi otomatis untuk setiap baris</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Imports (if any) -->
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-gray-800 mb-3">Data Mahasiswa Terbaru</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>NIM</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Tanggal Daftar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $recentMahasiswa = \App\User::where('user_type', 'mahasiswa')
                                                ->orderBy('created_at', 'desc')
                                                ->limit(5)
                                                ->get();
                                        @endphp
                                        
                                        @forelse($recentMahasiswa as $mahasiswa)
                                        <tr>
                                            <td>{{ $mahasiswa->name }}</td>
                                            <td>{{ $mahasiswa->nim }}</td>
                                            <td>{{ $mahasiswa->email }}</td>
                                            <td>
                                                <span class="badge badge-success">{{ $mahasiswa->status_display }}</span>
                                            </td>
                                            <td>{{ $mahasiswa->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Belum ada data mahasiswa</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
