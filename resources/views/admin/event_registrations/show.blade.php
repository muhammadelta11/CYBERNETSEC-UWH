@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Event Registration Details</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.event-registrations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>User Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td>{{ $registration->user->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $registration->user->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone:</strong></td>
                                    <td>{{ $registration->user->phone ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Event Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Event Name:</strong></td>
                                    <td>{{ $registration->event->name_podcast }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Event Date:</strong></td>
                                    <td>{{ $registration->event->event_date ? \Carbon\Carbon::parse($registration->event->event_date)->format('l, d F Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Event Time:</strong></td>
                                    <td>{{ $registration->event->event_time ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Location:</strong></td>
                                    <td>{{ $registration->event->location ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Registration Details</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Registration ID:</strong></td>
                                    <td>{{ $registration->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <span class="badge
                                            @if($registration->status == 'confirmed') badge-success
                                            @elseif($registration->status == 'pending') badge-warning
                                            @else badge-danger
                                            @endif">
                                            {{ ucfirst($registration->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Amount Paid:</strong></td>
                                    <td>
                                        @if($registration->amount_paid > 0)
                                            Rp {{ number_format($registration->amount_paid, 0, ',', '.') }}
                                        @else
                                            Free Event
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Registered At:</strong></td>
                                    <td>{{ $registration->registered_at->format('l, d F Y H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Payment Information</h5>
                            @if($registration->payment_proof)
                                <div class="mb-3">
                                    <strong>Payment Proof:</strong><br>
                                    <img src="{{ asset('storage/' . $registration->payment_proof) }}"
                                         alt="Payment Proof" class="img-fluid" style="max-width: 300px;">
                                </div>
                            @else
                                <p>No payment proof uploaded yet.</p>
                            @endif

                            @if($registration->status == 'pending' && $registration->amount_paid > 0)
                                <div class="mt-3">
                                    <form action="{{ route('admin.event-registrations.confirm-payment', Crypt::encrypt($registration->id)) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-check"></i> Confirm Payment
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.event-registrations.reject-payment', Crypt::encrypt($registration->id)) }}"
                                          method="POST" class="d-inline ml-2">
                                        @csrf
                                        <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to reject this payment?')">
                                            <i class="fas fa-times"></i> Reject Payment
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
