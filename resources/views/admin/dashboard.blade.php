@extends('layouts.admin')

@section('content')
<div class="row">
    <!-- Card Statistik -->
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Dosen</h4>
                </div>
                <div class="card-body">
                    271
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Dosen</h4>
                </div>
                <div class="card-body">
                    271
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pegawai Aktif</h4>
                </div>
                <div class="card-body">
                    182
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart -->
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Jabatan Akademik Dosen</h4>
            </div>
            <div class="card-body">
                <canvas id="chartDosen"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Jumlah Dosen Berdasarkan Jenis Kelamin</h4>
            </div>
            <div class="card-body">
                <canvas id="chartGender"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    // Chart.js Example
    var ctx = document.getElementById("chartDosen").getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Asisten Ahli", "Lektor", "Kepala Lektor", "Guru Besar"],
            datasets: [{
                label: 'Jumlah',
                data: [40, 120, 80, 31],
                backgroundColor: ['#f39c12', '#3498db', '#e74c3c', '#2ecc71']
            }]
        }
    });

    var ctx2 = document.getElementById("chartGender").getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ["Laki-Laki", "Perempuan"],
            datasets: [{
                data: [180, 91],
                backgroundColor: ['#3498db', '#e74c3c']
            }]
        }
    });
</script>
@endsection
