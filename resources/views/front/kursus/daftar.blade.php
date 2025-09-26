@extends('layouts.front')

@section('content')
<section class="section_padding">
    <div class="container">
        <h2>Daftar Kursus</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row">
            @foreach($kelas as $k)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ $k->thumbnail }}" class="card-img-top" alt="{{ $k->name_kelas }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $k->name_kelas }}</h5>
                        <p class="card-text">{{ $k->description_video }}</p>
                        <a href="{{ route('kelas.detail', $k->id) }}" class="btn btn-primary">Detail Kursus</a>
                        <form action="{{ route('kursus.enroll', $k->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Daftar Kursus</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
