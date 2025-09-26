@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Sertifikat</h3>
                    <a href="{{ route('admin.sertifikat.create') }}" class="btn btn-primary float-right">Tambah Sertifikat</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Nama Sertifikat</th>
                                <th>Tanggal Diterbitkan</th>
                                <th>File Sertifikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sertifikats as $s)
                            <tr>
                                <td>{{ $s->id }}</td>
                                <td>{{ $s->user->name }}</td>
                                <td>{{ $s->nama_sertifikat }}</td>
                                <td>{{ $s->tanggal_diterbitkan }}</td>
                                <td>
                                    @if($s->file_sertifikat)
                                    <a href="{{ asset('storage/' . $s->file_sertifikat) }}" target="_blank">Lihat File</a>
                                    @else
                                    Tidak ada file
                                    @endif
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
