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
                <form action="{{ route('admin.kelas.update',Crypt::encrypt($kelas->id)) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Kelas</label>
                        <input type="text" name="name_kelas" class="form-control @error('name_kelas') is-invalid @enderror" value="{{ $kelas->name_kelas }}">
                        @error('name_kelas')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Kategori Upskill</label>
                        <select name="upskill_category_id" class="form-control @error('upskill_category_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($upskillCategories as $category)
                            <option value="{{ $category->id }}" {{ $kelas->upskill_category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->semester->name }} - {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('upskill_category_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Tipe Kelas</label>
                        <select name="type_kelas" id="type_kelas" class="form-control">
                            <option value="0" {{ $kelas->type_kelas == 0 ? 'selected' : '' }}>Gratis</option>
                            <option value="1" {{ $kelas->type_kelas == 1 ? 'selected' : '' }}>Regular</option>
                            <option value="2" {{ $kelas->type_kelas == 2 ? 'selected' : '' }}>Premium</option>
                            <option value="3" {{ $kelas->type_kelas == 3 ? 'selected' : '' }}>Program Upskill</option>
                            <option value="4" {{ $kelas->type_kelas == 4 ? 'selected' : '' }}>Brainlabs</option>
                        </select>
                        @error('type_kelas')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi Kelas</label>
                        <textarea name="description_kelas" class="ckeditor @error('description_kelas') is-invalid @enderror" id="ckeditor">
                        {{ $kelas->description_kelas }}
                    </textarea>
                        @error('description_kelas')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group" id="harga-group" style="display: {{ $kelas->type_kelas == 3 || $kelas->type_kelas == 4 ? 'block' : 'none' }};">
                        <label for="">Harga Kelas (Rp)</label>
                        <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ $kelas->harga }}" min="0">
                        @error('harga')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Thumbnail Kelas</label>
                        <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">
                        <small class="text-warning">Kosongkan jika tidak akan mengubah thumbnail</small><br>
                        @error('thumbnail')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Modul Pendukung (PDF/DOC/DOCX)</label>
                        <input type="file" name="modul_file" class="form-control @error('modul_file') is-invalid @enderror">
                        <small class="text-warning">Kosongkan jika tidak akan mengubah modul</small><br>
                        @if($kelas->modul_file)
                        <small class="text-info">File saat ini: {{ basename($kelas->modul_file) }}</small>
                        @endif
                        @error('modul_file')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-success">Perbaharui Kelas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type_kelas');
    const hargaGroup = document.getElementById('harga-group');

    // Initial check
    const initialValue = '{{ $kelas->type_kelas }}';
    if (initialValue === '3' || initialValue === '4') {
        hargaGroup.style.display = 'block';
    } else {
        hargaGroup.style.display = 'none';
    }

    // On change
    typeSelect.addEventListener('change', function() {
        var selectedValue = this.value;
        if (selectedValue === '3' || selectedValue === '4') {
            hargaGroup.style.display = 'block';
        } else {
            hargaGroup.style.display = 'none';
        }
    });
});
</script>
@endsection
