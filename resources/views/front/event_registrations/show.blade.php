@extends('layouts.front')

@section('content')
<section class="section_padding">
    <div class="container">
        <h2>Detail Pendaftaran Event</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>Event</th>
                <td>{{ $registration->event->name_podcast }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    @if($registration->status == 'confirmed')
                        <span class="badge badge-success">Confirmed</span>
                    @elseif($registration->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @else
                        <span class="badge badge-danger">{{ ucfirst($registration->status) }}</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Amount Paid</th>
                <td>
                    @if($registration->amount_paid > 0)
                        Rp {{ number_format($registration->amount_paid, 0, ',', '.') }}
                    @else
                        Gratis
                    @endif
                </td>
            </tr>
            <tr>
                <th>Payment Proof</th>
                <td>
                    @if($registration->payment_proof)
                        <a href="{{ asset('storage/' . $registration->payment_proof) }}" target="_blank">Lihat Bukti</a>
                    @else
                        Belum ada
                    @endif
                </td>
            </tr>
        </table>

        @if($registration->amount_paid > 0)
        <div class="mt-4">
            <h4>Kirim Bukti Pembayaran via WhatsApp</h4>
            @if($registration->status == 'rejected')
                <div class="alert alert-warning">
                    <strong>Bukti pembayaran sebelumnya ditolak.</strong> Silakan kirim bukti pembayaran yang baru via WhatsApp.
                </div>
            @elseif($registration->status == 'confirmed')
                <div class="alert alert-success">
                    <strong>Pembayaran sudah dikonfirmasi.</strong>
                </div>
            @else
                <div class="alert alert-info">
                    <strong>Silakan kirim bukti pembayaran via WhatsApp untuk konfirmasi.</strong>
                </div>
            @endif
            @if($registration->status != 'confirmed')
            <button class="btn btn-success" onclick="sendWhatsApp()">
                <i class="fab fa-whatsapp"></i> Kirim via WhatsApp
            </button>
            @endif
        </div>
        @endif

        <script>
        function sendWhatsApp() {
            const name = '{{ auth()->user()->name }}';
            const event = '{{ $registration->event->name_podcast }}';
            const amount = 'Rp {{ number_format($registration->amount_paid, 0, ",", ".") }}';

            const message = `Halo Admin,\n\nSaya ${name} telah melakukan pembayaran untuk event "${event}" sebesar ${amount}.\n\nBerikut adalah bukti pembayaran saya.`;

            // Assuming admin WhatsApp number, replace with actual
            const adminNumber = '6285647121046'; // Replace with actual admin number

            const whatsappUrl = `https://wa.me/${adminNumber}?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        }
        </script>

        <a href="{{ route('event-registrations.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Pendaftaran</a>
    </div>
</section>
@endsection
