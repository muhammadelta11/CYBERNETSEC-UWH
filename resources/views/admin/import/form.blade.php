@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        <a href="{{ route('admin.import') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Upload File CSV</h6>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>

                        @if(session('import_result'))
                            @php $result = session('import_result'); @endphp
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="card border-left-success">
                                        <div class="card-body">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Berhasil</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $result['success'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-left-danger">
                                        <div class="card-body">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Error</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $result['errors'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-left-warning">
                                        <div class="card-body">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Duplikat</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $result['duplicates'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(!empty($result['error_details']))
                                <div class="card border-left-danger mb-3">
                                    <div class="card-body">
                                        <h6 class="text-danger">Detail Error:</h6>
                                        <ul class="mb-0">
                                            @foreach($result['error_details'] as $error)
                                                <li class="text-sm">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            @if(!empty($result['duplicate_details']))
                                <div class="card border-left-warning mb-3">
                                    <div class="card-body">
                                        <h6 class="text-warning">Detail Duplikat:</h6>
                                        <ul class="mb-0">
                                            @foreach($result['duplicate_details'] as $duplicate)
                                                <li class="text-sm">{{ $duplicate }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('admin.import.mahasiswa') }}" method="POST" enctype="multipart/form-data" id="importForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="file" class="form-label font-weight-bold">Pilih File CSV</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('file') is-invalid @enderror" 
                                               id="file" name="file" accept=".csv" required>
                                        <label class="custom-file-label" for="file">Pilih file...</label>
                                    </div>
                                    @error('file')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Format yang didukung: CSV. Maksimal ukuran: 2MB
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label font-weight-bold">Template</label>
                                    <div>
                                        <a href="{{ route('admin.import.template') }}" class="btn btn-outline-info btn-sm">
                                            <i class="fas fa-download"></i> Download Template
                                        </a>
                                    </div>
                                    <small class="form-text text-muted">
                                        Download template untuk format yang benar
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="card border-left-info">
                                <div class="card-body">
                                    <h6 class="text-info mb-2">Format File CSV:</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Header yang diperlukan:</strong>
                                            <ul class="mb-2">
                                                <li><code>nama</code> - Nama lengkap mahasiswa</li>
                                                <li><code>nim</code> - Nomor Induk Mahasiswa</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Header opsional:</strong>
                                            <ul class="mb-2">
                                                <li><code>email</code> - Alamat email</li>
                                                <li><code>whatsapp</code> - Nomor WhatsApp</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <small class="text-muted">
                                        <strong>Catatan:</strong> Password default akan diset sama dengan NIM mahasiswa.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-upload"></i> Upload dan Import
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="resetForm()">
                                <i class="fas fa-redo"></i> Reset
                            </button>
                        </div>
                    </form>

                    <!-- Progress Bar -->
                    <div class="progress mb-3" id="progressBar" style="display: none;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" 
                             role="progressbar" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Custom file input
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'Pilih file...';
        const label = e.target.nextElementSibling;
        label.textContent = fileName;
    });

    // Form submission with progress
    document.getElementById('importForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        const progressBar = document.getElementById('progressBar');
        
        // Show progress bar
        progressBar.style.display = 'block';
        
        // Disable submit button
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupload...';
        
        // Simulate progress (since we can't track actual upload progress easily)
        let progress = 0;
        const interval = setInterval(() => {
            progress += Math.random() * 15;
            if (progress > 90) progress = 90;
            
            const progressBarInner = progressBar.querySelector('.progress-bar');
            progressBarInner.style.width = progress + '%';
        }, 200);
        
        // Clean up on form submission
        setTimeout(() => {
            clearInterval(interval);
        }, 5000);
    });
});

function resetForm() {
    document.getElementById('importForm').reset();
    document.querySelector('.custom-file-label').textContent = 'Pilih file...';
    document.getElementById('progressBar').style.display = 'none';
    document.getElementById('submitBtn').disabled = false;
    document.getElementById('submitBtn').innerHTML = '<i class="fas fa-upload"></i> Upload dan Import';
}
</script>
@endsection
