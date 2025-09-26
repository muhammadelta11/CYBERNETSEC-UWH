@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Sertifikat</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.sertifikat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="user_id">User</label>
                            <select name="user_id" class="form-control" required>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->nim }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_sertifikat">Nama Sertifikat</label>
                            <input type="text" name="nama_sertifikat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_diterbitkan">Tanggal Diterbitkan</label>
                            <input type="date" name="tanggal_diterbitkan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="file_sertifikat">File Sertifikat (PDF/JPG/PNG)</label>
                            <input type="file" name="file_sertifikat" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
