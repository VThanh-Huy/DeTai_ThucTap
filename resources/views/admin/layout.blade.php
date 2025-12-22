<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href= "{{ asset('CSS/StyleAdmin/styleAdmin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>

<body>

    <div class="admin-container">

        <div class="sidebar">
            <h2>ADMIN</h2>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.tour.index') }}">Danh sách tour</a>
            <a href="{{ route('admin.bookings') }}">Quản lý booking</a>
            <a href="{{ route('admin.dia_diem.index') }}">Quản lý địa điểm</a>
            <a href="{{ route('admin.khachhang.index') }}">Khách Hàng</a>
            <a href="{{ route('admin.users') }}">Quản lý người dùng</a>
            <a href="{{ route('admin.huongdanvien.index') }}">Quản lý hướng dẫn viên</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button>
                    Đăng xuất
                </button>
            </form>
        </div>

        <div class="content">
            @if (session('success'))
                <div class="content_succes">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="content_error">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>

</html>
