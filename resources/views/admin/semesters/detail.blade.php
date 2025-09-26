@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }} {{ $semester->name }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.semesters.edit',Crypt::encrypt($semester->id)) }}" class="btn btn-warning">
                        Edit
                    </a>
                    <a href="javascript:void(0)" onclick="alertconfirmn('{{ route('admin.semesters.hapus',Crypt::encrypt($semester->id)) }}')" class="btn btn-danger">
                        Hapus
                    </a>
                    <button id="btn-back" class="btn btn-primary">
                        Kembali
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table>
                            <tr>
                                <td>Nama Semester</td>
                                <td class="px-2 py-1">:</td>
                                <td>{{ $semester->name }}</td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top">Deskripsi Semester</td>
                                <td style="vertical-align: top" class="px-2 py-1">:</td>
                                <td style="vertical-align: top">
                                    {!! $semester->description !!}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Kategori Upskill dalam Semester {{ $semester->name }}</h4>
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
                                <th>Deskripsi</th>
                                <th>Jumlah Kelas</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semester->upskillCategories as $category)
                            <tr>
                                <td></td>
                                <td>{{ $category->name }}</td>
                                <td>{{ Str::limit($category->description, 50) }}</td>
                                <td>{{ $category->kelas->count() }}</td>
                                <td>
                                    <a href="{{ route('admin.upskill_categories.detail', Crypt::encrypt($category->id)) }}" class="btn btn-info">
                                        Detail
                                    </a>
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
