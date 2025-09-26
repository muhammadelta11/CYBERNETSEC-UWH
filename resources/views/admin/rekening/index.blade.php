@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.rekening.create') }}" class="btn btn-primary">Tambah Rekening</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No Rekening</th>
                            <th>Atas Nama</th>
                            <th>Tipe Pembayaran</th>
                            <th>Tipe Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekening as $rek)
                        <tr>
                            <td>{{ $rek->no_rekening }}</td>
                            <td>{{ $rek->atas_nama }}</td>
                            <td>
                                @if($rek->payment_type == 'bank_transfer')
                                    Bank Transfer
                                @elseif($rek->payment_type == 'gopay')
                                    GoPay
                                @elseif($rek->payment_type == 'dana')
                                    DANA
                                @elseif($rek->payment_type == 'ovo')
                                    OVO
                                @elseif($rek->payment_type == 'shopeepay')
                                    ShopeePay
                                @endif
                            </td>
                            <td>
                                @if($rek->class_type == 'upskill')
                                    Upskill
                                @elseif($rek->class_type == 'brainlabs')
                                    Brainlabs
                                @elseif($rek->class_type == 'all')
                                    Semua
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.rekening.edit', $rek->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.rekening.destroy', $rek->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
