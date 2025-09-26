@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }} {{ $podcast->name_podcast }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.podcast.edit',Crypt::encrypt($podcast->id)) }}" class="btn btn-warning">Edit</a>
                    <a href="javascript:void(0)" class="btn btn-danger"
                        onclick="alertconfirmn('{{ route('admin.podcast.hapus',Crypt::encrypt($podcast->id)) }}')">Hapus</a>
                    <button id="btn-back" class="btn btn-primary">
                        Kembali
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <td width="20%">Nama Event</td>
                                <td width="5%">:</td>
                                <td>{{ $podcast->name_podcast }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Event</td>
                                <td>:</td>
                                <td>{{ $podcast->event_date ? \Carbon\Carbon::parse($podcast->event_date)->format('d/m/Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Waktu Event</td>
                                <td>:</td>
                                <td>{{ $podcast->event_time ? str_replace(':', '.', $podcast->event_time) . ' WIB' : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>:</td>
                                <td>{{ $podcast->location ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td>Pembicara</td>
                                <td>:</td>
                                <td>{{ $podcast->speaker ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Maksimal Peserta</td>
                                <td>:</td>
                                <td>{{ $podcast->max_participants ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td>Biaya Pendaftaran</td>
                                <td>:</td>
                                <td>{{ $podcast->registration_fee ? 'Rp ' . number_format($podcast->registration_fee, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Tipe Event</td>
                                <td>:</td>
                                <td>{{ $podcast->event_type ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td>Link Meeting</td>
                                <td>:</td>
                                <td>{{ $podcast->meeting_link ? '<a href="' . $podcast->meeting_link . '" target="_blank">' . $podcast->meeting_link . '</a>' : '-' }}</td>
                            </tr>
                            @if($podcast->is_event)
                            <tr>
                                <td>Kuota</td>
                                <td>:</td>
                                <td>{{ $podcast->quota ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td>Pembukaan Pendaftaran</td>
                                <td>:</td>
                                <td>{{ $podcast->registration_open ? \Carbon\Carbon::parse($podcast->registration_open)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Penutupan Pendaftaran</td>
                                <td>:</td>
                                <td>{{ $podcast->registration_close ? \Carbon\Carbon::parse($podcast->registration_close)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Pendaftar</td>
                                <td>:</td>
                                <td>{{ \App\EventRegistration::where('podcast_id', $podcast->id)->count() }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td style="vertical-align: top">Deskripsi</td>
                                <td style="vertical-align: top">:</td>
                                <td>{!! $podcast->description_podcast !!}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        @if($podcast->thumbnail)
                            <div class="text-center">
                                <h6>Poster Event</h6>
                                <img src="{{ asset('storage/' . $podcast->thumbnail) }}" alt="Poster Event" class="img-fluid" style="max-width: 100%; max-height: 300px;">
                            </div>
                        @elseif($podcast->url_podcast)
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/{{ $podcast->url_podcast }}"
                                    allowfullscreen></iframe>
                            </div>
                        @else
                            <div class="text-center">
                                <p>Tidak ada media</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection