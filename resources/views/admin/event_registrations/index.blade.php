@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Event Registrations</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Event</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Registered At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($registrations as $registration)
                                <tr>
                                    <td>{{ $registration->id }}</td>
                                    <td>{{ $registration->user->name }}</td>
                                    <td>{{ $registration->event->name_podcast }}</td>
                                    <td>
                                        <span class="badge
                                            @if($registration->status == 'confirmed') badge-success
                                            @elseif($registration->status == 'pending') badge-warning
                                            @else badge-danger
                                            @endif">
                                            {{ ucfirst($registration->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($registration->amount_paid > 0)
                                            Rp {{ number_format($registration->amount_paid, 0, ',', '.') }}
                                        @else
                                            Free
                                        @endif
                                    </td>
                                    <td>{{ $registration->registered_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.event-registrations.show', Crypt::encrypt($registration->id)) }}"
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        @if($registration->status == 'pending')
                                        <button class="btn btn-sm btn-success ml-1"
                                                onclick="updateStatus('{{ Crypt::encrypt($registration->id) }}', 'confirmed')">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                        <button class="btn btn-sm btn-danger ml-1"
                                                onclick="updateStatus('{{ Crypt::encrypt($registration->id) }}', 'cancelled')">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No registrations found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $registrations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateStatus(registrationId, status) {
    if (confirm('Are you sure you want to ' + (status === 'confirmed' ? 'approve' : 'reject') + ' this registration?')) {
        fetch(`/admin/event-registrations/${registrationId}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                status: status
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
}
</script>
@endsection
