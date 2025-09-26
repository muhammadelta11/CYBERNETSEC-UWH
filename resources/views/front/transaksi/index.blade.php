@extends('layouts.front')
@section('content')
{{-- <section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Course Details</h2>
                        <p>Home<span>/</span>Course Details</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- breadcrumb start-->

<!--================ Start Course Details Area =================-->
<section class="course_details_area section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5">
                <div class="section_tittle text-center">
                    <h2>Upgrade Premium</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @php
            $id = Auth::user()->id;
            $cek = \App\Transaksi::where(['users_id' => $id]);
            @endphp

            @if ($cek->count() > 0 && $cek->first()->status == 1 && Auth::user()->role == 'premium')
            <div class="col-md-6 mx-auto text-center">
                <h4>Selamat Akun Anda Sudah Premium</h4>
            </div>
            @endif

            @if ($cek->count() > 0 && $cek->first()->status == 0)
            <div class="col-md-6 mx-auto text-center">
                <h4>Anda sudah mengirim bukti transfer, silahkan tunggu beberapa saat admin sedang mengkonfirmasi
                    pembayaranmu</h4>
            </div>
            @endif

            @if ($cek->count() > 0 && $cek->first()->status == 2)
            <div class="col-md-6 mx-auto">
                <h4>Pembayaran Anda Ditolak. Silakan kirim ulang bukti pembayaran</h4>
                <p class="mt-3">Nominal: Rp.{{ number_format($setting->harga,0,',','.') }}</p>
                <h5>Silahkan transfer ke no rekening di bawah ini</h5>
                <ul>
                    @foreach ($rekening as $item)
                    <li>- {{ $item->no_rekening }} a.n <b>{{ $item->atas_nama }}</b>
                        <button class="btn btn-sm btn-outline-secondary ml-2" onclick="copyToClipboard('{{ $item->no_rekening }}')">
                            <i class="fas fa-copy"></i> Salin
                        </button>
                    </li>
                    @endforeach
                </ul>
                <div class="mt-4">
                    <form action="{{ route('kirimnotifikasi') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> klik sini jika sudah kirim bukti pembayaran
                        </button>
                    </form>
                    <button class="btn btn-success" onclick="sendWhatsApp()">
                        <i class="fab fa-whatsapp"></i> Kirim via WhatsApp
                    </button>
                </div>
            </div>
            @endif

            @if($cek->count() < 1) <div class="col-md-6 mx-auto">
                @php
                    $setting = \App\Setting::first();
                    if (!$setting) {
                        $setting = new \stdClass();
                        $setting->harga = 0;
                    }
                @endphp
<h4>Silahkan transfer sebesar Rp.{{ number_format($setting->harga,0,',','.') }} ke no rekening di bawah ini</h4>
                <ul>
                    @foreach ($rekening as $item)
                    <li>- {{ $item->no_rekening }} a.n <b>{{ $item->atas_nama }}</b></li>
                    @endforeach
                </ul>
                <div class="mt-4">
                    <button class="btn btn-success" onclick="sendWhatsApp()">
                        <i class="fab fa-whatsapp"></i> Kirim Bukti Pembayaran via WhatsApp
                    </button>
                </div>
        </div>
        @endif
    </div>
    </div>
</section>

<script>
function sendWhatsApp() {
    @php
        $setting = \App\Setting::first();
        if (!$setting) {
            $setting = new \stdClass();
            $setting->harga = 0;
        }
    @endphp
    const message = `Halo Admin CyberNetSec UWH,

Saya {{ Auth::user()->name }} ingin mengirim bukti pembayaran untuk upgrade Premium.

Nominal: Rp.{{ number_format($setting->harga,0,',','.') }}

Silakan konfirmasi pembayaran saya.

Terima kasih.`;

    const encodedMessage = encodeURIComponent(message);
    const whatsappUrl = `https://wa.me/6285647121046?text=${encodedMessage}`; // Replace with admin WhatsApp number
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
<!--================ End Course Details Area =================-->
@endsection
