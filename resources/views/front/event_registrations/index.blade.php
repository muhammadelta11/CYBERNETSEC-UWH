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

                <div class="rk-registrations-body p-4">
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

<style>
    /* Dark Mode Styles */
    @media (prefers-color-scheme: dark) {
        .rk-registrations-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid #334155;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3), 0 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
        }

        .rk-registrations-header {
            border-bottom: 1px solid #374151;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }

        .rk-registrations-icon {
            color: #60a5fa;
            filter: drop-shadow(0 0 8px rgba(96, 165, 250, 0.3));
        }

        .rk-registrations-header h3 {
            color: #f1f5f9;
            font-weight: 700;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        }

        .rk-registrations-header p {
            color: #cbd5e1;
        }

        .rk-registrations-body {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }

        .rk-empty-state {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .rk-empty-state i {
            color: #64748b;
            filter: drop-shadow(0 0 10px rgba(100, 116, 139, 0.2));
        }

        .rk-empty-state h4,
        .rk-empty-state p {
            color: #cbd5e1;
        }

        .rk-btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border: none;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }

        .rk-btn-primary:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            transform: translateY(-2px);
        }

        .rk-registrations-table .table {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .rk-registrations-table thead th {
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
            color: #f1f5f9;
            border-bottom: 1px solid #4b5563;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        }

        .rk-registrations-table tbody tr {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-bottom: 1px solid #374151;
            transition: all 0.3s ease;
        }

        .rk-registrations-table tbody tr:hover {
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-1px);
        }

        .rk-registrations-table tbody td {
            color: #e2e8f0;
            border-bottom: 1px solid #374151;
            vertical-align: middle;
        }

        .rk-event-name strong {
            color: #f1f5f9;
        }

        .rk-status-badge {
            font-weight: 600;
            padding: 0.5em 0.75em;
            border-radius: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .rk-status-badge:hover {
            transform: scale(1.05);
        }

        .rk-payment-amount {
            color: #fbbf24;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        }

        .rk-proof-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            transition: all 0.3s ease;
        }

        .rk-proof-btn:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            transform: translateY(-2px);
        }

        .rk-btn-detail {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            border: none;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
            transition: all 0.3s ease;
        }

        .rk-btn-detail:hover {
            background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
            box-shadow: 0 6px 20px rgba(107, 114, 128, 0.4);
            transform: translateY(-2px);
        }

        .text-success {
            color: #10b981 !important;
        }

        .text-muted {
            color: #9ca3af !important;
        }

        .alert-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: 1px solid #059669;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
        }

        .alert-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: 1px solid #dc2626;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.2);
        }
    }

    /* Light Mode Improvements */
    @media (prefers-color-scheme: light) {
        .rk-registrations-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        /* Form elements light mode */
        input, select, textarea {
            background-color: #ffffff;
            color: #1f2937;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
            transition: border-color 0.3s ease;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        label {
            color: #374151;
            font-weight: 600;
        }

        button, .btn {
            background-color: #3b82f6;
            color: #ffffff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover, .btn:hover {
            background-color: #2563eb;
        }

        .rk-registrations-header {
            border-bottom: 1px solid #d1d5db;
            background: #f9fafb;
        }

        .rk-registrations-icon {
            color: #3b82f6;
            filter: none;
        }

        .rk-registrations-header h3 {
            color: #1f2937;
            font-weight: 700;
            text-shadow: none;
        }

        .rk-registrations-header p {
            color: #4b5563;
        }

        .rk-registrations-body {
            background: #ffffff;
        }

        .rk-empty-state {
            background: #f9fafb;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .rk-empty-state i {
            color: #6b7280;
            filter: none;
        }

        .rk-empty-state h4,
        .rk-empty-state p {
            color: #374151;
        }

        .rk-btn-primary {
            background: #3b82f6;
            border: none;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }

        .rk-btn-primary:hover {
            background: #2563eb;
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            transform: translateY(-2px);
        }

        .rk-registrations-table .table {
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .rk-registrations-table thead th {
            background: #f3f4f6;
            color: #1f2937;
            border-bottom: 1px solid #d1d5db;
            font-weight: 600;
            text-shadow: none;
        }

        .rk-registrations-table tbody tr {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .rk-registrations-table tbody tr:hover {
            background: #f3f4f6;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transform: translateY(-1px);
        }

        .rk-registrations-table tbody td {
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        .rk-event-name strong {
            color: #1f2937;
        }

        .rk-status-badge {
            font-weight: 600;
            padding: 0.5em 0.75em;
            border-radius: 20px;
            box-shadow: none;
            transition: all 0.3s ease;
        }

        .rk-status-badge:hover {
            transform: scale(1.05);
        }

        .rk-payment-amount {
            color: #b45309;
            font-weight: 600;
            text-shadow: none;
        }

        .rk-proof-btn {
            background: #10b981;
            border: none;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            transition: all 0.3s ease;
        }

        .rk-proof-btn:hover {
            background: #059669;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            transform: translateY(-2px);
        }

        .rk-btn-detail {
            background: #6b7280;
            border: none;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
            transition: all 0.3s ease;
        }

        .rk-btn-detail:hover {
            background: #4b5563;
            box-shadow: 0 6px 20px rgba(107, 114, 128, 0.4);
            transform: translateY(-2px);
        }

        .text-success {
            color: #10b981 !important;
        }

        .text-muted {
            color: #6b7280 !important;
        }

        .alert-success {
            background: #10b981;
            border: 1px solid #059669;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
        }

        .alert-danger {
            background: #ef4444;
            border: 1px solid #dc2626;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.2);
        }
    }
</style>
