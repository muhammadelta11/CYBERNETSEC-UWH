@extends('layouts.front')
@section('content')
<section class="course_details_area section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section_tittle text-center">
                    <h2>Daftar Kelas {{ $kelas->name_kelas }}</h2>
                    <p>Halaman ini akan ditutup setelah anda meninggalkannya</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Informasi Pembayaran</h4>
                        <small>Transfer sebesar Rp.{{ number_format($kelas->harga, 0, ',', '.') }} untuk kelas {{ $kelas->name_kelas }}</small>
                    </div>
                    <div class="card-body">
                        <h5>Transfer ke Rekening Berikut:</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($rekening as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item->payment_type == 'bank_transfer' ? 'Bank Transfer' : ucfirst(str_replace('_', ' ', $item->payment_type)) }}</strong><br>
                                    <small>{{ $item->no_rekening }} a.n {{ $item->atas_nama }}</small>
                                </div>
                                <button class="btn btn-sm btn-outline-secondary" onclick="copyToClipboard('{{ $item->no_rekening }}')">
                                    <i class="fas fa-copy"></i> Salin
                                </button>
                            </li>
                            @endforeach
                        </ul>

                        <div class="mt-4 text-center">
                            <form action="{{ route('transaksi.kelas.kirim', $kelas->id) }}" method="POST" style="display: inline-block; margin-right: 10px;">
                                @csrf
                            </form>
                            <button class="btn btn-success btn-lg" onclick="sendWhatsApp()">
                                <i class="fab fa-whatsapp"></i> Kirim via WhatsApp
                            </button>
                        </div>

                        <div class="alert alert-info mt-4">
                            <i class="fas fa-info-circle"></i> Silahkan kirim bukti transfer melalui WhatsApp Tersebut, tunggu hingga admin mengkonfirmasi pendaftaran Anda.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function sendWhatsApp() {
    const message = `Halo Admin CyberNetSec UWH,

Saya {{ Auth::user()->name }} ({{ Auth::user()->email }}) ingin mendaftar kelas {{ $kelas->name_kelas }}.

Nominal yang akan ditransfer: Rp.{{ number_format($kelas->harga,0,',','.') }}

Saya akan transfer ke salah satu rekening berikut:
@foreach ($rekening as $item)
- {{ ucfirst(str_replace('_', ' ', $item->payment_type)) }}: {{ $item->no_rekening }} a.n {{ $item->atas_nama }}
@endforeach

Mohon konfirmasi pendaftaran saya setelah transfer selesai.

Terima kasih.`;

    const encodedMessage = encodeURIComponent(message);
    const whatsappUrl = `https://wa.me/6281234567890?text=${encodedMessage}`; // Ganti dengan nomor WA admin
    window.open(whatsappUrl, '_blank');
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Nomor rekening berhasil disalin!');
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>
@endsection
