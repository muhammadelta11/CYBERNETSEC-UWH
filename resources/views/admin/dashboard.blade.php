@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Dashboard Admin</h2>
        <p>Welcome to the admin dashboard.</p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h3>Management Sections</h3>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card text-center p-3" style="min-height: 180px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h5>Semester</h5>
                        <p>Manage academic semester</p>
                    </div>
                    <a href="{{ route('admin.semesters') }}" class="btn btn-primary">Manage Semesters</a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center p-3" style="min-height: 180px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h5>Upskill Categories</h5>
                        <p>Manage upskill categories within semester</p>
                    </div>
                    <a href="{{ route('admin.upskill_categories') }}" class="btn btn-primary">Manage Categories</a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center p-3" style="min-height: 180px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h5>Kelas (Courses)</h5>
                        <p>Manage courses within categories</p>
                    </div>
                    <a href="{{ route('admin.kelas') }}" class="btn btn-primary">Manage Courses</a>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center p-3" style="min-height: 180px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h5>User Logs</h5>
                        <p>View user activity logs</p>
                    </div>
                    <a href="{{ route('admin.userlog') }}" class="btn btn-primary">View Logs</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
