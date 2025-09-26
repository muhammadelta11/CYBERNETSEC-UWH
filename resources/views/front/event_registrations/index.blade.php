@extends('layouts.front')

@section('content')
<section class="section_padding">
    <div class="container">
        <h2>Event Registrations</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if($registrations->isEmpty())
            <p>Anda belum mendaftar event apapun.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Status</th>
                        <th>Amount Paid</th>
                        <th>Payment Proof</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registrations as $registration)
                    <tr>
                        <td>{{ $registration->event->name_podcast }}</td>
                        <td>
                            @if($registration->status == 'confirmed')
                                <span class="badge badge-success">Confirmed</span>
                            @elseif($registration->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @else
                                <span class="badge badge-danger">{{ ucfirst($registration->status) }}</span>
                            @endif
                        </td>
                        <td>
                            @if($registration->amount_paid > 0)
                                Rp {{ number_format($registration->amount_paid, 0, ',', '.') }}
                            @else
                                Gratis
                            @endif
                        </td>
                        <td>
                            @if($registration->payment_proof)
                                <a href="{{ asset('storage/' . $registration->payment_proof) }}" target="_blank">Lihat Bukti</a>
                            @else
                                Belum ada
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('event-registrations.show', Crypt::encrypt($registration->id)) }}" class="btn btn-info btn-sm">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</section>
@endsection
