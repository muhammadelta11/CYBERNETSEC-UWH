@extends('layouts.front')

@section('content')
<section class="section_padding">
    <div class="container">
        <h2>Dashboard Mahasiswa</h2>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card text-center p-3">
                    <h5>Total Kursus Diambil</h5>
                    <p class="display-4">{{ $totalKursus }}</p>
                    <a href="{{ route('kursus.diambil') }}" class="btn btn-primary">Lihat Kursus</a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center p-3">
                    <h5>Total Sertifikat</h5>
                    <p class="display-4">{{ $totalSertifikat }}</p>
                    <a href="{{ route('sertifikat.index') }}" class="btn btn-primary">Lihat Sertifikat</a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center p-3">
                    <h5>Event Registrations</h5>
                    <p class="display-4">{{ $totalEventRegistrations }}</p>
                    <a href="{{ route('event-registrations.index') }}" class="btn btn-primary">Kelola Events</a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center p-3">
                    <h5>Status Akun</h5>
                    <p class="display-4 text-capitalize">{{ auth()->user()->role }}</p>
                    <a href="{{ route('akun') }}" class="btn btn-primary">Kelola Akun</a>
                </div>
            </div>
        </div>

        @if($pendingPayments > 0)
        <div class="row mt-4">
            <div class="col-12">
                <div class="alert alert-warning">
                    <h5><i class="fas fa-exclamation-triangle"></i> Pembayaran Pending</h5>
                    <p>Anda memiliki {{ $pendingPayments }} pendaftaran event yang masih menunggu pembayaran. Silakan upload bukti pembayaran untuk menyelesaikan pendaftaran.</p>
                    <a href="{{ route('event-registrations.index') }}" class="btn btn-warning">Upload Bukti Pembayaran</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
