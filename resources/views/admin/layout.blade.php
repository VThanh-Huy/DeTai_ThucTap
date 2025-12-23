<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('CSS/StyleAdmin/styleAdmin.css') }}">
    @stack('styles')
</head>

<body>

<div class="admin-wrapper d-flex">

    <!-- SIDEBAR -->
    <aside class="admin-sidebar">
        <div class="sidebar-header">
            <h4>ADMIN PANEL</h4>
        </div>

        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}">📊 Dashboard</a></li>
            <li><a href="{{ route('admin.tour.index') }}">🧳 Quản lý tour</a></li>
            <li><a href="{{ route('admin.bookings') }}">📑 Booking</a></li>
            <li><a href="{{ route('admin.dia_diem.index') }}">📍 Địa điểm</a></li>
            <li><a href="{{ route('admin.khachhang.index') }}">👥 Khách hàng</a></li>
            <li><a href="{{ route('admin.users') }}">👤 Người dùng</a></li>
            <li><a href="{{ route('admin.huongdanvien.index') }}">🧑‍✈️ Hướng dẫn viên</a></li>
            <li><a href="{{ route('admin.statistics.revenue') }}">📈Thống kê doanh thu</a></li>
        </ul>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-light w-100">
                    Đăng xuất
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="admin-main">

        <!-- TOPBAR -->
        <div class="admin-topbar shadow-sm">
            <span class="fw-semibold">Xin chào, {{ Auth::user()->name ?? 'Admin' }}</span>
        </div>

        <!-- CONTENT -->
        <div class="admin-content">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>

</html>
