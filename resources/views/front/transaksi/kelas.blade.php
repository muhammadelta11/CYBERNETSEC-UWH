@extends('layouts.front')
@section('content')
<section class="course_details_area section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section_tittle text-center">
                    <h2>Review Kelas</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @php
            $id = Auth::user()->id;
            $cek = \App\Transaksi::where(['users_id' => $id, 'kelas_id' => $kelas->id]);
            @endphp

            @if ($cek->count() > 0 && $cek->first()->status == 1)
            <div class="col-md-8 mx-auto text-center">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="text-success">Selamat! Anda sudah terdaftar di kelas ini</h4>
                        <p>Anda dapat mengakses materi kelas kapan saja.</p>
                        <a href="{{ route('kelas.belajar',[
                                    'id' => Crypt::encrypt($kelas->id),
                                    'idmateri' => Crypt::encrypt($kelas->materi[0]->id)
                                ]) }}" class="btn btn-primary">Akses Kelas</a>
                    </div>
                </div>
            </div>
            @else
            <div class="col-lg-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">{{ $kelas->name_kelas }}</h4>
                        <small>Kategori: {{ $kelas->upskillCategory->name }}</small>
                        <small class="d-block mt-1">{{ Str::limit($kelas->upskillCategory->deskripsi ?? 'Tidak ada deskripsi', 100) }}</small>
                    </div>
                    <div class="card-body">
                        <!-- Gambar Kelas -->
                        <div class="text-center mb-4">
                            @if($kelas->thumbnail)
                            <img src="{{ asset('storage/' . $kelas->thumbnail) }}" class="img-fluid rounded shadow" alt="{{ $kelas->name_kelas }}" style="max-height: 300px; width: 100%; object-fit: cover;">
                            @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 250px;">
                                <i class="fas fa-image fa-4x text-muted"></i>
                            </div>
                            @endif
                        </div>

                        <!-- Informasi Kelas -->
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-primary mb-3"><i class="fas fa-book-open"></i> Deskripsi Kelas</h5>
                                <p class="text-justify">{!! $kelas->description_kelas !!}</p>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-tag text-success mr-2"></i>
                                            <strong>Harga:</strong>
                                        </div>
                                        <span class="h4 text-success font-weight-bold">Rp {{ number_format($kelas->harga, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-clock text-info mr-2"></i>
                                            <strong>Durasi:</strong>
                                        </div>
                                        <span class="h6">{{ $kelas->durasi ?? 'Belum ditentukan' }}</span>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-layer-group text-warning mr-2"></i>
                                            <strong>Kategori:</strong>
                                        </div>
                                        <span>{{ $kelas->upskillCategory->name }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-info-circle text-secondary mr-2"></i>
                                            <strong>Detail Kategori:</strong>
                                        </div>
                                        <span class="small">{{ Str::limit($kelas->upskillCategory->deskripsi ?? 'Tidak ada deskripsi', 100) }}</span>
                                    </div>
                                </div>

                                @if($cek->count() > 0 && $cek->first()->status == 0)
                                <div class="alert alert-info mt-4">
                                    <i class="fas fa-clock"></i> <strong>Menunggu Konfirmasi:</strong> Anda sudah mengirim notifikasi pendaftaran. Silakan tunggu konfirmasi dari admin.
                                </div>
                                @elseif($cek->count() > 0 && $cek->first()->status == 2)
                                <div class="alert alert-warning mt-4">
                                    <i class="fas fa-exclamation-triangle"></i> <strong>Pendaftaran Ditolak:</strong> Pendaftaran Anda ditolak. Silakan daftar ulang.
                                </div>
                                @endif

                                <div class="mt-4 text-center">
                                    @if($cek->count() < 1 || ($cek->count() > 0 && $cek->first()->status == 2))
                                    <form action="{{ route('transaksi.kelas.kirim', $kelas->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-lg px-5 py-3">
                                            <i class="fas fa-user-plus"></i> Daftar Sekarang
                                        </button>
                                    </form>
                                    @else
                                    <button class="btn btn-secondary btn-lg px-5 py-3" disabled>
                                        <i class="fas fa-clock"></i> Menunggu Konfirmasi
                                    </button>
                                    @endif
                                    <a href="{{ route('upskill') }}" class="btn btn-outline-primary btn-lg px-4 py-3 ml-2">
                                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Kelas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<script>
function sendWhatsApp() {
    const message = `Halo Admin CyberNetSec UWH,

Saya {{ Auth::user()->name }} ingin mengirim bukti pembayaran untuk kelas {{ $kelas->name_kelas }}.

Nominal: Rp.{{ number_format($kelas->harga,0,',','.') }}

Silakan konfirmasi pembayaran saya.

Terima kasih.`;

    const encodedMessage = encodeURIComponent(message);
    const whatsappUrl = `https://wa.me/6281234567890?text=${encodedMessage}`; // Replace with admin WhatsApp number
    window.open(whatsappUrl, '_blank');
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Nomor rekening berhasil disalin: ' + text);
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>
@endsection
