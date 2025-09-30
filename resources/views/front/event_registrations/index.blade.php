@extends('layouts.front')

@section('content')
<div class="container mt-5 pt-5 mb-3">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="rk-registrations-card">
                <div class="rk-registrations-header">
                    <div class="rk-registrations-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>Pendaftaran Event</h3>
                    <p class="mb-0">Kelola semua pendaftaran event Anda</p>
                </div>

                <div class="rk-registrations-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($registrations->isEmpty())
                        <div class="rk-empty-state">
                            <i class="fas fa-calendar-alt fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada pendaftaran</h4>
                            <p class="text-muted">Anda belum mendaftar event apapun. Mulai jelajahi event menarik kami!</p>
                            <a href="{{ route('podcast.index') }}" class="btn rk-btn-primary">
                                <i class="fas fa-search me-2"></i>Jelajahi Event
                            </a>
                        </div>
                    @else
                        <div class="rk-registrations-table">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Event</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Pembayaran</th>
                                            <th scope="col">Bukti Bayar</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($registrations as $registration)
                                        <tr>
                                            <td>
                                                <div class="rk-event-name">
                                                    <strong>{{ $registration->event->name_podcast }}</strong>
                                                    @if($registration->event->event_date)
                                                        <br><small class="text-muted">
                                                            <i class="far fa-calendar me-1"></i>
                                                            {{ \Carbon\Carbon::parse($registration->event->event_date)->format('d M Y') }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if($registration->status == 'confirmed')
                                                    <span class="badge bg-success rk-status-badge">
                                                        <i class="fas fa-check me-1"></i>Dikonfirmasi
                                                    </span>
                                                @elseif($registration->status == 'pending')
                                                    <span class="badge bg-warning rk-status-badge">
                                                        <i class="fas fa-clock me-1"></i>Menunggu
                                                    </span>
                                                @elseif($registration->status == 'rejected')
                                                    <span class="badge bg-danger rk-status-badge">
                                                        <i class="fas fa-times me-1"></i>Ditolak
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary rk-status-badge">
                                                        {{ ucfirst($registration->status) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($registration->amount_paid > 0)
                                                    <span class="rk-payment-amount">
                                                        Rp {{ number_format($registration->amount_paid, 0, ',', '.') }}
                                                    </span>
                                                @else
                                                    <span class="text-success">
                                                        <i class="fas fa-gift me-1"></i>Gratis
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($registration->payment_proof)
                                                    <a href="{{ asset('storage/' . $registration->payment_proof) }}"
                                                       target="_blank" class="btn btn-sm btn-outline-primary rk-proof-btn">
                                                        <i class="fas fa-eye me-1"></i>Lihat
                                                    </a>
                                                @else
                                                    <span class="text-muted">
                                                        <i class="fas fa-minus me-1"></i>Belum ada
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('event-registrations.show', Crypt::encrypt($registration->id)) }}"
                                                   class="btn btn-sm rk-btn-detail">
                                                    <i class="fas fa-info-circle me-1"></i>Detail
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
