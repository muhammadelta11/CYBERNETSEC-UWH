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

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.user.edit', Crypt::encrypt($user->id)) }}" class="btn btn-primary">Edit</a>
                    @if($user->role !== 'admin')
                    <a href="{{ route('admin.user.delete', Crypt::encrypt($user->id)) }}"
                        class="btn btn-danger"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</a>
                    @endif
                    <a href="{{ route('admin.user') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>WhatsApp</th>
                                <td>
                                    @if($user->whatsapp)
                                        <span class="text-success">{{ $user->whatsapp }}</span>
                                        <br>
                                        <button type="button"
                                                class="btn btn-success btn-sm mt-2"
                                                onclick="openWhatsAppModal('{{ $user->name }}', '{{ $user->whatsapp }}')">
                                            <i class="fab fa-whatsapp"></i> Chat via WhatsApp
                                        </button>
                                    @else
                                        <span class="text-muted">Belum diisi</span>
                                        <br>
                                        <small class="text-warning">User belum mengisi nomor WhatsApp</small>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Tipe User</th>
                                <td>{{ $user->role }}</td>
                            </tr>
                            <tr>
                                <th>NIM</th>
                                <td>{{ $user->nim ?? '-' }}</td>
                            </tr>
                            @if($user->isMahasiswa() && $user->semester)
                            <tr>
                                <th>Semester</th>
                                <td>{{ $user->semester }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Tanggal Registrasi</th>
                                <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Terakhir Login</th>
                                <td>{{ $user->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Kelas yang Diikuti</h5>
                        @if($user->kelas->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Nama Kelas</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->kelas as $kelas)
                                        <tr>
                                            <td>{{ $kelas->name_kelas }}</td>
                                            <td>
                                                @if($kelas->pivot->status == 'completed')
                                                    <span class="badge badge-success">Selesai</span>
                                                @else
                                                    <span class="badge badge-warning">Sedang Berlangsung</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">Belum mengikuti kelas apapun</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- WhatsApp Modal -->
<div class="modal fade" id="whatsappModal" tabindex="-1" role="dialog" aria-labelledby="whatsappModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
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
                        <textarea class="form-control" id="messageText" rows="4" placeholder="Ketik pesan Anda di sini...">Halo {{ $user->name }},

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

<script>
function openWhatsAppModal(name, phone) {
    document.getElementById('recipientName').value = name;
    document.getElementById('messageText').value = `Halo ${name},

Terima kasih telah bergabung dengan CyberNetSec UWH.

Salam hangat,
Admin CyberNetSec UWH`;

    $('#whatsappModal').modal('show');
}

function sendWhatsApp() {
    const phone = document.getElementById('recipientName').value;
    const message = document.getElementById('messageText').value;

    // Format nomor WhatsApp (pastikan diawali dengan 62)
    let formattedPhone = phone.replace(/[^0-9]/g, '');
    if (formattedPhone.startsWith('0')) {
        formattedPhone = '62' + formattedPhone.substring(1);
    } else if (formattedPhone.startsWith('62')) {
        formattedPhone = formattedPhone;
    } else {
        formattedPhone = '62' + formattedPhone;
    }

    // Encode pesan untuk URL
    const encodedMessage = encodeURIComponent(message);

    // Buka WhatsApp
    const whatsappUrl = `https://wa.me/${formattedPhone}?text=${encodedMessage}`;
    window.open(whatsappUrl, '_blank');

    // Tutup modal
    $('#whatsappModal').modal('hide');
}
</script>

@endsection
