@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }}</h4>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.transaksi') }}" class="btn btn-outline-primary {{ $title == 'Semua Transaksi' ? 'active' : '' }}">Semua</a>
                    <a href="{{ route('admin.transaksi.belumdicek') }}" class="btn btn-outline-warning {{ $title == 'Transaksi Belum Dicek ' ? 'active' : '' }}">Belum Dicek</a>
                    <a href="{{ route('admin.transaksi.disetujui') }}" class="btn btn-outline-success {{ $title == 'Transaksi Disetujui' ? 'active' : '' }}">Disetujui</a>
                    <a href="{{ route('admin.transaksi.ditolak') }}" class="btn btn-outline-danger {{ $title == 'Transaksi Ditolak' ? 'active' : '' }}">Ditolak</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-hover" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Kategori Kelas</th>
                                <th>Tipe Kelas</th>
                                <th>Jumlah</th>
                                <th>Nama Kelas</th>
                                <th>Status</th>
                                <th>Tanggal Bayar</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksis as $item)
                            <tr>
                                <td></td>
                                <td>{{ $item->users ? $item->users->name : 'N/A' }}</td>
                                <td>
                                    @if ($item->kelas_id && $item->kelas && $item->kelas->upskillCategory)
                                    {{ $item->kelas->upskillCategory->name }}
                                    @else
                                    Upgrade Premium
                                    @endif
                                </td>
                                <td>{{ $item->kelas ? $item->kelas->type_kelas : '-' }}</td>
                                <td>
                                    @if ($item->kelas_id)
                                    Rp. {{ number_format($item->harga,0,',','.') }}
                                    @else
                                    @php
                                        $setting = \App\Setting::first();
                                        if (!$setting) {
                                            $setting = new \stdClass();
                                            $setting->harga = 0;
                                        }
                                    @endphp
                                    Rp. {{ number_format($setting->harga,0,',','.') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($item->kelas_id && $item->kelas)
                                    {{ $item->kelas->name_kelas }}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 0)
                                    Belum Dicek
                                    @elseif($item->status == 1)
                                    Disetujui
                                    @else
                                    Ditolak
                                    @endif
                                </td>
                                <td>{{ $item->tanggal ? substr($item->tanggal,0,10) : substr($item->created_at,0,10) }}</td>
                                <td>
                                    @if($item->status == 0)
                                    <form action="{{ route('admin.transaksi.ubah', Crypt::encrypt($item->id)) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin menyetujui transaksi ini?')">Terima</button>
                                    </form>
                                    <form action="{{ route('admin.transaksi.ubah', Crypt::encrypt($item->id)) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="2">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menolak transaksi ini?')">Tolak</button>
                                    </form>
                                    @elseif($item->status == 1)
                                    <form action="{{ route('admin.transaksi.ubah', Crypt::encrypt($item->id)) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="2">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menolak transaksi ini?')">Tolak</button>
                                    </form>
                                    @elseif($item->status == 2)
                                    <form action="{{ route('admin.transaksi.ubah', Crypt::encrypt($item->id)) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin menyetujui transaksi ini?')">Terima</button>
                                    </form>
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