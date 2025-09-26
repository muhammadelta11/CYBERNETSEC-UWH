@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.podcast.tambah') }}" class="btn btn-primary">
                        Tambah
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-hover" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Event</th>
                                <th>Tanggal Event</th>
                                <th>Tipe</th>
                                <th>Kuota</th>
                                <th>Poster Event</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($podcasts as $item)
                            <tr>
                                <td></td>
                                <td>{{ $item->name_podcast }}</td>
                                <td>{{ $item->event_date ? \Carbon\Carbon::parse($item->event_date)->format('d/m/Y') : '-' }}</td>
                                <td>{{ $item->is_event ? 'Event' : 'Podcast' }}</td>
                                <td>{{ $item->is_event ? ($item->quota ?? '-') : '-' }}</td>
                                <td>
                                    @if($item->thumbnail)
                                        <img src="{{ asset('storage/' . $item->thumbnail) }}" width="200" alt="Poster Event">
                                    @else
                                        <span class="text-muted">No Poster</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.podcast.detail',Crypt::encrypt($item->id)) }}"
                                        class="btn btn-warning">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection