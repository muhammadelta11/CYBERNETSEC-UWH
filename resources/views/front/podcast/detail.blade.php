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

<!--================ Start Event Details Area =================-->
<section class="course_details_area section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 course_details_left">
                <div class="main_image">
                    @if($podcast->thumbnail)
                        <img class="img-fluid" src="{{ asset('storage/' . $podcast->thumbnail) }}" alt="{{ $podcast->name_podcast }}">
                    @else
                        <img class="img-fluid" src="{{ asset('images/default-event.jpg') }}" alt="{{ $podcast->name_podcast }}">
                    @endif
                </div>
                <div class="content_wrapper">
                    <h4 class="title_top jadwal_event">{{ $podcast->name_podcast }}</h4>
                    <div class="event-details ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="event-info-item mb-3">
                                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                                    <strong>Tanggal:</strong>
                                    @if($podcast->event_date)
                                        {{ \Carbon\Carbon::parse($podcast->event_date)->format('l, d F Y') }}
                                    @else
                                        -
                                    @endif
                                </div>
                                <div class="event-info-item mb-3">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <strong>Waktu:</strong>
                                    {{ $podcast->event_time ?? '-' }}
                                </div>
                                <div class="event-info-item mb-3">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <strong>Lokasi:</strong>
                                    {{ $podcast->location ?? '-' }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="event-info-item mb-3">
                                    <i class="fas fa-user text-primary me-2"></i>
                                    <strong>Pembicara:</strong>
                                    {{ $podcast->speaker ?? '-' }}
                                </div>
                                <div class="event-info-item mb-3">
                                    <i class="fas fa-users text-primary me-2"></i>
                                    <strong>Kuota:</strong>
                                    {{ $podcast->max_participants ?? '-' }} peserta
                                </div>
                                <div class="event-info-item mb-3">
                                    <i class="fas fa-user-check text-primary me-2"></i>
                                    <strong>Jumlah Pendaftar:</strong>
                                    {{ $registrationCount ?? 0 }} peserta
                                </div>
                                <div class="event-info-item mb-3">
                                    <i class="fas fa-ticket-alt text-primary me-2"></i>
                                    <strong>Biaya:</strong>
                                    @if($podcast->registration_fee > 0)
                                        Rp {{ number_format($podcast->registration_fee, 0, ',', '.') }}
                                    @else
                                        Gratis
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="event-type-badge mt-3">
                            <span class="badge bg-{{ $podcast->event_type == 'online' ? 'success' : ($podcast->event_type == 'offline' ? 'primary' : 'warning') }} fs-6">
                                {{ ucfirst($podcast->event_type ?? 'Event') }}
                            </span>
                        </div>
                        @if($podcast->meeting_link && $podcast->event_type == 'online')
                            <div class="meeting-link mt-3">
                                <a href="{{ $podcast->meeting_link }}" target="_blank" class="btn btn-primary">
                                    <i class="fas fa-video me-2"></i>Join Meeting
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4 right-contents">
                <div class="sidebar_top mt-3">
                    <h4 class="mb-3">Deskripsi Event</h4>
                    <div class="event-description">
                        {!! $podcast->description_podcast !!}
                    </div>
                </div>
                <div class="event-registration mt-4">
                    @if($podcast->registration_fee > 0)
                        <div class="price-highlight text-center p-3 bg-light rounded">
                            <h5 class="text-success mb-0">Rp {{ number_format($podcast->registration_fee, 0, ',', '.') }}</h5>
                            <small class="text-muted">per peserta</small>
                        </div>
                    @else
                        <div class="price-highlight text-center p-3 bg-success text-white rounded">
                            <h5 class="mb-0">GRATIS</h5>
                            <small>Event ini tidak dipungut biaya</small>
                        </div>
                    @endif
                    <div class="mt-3">
                        @if($isRegistered)
                            @if($registration->status == 'confirmed')
                                <button class="btn btn-success w-100" disabled>
                                    <i class="fas fa-check me-2"></i>Terdaftar
                                </button>
                            @elseif($registration->status == 'pending')
                                <button class="btn btn-warning w-100" disabled>
                                    <i class="fas fa-clock me-2"></i>Menunggu Konfirmasi
                                </button>
                                @if($registration->amount_paid > 0)
                                    <a href="{{ route('event-registrations.index') }}" class="btn btn-primary w-100 mt-2">
                                        <i class="fas fa-upload me-2"></i>Upload Bukti Pembayaran
                                    </a>
                                @endif
                            @endif
                            <a href="{{ route('event-registrations.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                                <i class="fas fa-list me-2"></i>Lihat Semua Pendaftaran Event
                            </a>
                        @else
                            <button class="btn btn-primary w-100" onclick="registerEvent(event, '{{ Crypt::encrypt($podcast->id) }}')">
                                <i class="fas fa-calendar-check me-2"></i>Daftar Event
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Event Details Area =================-->

<style>
    .event-details {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-top: 20px;
    }

    .event-info-item {
        display: flex;
        align-items: center;
        font-size: 14px;
    }

    .event-info-item i {
        width: 20px;
    }

    .event-type-badge {
        margin-top: 15px;
    }

    .event-description {
        line-height: 1.6;
        color: #a4a4a4ff !important;
    }

    .event-type-badge span {
        color: #fff !important;
    }

    .price-highlight {
        border: 2px solid #28a745;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .meeting-link {
        margin-top: 15px;
    }

    .main_image img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 10px;
    }

.title_top.judul_event {
    color: #000000ff; /* Warna putih sedikit lebih lembut untuk tampilan yang lebih baik */
    font-weight: 600;
    margin-bottom: 15px;
}

    .sidebar_top {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .event-registration {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    @media (max-width: 768px) {
        .event-details .row > div {
            margin-bottom: 15px;
        }

        .main_image img {
            height: 200px;
        }
    }
</style>

<script>
    function registerEvent(event, eventId) {
        console.log('registerEvent called with eventId:', eventId);
        if (confirm('Apakah Anda yakin ingin mendaftar untuk event ini?')) {
            // Show loading state
            const button = event.currentTarget || event.target.closest('button');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mendaftarkan...';
            button.disabled = true;

            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                alert('CSRF token tidak ditemukan. Silakan refresh halaman.');
                button.innerHTML = originalText;
                button.disabled = false;
                return;
            }

            console.log('CSRF token:', csrfToken.getAttribute('content'));
            console.log('Making request to:', `/podcast/register/${eventId}`);

            // Make AJAX request
            fetch(`/podcast/register/${eventId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    alert(data.message);

                    if (data.requires_payment) {
                        // Redirect to payment page or show payment instructions
                        // For now, just refresh the page to show updated status
                        location.reload();
                    } else {
                        // Refresh page to show confirmed registration
                        location.reload();
                    }
                } else {
                    alert(data.message);

                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
            })
            .finally(() => {
                // Restore button state
                button.innerHTML = originalText;
                button.disabled = false;
            });
        }
    }
</script>

@endsection
