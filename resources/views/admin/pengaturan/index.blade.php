@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }}</h4>
                <div class="card-header-action">
                    <button id="btn-back" class="btn btn-primary">
                        Kembali
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.setting.simpan') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">About</label>
                        <textarea name="about"
                            class="ckeditor @error('about') is-invalid @enderror" id="ckeditor">
                        {{ $setting->about }}
                    </textarea>
                        @error('about')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Harga Akun Berbayar</label>
                        <input type="text" name="harga" class="form-control @error('harga') is-invalid @enderror"
                            value="{{ $setting->harga }}">
                        @error('harga')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="registration_enabled" value="1" id="registration_enabled" {{ $setting->registration_enabled ? 'checked' : '' }}>
                            <label class="form-check-label" for="registration_enabled">
                                Aktifkan Pendaftaran Pengguna
                            </label>
                        </div>
                        @error('registration_enabled')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">Perbaharui Pengaturan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection