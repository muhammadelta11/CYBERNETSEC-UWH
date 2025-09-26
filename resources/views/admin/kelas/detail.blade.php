@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }} {{ $kelas->name_kelas }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.kelas.edit',Crypt::encrypt($kelas->id)) }}" class="btn btn-warning">
                        Edit
                    </a>
                    <a href="javascript:void(0)" onclick="alertconfirmn('{{ route('admin.kelas.hapus',Crypt::encrypt($kelas->id)) }}')" class="btn btn-danger">
                        Hapus
                    </a>
                    <button id="btn-back" class="btn btn-primary">
                        Kembali
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table>
                            <tr>
                                <td>Kategori</td>
                                <td class="px-2 py-1">:</td>
                                <td>
                                    @if($kelas->upskillCategory)
                                        {{ $kelas->upskillCategory->semester->name }} - {{ $kelas->upskillCategory->name }}
                                    @else
                                        <span class="text-muted">Tidak ada kategori</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Tipe Kelas</td>
                                <td class="px-2 py-1">:</td>
                                <td>
                                    @if ($kelas->type_kelas == 0)
                                    Gratis
                                    @elseif($kelas->type_kelas == 1)
                                    Regular
                                    @elseif($kelas->type_kelas == 2)
                                    Premium
                                    @elseif($kelas->type_kelas == 3)
                                    Program Upskill
                                    @elseif($kelas->type_kelas == 4)
                                    Brainlabs
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top">Deskripsi Kelas</td>
                                <td style="vertical-align: top" class="px-2 py-1">:</td>
                                <td style="vertical-align: top">
                                    {!! $kelas->description_kelas !!}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $kelas->thumbnail) }}" width="100%" alt="" srcset="">
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
                <h4>Materi {{ $kelas->name_kelas }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.kelas.tambahvideo',Crypt::encrypt($kelas->id)) }}" class="btn btn-primary">
                        Tambah Materi
                    </a>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-hover" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Tipe</th>
                                <th>Konten</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas->materi as $item)
                            <tr>
                                <td></td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    @if($item->type == 'video')
                                        <span class="badge badge-primary">Video</span>
                                    @elseif($item->type == 'text')
                                        <span class="badge badge-success">Teks</span>
                                    @elseif($item->type == 'document')
                                        <span class="badge badge-warning">Dokumen</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->type == 'video')
                                        {{ $item->url }}
                                    @elseif($item->type == 'text')
                                        {!! Str::limit(strip_tags($item->content), 50) !!}
                                    @elseif($item->type == 'document')
                                        @if($item->url)
                                            <a href="{{ asset('storage/' . $item->url) }}" target="_blank">{{ basename($item->url) }}</a>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <a href="javascript:void(0)" onclick="alertconfirmn('{{ route('admin.kelas.hapusvideo',[
                                        'id' => Crypt::encrypt($item->id),
                                        'idkelas' => Crypt::encrypt($kelas->id)
                                    ]) }}')" class="btn btn-danger">
                                        Hapus
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
