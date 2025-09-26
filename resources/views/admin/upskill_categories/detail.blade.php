@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }} {{ $upskillCategory->name }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.upskill_categories.edit',Crypt::encrypt($upskillCategory->id)) }}" class="btn btn-warning">
                        Edit
                    </a>
                    <a href="javascript:void(0)" onclick="alertconfirmn('{{ route('admin.upskill_categories.hapus',Crypt::encrypt($upskillCategory->id)) }}')" class="btn btn-danger">
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
                                <td>Semester</td>
                                <td class="px-2 py-1">:</td>
                                <td>{{ $upskillCategory->semester->name }}</td>
                            </tr>
                            <tr>
                                <td>Nama Kategori</td>
                                <td class="px-2 py-1">:</td>
                                <td>{{ $upskillCategory->name }}</td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top">Deskripsi Kategori</td>
                                <td style="vertical-align: top" class="px-2 py-1">:</td>
                                <td style="vertical-align: top">
                                    {!! $upskillCategory->description !!}
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
                <h4>Kelas dalam Kategori {{ $upskillCategory->name }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.kelas.tambah') }}" class="btn btn-primary">
                        Tambah Kelas
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-hover" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Kelas</th>
                                <th>Tipe Kelas</th>
                                <th>Harga</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($upskillCategory->kelas as $kelas)
                            <tr>
                                <td></td>
                                <td>{{ $kelas->name_kelas }}</td>
                                <td>
                                    @if ($kelas->type_kelas == 0)
                                    <span class="badge badge-success">Gratis</span>
                                    @elseif($kelas->type_kelas == 1)
                                    <span class="badge badge-primary">Regular</span>
                                    @elseif($kelas->type_kelas == 2)
                                    <span class="badge badge-warning">Premium</span>
                                    @elseif($kelas->type_kelas == 3)
                                    <span class="badge badge-info">Program Upskill</span>
                                    @endif
                                </td>
                                <td>
                                    @if($kelas->harga > 0)
                                        Rp {{ number_format($kelas->harga, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.kelas.detail', Crypt::encrypt($kelas->id)) }}" class="btn btn-info">
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
