@extends('layouts.admin')
@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.userlog.export', request()->query()) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-file-export"></i> Export CSV
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- Filter Tabs -->
                    <div class="mb-3">
                        <ul class="nav nav-pills" id="userTypeTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="all-tab" data-toggle="pill" href="#all" role="tab">
                                    <i class="fas fa-users"></i> Semua User
                                    <span class="badge badge-secondary ml-1">{{ $users->count() }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="mahasiswa-tab" data-toggle="pill" href="#mahasiswa" role="tab">
                                    <i class="fas fa-graduation-cap"></i> Mahasiswa
                                    <span class="badge badge-success ml-1">{{ $users->where('user_type', 'mahasiswa')->count() }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="umum-tab" data-toggle="pill" href="#umum" role="tab">
                                    <i class="fas fa-user-friends"></i> Umum
                                    <span class="badge badge-info ml-1">{{ $users->where('user_type', 'umum')->count() }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pending-tab" data-toggle="pill" href="#pending" role="tab">
                                    <i class="fas fa-clock"></i> Pending
                                    <span class="badge badge-warning ml-1">{{ $users->where('status', 'inactive')->count() }}</span>
                                </a>
                            </li>
                            @for($i = 1; $i <= 7; $i++)
                            <li class="nav-item">
                                <a class="nav-link" id="semester-{{ $i }}-tab" data-toggle="pill" href="#semester-{{ $i }}" role="tab">
                                    <i class="fas fa-graduation-cap"></i> Semester {{ $i }}
                                    <span class="badge badge-info ml-1">{{ $users->where('user_type', 'mahasiswa')->where('semester', $i)->count() }}</span>
                                </a>
                            </li>
                            @endfor
                        </ul>
                    </div>

                    <div class="tab-content" id="userTypeTabsContent">
                        <div class="tab-pane fade show active" id="all" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table align-items-center table-hover" id="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama User</th>
                                            <th>NIM/Email</th>
                                            <th>Semester</th>
                                            <th>Tipe User</th>
                                            <th>Status</th>

                                            <th width="25%">Kategori & Kelas yang Diambil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $index => $item)
                                        <tr data-user-type="{{ $item->user_type }}" data-status="{{ $item->status }}" data-semester="{{ $item->semester }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm mr-3">
                                                        @if($item->user_type === 'mahasiswa')
                                                            <div class="avatar-initial rounded-circle bg-success">
                                                                <i class="fas fa-graduation-cap"></i>
                                                            </div>
                                                        @else
                                                            <div class="avatar-initial rounded-circle bg-info">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <strong>{{ $item->name }}</strong>
                                                        @if($item->nim)
                                                            <br><small class="text-muted">Angkatan: {{ $item->angkatan }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($item->nim)
                                                    <strong>{{ $item->nim }}</strong>
                                                    <br><small class="text-muted">{{ $item->email }}</small>
                                                @else
                                                    {{ $item->email }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->isMahasiswa() && $item->semester)
                                                    {{ $item->semester }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->user_type === 'mahasiswa')
                                                    <span class="badge badge-success">
                                                        <i class="fas fa-graduation-cap"></i> Mahasiswa
                                                    </span>
                                                @else
                                                    <span class="badge badge-info">
                                                        <i class="fas fa-user-friends"></i> Umum
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->status === 'active')
                                                    <span class="badge badge-success">
                                                        <i class="fas fa-check-circle"></i> Aktif
                                                    </span>
                                                @elseif($item->status === 'inactive')
                                                    <span class="badge badge-warning">
                                                        <i class="fas fa-clock"></i> Pending
                                                    </span>
                                                @elseif($item->status === 'rejected')
                                                    <span class="badge badge-danger">
                                                        <i class="fas fa-times-circle"></i> Ditolak
                                                    </span>
                                                @else
                                                    <span class="badge badge-secondary">{{ ucfirst($item->status) }}</span>
                                                @endif
                                            </td>

                                            <td>
                                                @php
                                                    $categories = [];
                                                    foreach($item->kelas as $kelas) {
                                                        $categoryName = $kelas->upskillCategory ? $kelas->upskillCategory->name : 'Tanpa Kategori';
                                                        if (!isset($categories[$categoryName])) {
                                                            $categories[$categoryName] = [];
                                                        }
                                                        $categories[$categoryName][] = $kelas->name_kelas;
                                                    }
                                                @endphp
                                                @if(count($categories) > 0)
                                                    @foreach($categories as $category => $classes)
                                                    <strong>{{ $category }}:</strong> {{ implode(', ', $classes) }}<br>
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">Tidak ada kelas</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
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

<script>
let currentPhoneNumber = '';

// Tab filtering functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('#userTypeTabs .nav-link');
    const tableRows = document.querySelectorAll('tbody tr[data-user-type]');

    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();

            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('active'));

            // Add active class to clicked tab
            this.classList.add('active');

            const filter = this.getAttribute('href').substring(1); // Remove #

            tableRows.forEach(row => {
                const userType = row.getAttribute('data-user-type');
                const status = row.getAttribute('data-status');
                const semester = row.getAttribute('data-semester');

                let shouldShow = false;

                switch(filter) {
                    case 'all':
                        shouldShow = true;
                        break;
                    case 'mahasiswa':
                        shouldShow = userType === 'mahasiswa';
                        break;
                    case 'umum':
                        shouldShow = userType === 'umum';
                        break;
                    case 'pending':
                        shouldShow = status === 'inactive';
                        break;
                    case 'semester-1':
                        shouldShow = userType === 'mahasiswa' && semester == '1';
                        break;
                    case 'semester-2':
                        shouldShow = userType === 'mahasiswa' && semester == '2';
                        break;
                    case 'semester-3':
                        shouldShow = userType === 'mahasiswa' && semester == '3';
                        break;
                    case 'semester-4':
                        shouldShow = userType === 'mahasiswa' && semester == '4';
                        break;
                    case 'semester-5':
                        shouldShow = userType === 'mahasiswa' && semester == '5';
                        break;
                    case 'semester-6':
                        shouldShow = userType === 'mahasiswa' && semester == '6';
                        break;
                    case 'semester-7':
                        shouldShow = userType === 'mahasiswa' && semester == '7';
                        break;
                }

                if (shouldShow) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Update row numbers
            updateRowNumbers();
        });
    });
});

function updateRowNumbers() {
    const visibleRows = document.querySelectorAll('tbody tr[data-user-type]:not([style*="display: none"])');
    visibleRows.forEach((row, index) => {
        row.querySelector('td:first-child').textContent = index + 1;
    });
}
</script>

@endsection
