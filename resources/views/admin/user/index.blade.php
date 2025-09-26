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
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.import') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-file-import"></i> Import Mahasiswa
                        </a>
                        <a href="{{ route('admin.user.export', request()->query()) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-file-export"></i> Export CSV
                        </a>
                    @endif
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
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>WhatsApp</th>
                                            <th width="25%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $index => $item)
                                        <tr data-user-type="{{ $item->user_type }}" data-status="{{ $item->status }}">
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
                                                @if($item->role === 'admin')
                                                    <span class="badge badge-danger">
                                                        <i class="fas fa-crown"></i> Administrator
                                                    </span>
                                                @elseif($item->role === 'admin_upskill')
                                                    <span class="badge badge-primary">
                                                        <i class="fas fa-chalkboard-teacher"></i> Admin Upskill
                                                    </span>
                                                @elseif($item->role === 'operator')
                                                    <span class="badge badge-secondary">
                                                        <i class="fas fa-cogs"></i> Operator
                                                    </span>
                                                @elseif($item->role === 'premium')
                                                    <span class="badge badge-warning">
                                                        <i class="fas fa-star"></i> Premium
                                                    </span>
                                                @else
                                                    <span class="badge badge-light">
                                                        <i class="fas fa-user"></i> Regular
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
                                                @if($item->whatsapp)
                                                    <span class="badge badge-success">✓ Tersedia</span>
                                                    <br>
                                                    <small class="text-muted">{{ $item->whatsapp }}</small>
                                                @else
                                                    <span class="badge badge-light">Belum diisi</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.user.detail',Crypt::encrypt($item->id)) }}"
                                                        class="btn btn-warning btn-sm" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.user.edit',Crypt::encrypt($item->id)) }}"
                                                        class="btn btn-primary btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    @if($item->whatsapp)
                                                        <button type="button"
                                                                class="btn btn-success btn-sm"
                                                                onclick="openWhatsAppModal('{{ $item->name }}', '{{ $item->whatsapp }}')"
                                                                title="WhatsApp">
                                                            <i class="fab fa-whatsapp"></i>
                                                        </button>
                                                    @endif
                                                </div>

                                                <div class="btn-group mt-1" role="group">
                                                    @if($item->status === 'inactive')
                                                        <a href="{{ route('admin.user.approve', Crypt::encrypt($item->id)) }}"
                                                            class="btn btn-success btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menyetujui user ini?')"
                                                            title="Setujui">
                                                            <i class="fas fa-check"></i> Setujui
                                                        </a>
                                                        <a href="{{ route('admin.user.reject', Crypt::encrypt($item->id)) }}"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menolak user ini? User yang ditolak tidak akan bisa login ke sistem.')"
                                                            title="Tolak">
                                                            <i class="fas fa-times"></i> Tolak
                                                        </a>
                                                    @endif

                                                    @if($item->status === 'active' && $item->role !== 'admin')
                                                        <a href="{{ route('admin.user.deactivate', Crypt::encrypt($item->id)) }}"
                                                            class="btn btn-secondary btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menonaktifkan user ini? User yang dinonaktifkan tidak akan bisa login ke sistem.')"
                                                            title="Nonaktifkan">
                                                            <i class="fas fa-ban"></i>
                                                        </a>
                                                    @endif

                                                    @if($item->role !== 'admin')
                                                    <a href="{{ route('admin.user.delete',Crypt::encrypt($item->id)) }}"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    @endif
                                                </div>
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

<!-- WhatsApp Modal -->
<div class="modal fade" id="whatsappModal" tabindex="-1" role="dialog" aria-labelledby="whatsappModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="z-index: 1055;">
            <div class="modal-header">
                <h5 class="modal-title" id="whatsappModalLabel">Kirim Pesan WhatsApp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="whatsappForm">
                    <div class="form-group">
                        <label for="recipientName">Kepada:</label>
                        <input type="text" class="form-control" id="recipientName" readonly>
                    </div>
                    <div class="form-group">
                        <label for="messageText">Pesan:</label>
                        <textarea class="form-control" id="messageText" rows="4" placeholder="Ketik pesan Anda di sini...">Halo,

Terima kasih telah bergabung dengan CyberNetSec UWH.

Salam hangat,
Admin CyberNetSec UWH</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" onclick="sendWhatsApp()">
                    <i class="fab fa-whatsapp"></i> Kirim WhatsApp
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Backdrop Fix -->
<div class="modal-backdrop" id="modalBackdrop" style="z-index: 1050; display: none;"></div>

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

function openWhatsAppModal(name, phone) {
    currentPhoneNumber = phone;
    document.getElementById('recipientName').value = name;
    document.getElementById('messageText').value = `Halo ${name},

Terima kasih telah bergabung dengan CyberNetSec UWH.

Salam hangat,
Admin CyberNetSec UWH`;

    // Show backdrop first
    document.getElementById('modalBackdrop').style.display = 'block';

    // Show modal
    document.getElementById('whatsappModal').style.display = 'block';
    document.getElementById('whatsappModal').classList.add('show');

    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

function closeWhatsAppModal() {
    // Hide modal
    document.getElementById('whatsappModal').style.display = 'none';
    document.getElementById('whatsappModal').classList.remove('show');

    // Hide backdrop
    document.getElementById('modalBackdrop').style.display = 'none';

    // Restore body scroll
    document.body.style.overflow = 'auto';

    currentPhoneNumber = '';
}

function sendWhatsApp() {
    const name = document.getElementById('recipientName').value;
    const message = document.getElementById('messageText').value;
    const phone = currentPhoneNumber;

    // Format nomor WhatsApp (pastikan diawali dengan 62)
    let formattedNumber = phone.replace(/[^0-9]/g, '');
    if (formattedNumber.startsWith('0')) {
        formattedNumber = '62' + formattedNumber.substring(1);
    } else if (formattedNumber.startsWith('62')) {
        formattedNumber = formattedNumber;
    } else {
        formattedNumber = '62' + formattedNumber;
    }

    // Encode pesan untuk URL
    const encodedMessage = encodeURIComponent(message);

    // Buka WhatsApp
    const whatsappUrl = `https://wa.me/${formattedNumber}?text=${encodedMessage}`;
    window.open(whatsappUrl, '_blank');

    // Close modal
    closeWhatsAppModal();
}

// Close modal when clicking backdrop
document.getElementById('modalBackdrop').addEventListener('click', closeWhatsAppModal);

// Close modal when clicking close button
document.querySelector('#whatsappModal .close').addEventListener('click', closeWhatsAppModal);

// Close modal when clicking cancel button
document.querySelector('#whatsappModal .btn-secondary').addEventListener('click', closeWhatsAppModal);
</script>

<style>
/* Ensure modal appears above everything */
#whatsappModal {
    z-index: 1055;
}

#whatsappModal.show {
    display: block !important;
}

#modalBackdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

/* Fix for Bootstrap modal conflicts */
.modal-backdrop {
    z-index: 1040 !important;
}

.modal {
    z-index: 1050 !important;
}
</style>

@endsection
