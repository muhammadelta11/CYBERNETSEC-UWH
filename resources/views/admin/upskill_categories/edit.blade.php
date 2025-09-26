@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.upskill_categories') }}" class="btn btn-primary">
                        Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.upskill_categories.update', Crypt::encrypt($upskillCategory->id)) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Pilih Semester</label>
                        <select name="semester_id" class="form-control @error('semester_id') is-invalid @enderror">
                            <option value="">-- Pilih Semester --</option>
                            @foreach($semesters as $semester)
                            <option value="{{ $semester->id }}" {{ old('semester_id', $upskillCategory->semester_id) == $semester->id ? 'selected' : '' }}>
                                {{ $semester->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('semester_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $upskillCategory->name) }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi Kategori</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $upskillCategory->description) }}</textarea>
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">Update Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
