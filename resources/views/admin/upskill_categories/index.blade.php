@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.upskill_categories.tambah') }}" class="btn btn-primary">
                        Tambah Kategori
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-hover" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Semester</th>
                                <th>Deskripsi</th>
                                <th>Jumlah Kelas</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($upskillCategories as $item)
                            <tr>
                                <td></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->semester->name }}</td>
                                <td>{{ Str::limit($item->description, 50) }}</td>
                                <td>{{ $item->kelas->count() }}</td>
                                <td>
                                    <a href="{{ route('admin.upskill_categories.edit', Crypt::encrypt($item->id)) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{ route('admin.upskill_categories.hapus', Crypt::encrypt($item->id)) }}"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</a>
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
