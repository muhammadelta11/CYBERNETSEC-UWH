<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Admin Dashboard')</title>

    {{-- Bootstrap & Fonts --}}
    <link rel="stylesheet" href="{{ asset('frontemplate') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Custom Styles --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 240px;
            position: fixed;
            top: 0; left: 0;
            height: 100%;
            background: #fff;
            border-right: 1px solid #e5e7eb;
            padding-top: 60px;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #374151;
            text-decoration: none;
        }
        .sidebar a.active, .sidebar a:hover {
            background: #f1f5f9;
            color: #2563eb;
        }
        .topbar {
            height: 60px;
            background: #2563eb;
            color: #fff;
            padding: 0 20px;
            position: fixed;
            top: 0; left: 240px; right: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 10;
        }
        .content {
            margin-left: 240px;
            padding: 80px 20px 20px;
        }
    </style>

    @yield('css')
</head>

<body>
    {{-- Sidebar --}}
    <div class="sidebar">
        <h5 class="px-3 mb-3">SEKAWAN.ID</h5>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home me-2"></i> Dashboard
        </a>
        <a href="#">
            <i class="fas fa-users me-2"></i> Users
        </a>
        <a href="#">
            <i class="fas fa-cog me-2"></i> Settings
        </a>
    </div>

    {{-- Topbar --}}
    <div class="topbar">
        <span>@yield('title', 'Dashboard')</span>
        <div>
            <i class="fas fa-user-circle me-2"></i> {{ Auth::user()->name ?? 'Guest' }}
        </div>
    </div>

    {{-- Main Content --}}
    <div class="content">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="text-center py-3 mt-4 text-muted">
        &copy; {{ date('Y') }} SEKAWAN.ID - Admin Panel
    </footer>

    {{-- Scripts --}}
    <script src="{{ asset('frontemplate') }}/js/jquery-1.12.1.min.js"></script>
    <script src="{{ asset('frontemplate') }}/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @yield('js')
</body>
</html>
