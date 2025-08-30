@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Rekening</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.rekening') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.rekening.update', $rekening->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="no_rekening">No Rekening</label>
                        <input type="text" name="no_rekening" class="form-control @error('no_rekening') is-invalid @enderror" value="{{ old('no_rekening', $rekening->no_rekening) }}">
                        @error('no_rekening')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="atas_nama">Atas Nama</label>
                        <input type="text" name="atas_nama" class="form-control @error('atas_nama') is-invalid @enderror" value="{{ old('atas_nama', $rekening->atas_nama) }}">
                        @error('atas_nama')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
