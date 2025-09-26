@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }}</h4>
                <div class="card-header-action">
                    <button id="btn-back" class="btn btn-primary">
                        Kembali
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.podcast.update',$id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Judul Event</label>
                        <input type="text" name="name_event"
                            class="form-control @error('name_event') is-invalid @enderror"
                            value="{{ old('name_event', $podcast->name_podcast) }}">
                        @error('name_event')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Event</label>
                        <input type="date" name="event_date"
                            class="form-control @error('event_date') is-invalid @enderror"
                            value="{{ old('event_date', $podcast->event_date) }}">
                        @error('event_date')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Waktu Event</label>
                        <input type="time" name="event_time"
                            class="form-control @error('event_time') is-invalid @enderror"
                            value="{{ old('event_time', $podcast->event_time) }}">
                        @error('event_time')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Lokasi Event</label>
                        <input type="text" name="location"
                            class="form-control @error('location') is-invalid @enderror"
                            value="{{ old('location', $podcast->location) }}" placeholder="Masukkan lokasi event">
                        @error('location')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Pembicara</label>
                        <input type="text" name="speaker"
                            class="form-control @error('speaker') is-invalid @enderror"
                            value="{{ old('speaker', $podcast->speaker) }}" placeholder="Nama pembicara">
                        @error('speaker')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Maksimal Peserta</label>
                        <input type="number" name="max_participants"
                            class="form-control @error('max_participants') is-invalid @enderror"
                            value="{{ old('max_participants', $podcast->max_participants) }}" min="1">
                        @error('max_participants')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Biaya Pendaftaran (Rp)</label>
                        <input type="number" name="registration_fee"
                            class="form-control @error('registration_fee') is-invalid @enderror"
                            value="{{ old('registration_fee', $podcast->registration_fee) }}" min="0" step="0.01">
                        @error('registration_fee')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Tipe Event</label>
                        <select name="event_type" class="form-control @error('event_type') is-invalid @enderror">
                            <option value="online" {{ old('event_type', $podcast->event_type) == 'online' ? 'selected' : '' }}>Online</option>
                            <option value="offline" {{ old('event_type', $podcast->event_type) == 'offline' ? 'selected' : '' }}>Offline</option>
                            <option value="hybrid" {{ old('event_type', $podcast->event_type) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                        @error('event_type')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Link Meeting (untuk event online)</label>
                        <input type="url" name="meeting_link"
                            class="form-control @error('meeting_link') is-invalid @enderror"
                            value="{{ old('meeting_link', $podcast->meeting_link) }}" placeholder="https://zoom.us/...">
                        @error('meeting_link')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Poster Event</label>
                        <input type="file" name="thumbnail"
                            class="form-control @error('thumbnail') is-invalid @enderror"
                            accept="image/*">
                        @error('thumbnail')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                        @if($podcast->thumbnail)
                            <div class="mt-2">
                                <small class="text-muted">Poster saat ini:</small><br>
                                <img src="{{ asset('storage/' . $podcast->thumbnail) }}" alt="Current poster" style="max-width: 200px; max-height: 200px;">
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi Event</label>
                        <textarea name="description_event"
                            class="ckeditor @error('description_event') is-invalid @enderror" id="ckeditor">
                            {{ old('description_event', $podcast->description_podcast) }}
                    </textarea>
                        @error('description_event')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="is_event">
                            <input type="checkbox" name="is_event" id="is_event" value="1" {{ old('is_event', $podcast->is_event) ? 'checked' : '' }}> Ini adalah Event
                        </label>
                    </div>
                    <div id="event-fields" style="display: none;">
                        <div class="form-group">
                            <label for="quota">Kuota Peserta</label>
                            <input type="number" name="quota" class="form-control @error('quota') is-invalid @enderror" value="{{ old('quota', $podcast->quota) }}" min="1">
                            @error('quota')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="registration_open">Pembukaan Pendaftaran</label>
                            <input type="datetime-local" name="registration_open" class="form-control @error('registration_open') is-invalid @enderror" value="{{ old('registration_open', $podcast->registration_open ? \Carbon\Carbon::parse($podcast->registration_open)->format('Y-m-d\TH:i') : '') }}">
                            @error('registration_open')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="registration_close">Penutupan Pendaftaran</label>
                            <input type="datetime-local" name="registration_close" class="form-control @error('registration_close') is-invalid @enderror" value="{{ old('registration_close', $podcast->registration_close ? \Carbon\Carbon::parse($podcast->registration_close)->format('Y-m-d\TH:i') : '') }}">
                            @error('registration_close')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">Simpan Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
$(document).ready(function() {
    $('#is_event').change(function() {
        if ($(this).is(':checked')) {
            $('#event-fields').show();
        } else {
            $('#event-fields').hide();
        }
    });
    // Trigger on load
    $('#is_event').trigger('change');
});
</script>
