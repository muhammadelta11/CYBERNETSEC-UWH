@extends('layouts.front')
@section('content')


@section('content')
<div class="row">
    {{-- Card Statistik --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <p class="text-muted mb-1">Dosen</p>
                <h3 class="font-weight-bold text-primary">271</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <p class="text-muted mb-1">Dosen</p>
                <h3 class="font-weight-bold text-success">271</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <p class="text-muted mb-1">Pegawai Aktif</p>
                <h3 class="font-weight-bold text-warning">182</h3>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    {{-- Chart 1 --}}
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header"><h6 class="mb-0">Jabatan Akademik Dosen</h6></div>
            <div class="card-body">
                <canvas id="chartDosen"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart 2 --}}
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header"><h6 class="mb-0">Jumlah Dosen Berdasarkan Jenis Kelamin</h6></div>
            <div class="card-body">
                <canvas id="chartGenderDosen"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart 3 --}}
    <div class="col-md-6 mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header"><h6 class="mb-0">Jabatan Akademik Tendik</h6></div>
            <div class="card-body text-muted text-center">
                Tidak Ada Data
            </div>
        </div>
    </div>

    {{-- Chart 4 --}}
    <div class="col-md-6 mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header"><h6 class="mb-0">Jumlah Tendik Berdasarkan Jenis Kelamin</h6></div>
            <div class="card-body">
                <canvas id="chartGenderTendik"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    const ctx1 = document.getElementById('chartDosen');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Asisten Ahli', 'Lektor', 'Kepala Lektor', 'Guru Besar'],
            datasets: [{
                data: [20, 40, 30, 10],
                backgroundColor: ['#f59e0b','#3b82f6','#ef4444','#10b981'],
            }]
        }
    });

    const ctx2 = document.getElementById('chartGenderDosen');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Laki-Laki','Perempuan'],
            datasets: [{
                data: [60,40],
                backgroundColor: ['#3b82f6','#ef4444'],
            }]
        }
    });

    const ctx3 = document.getElementById('chartGenderTendik');
    new Chart(ctx3, {
        type: 'doughnut',
        data: {
            labels: ['Laki-Laki','Perempuan'],
            datasets: [{
                data: [0,0],
                backgroundColor: ['#3b82f6','#ef4444'],
            }]
        }
    });
</script>
@endsection
