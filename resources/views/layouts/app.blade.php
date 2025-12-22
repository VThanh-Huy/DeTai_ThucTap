<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>

<body>
    {{-- Thông báo đăng ký thành công --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center m-0 rounded-0">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Thông báo đặt thành công --}}
    @if (session('success'))
        <div class="alert alert-success text-center mt-3">
            {{ session('success') }}
        </div>
    @endif


    @yield('content')

    @include('layouts.footer')

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/home/logo.png') }}" width="35" class="me-2">
                <strong>TravelVN</strong>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fs-5">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                            Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('tour*') ? 'active' : '' }}" href="/tour">
                            Tour
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('gioi-thieu') ? 'active' : '' }}" href="/gioi-thieu">
                            Giới thiệu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('lien-he') ? 'active' : '' }}" href="/lien-he">
                            Liên hệ
                        </a>
                    </li>
                </ul>


                <!-- Search -->
                <form class="d-flex position-relative me-3" action="{{ route('tour.index') }}" method="GET">

                    <input class="form-control rounded-pill pe-5" type="search" name="keyword"
                        value="{{ request('keyword') }}" placeholder="Tìm tour...">

                    <button class="btn position-absolute end-0 me-2" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>


                <!-- User Dropdown -->
                <div class="dropdown dropdown-hover user-dropdown">
                    @auth
                        <!-- ĐÃ ĐĂNG NHẬP -->
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-4 me-2"></i>
                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    @endauth

                    @guest
                        <!-- CHƯA ĐĂNG NHẬP -->
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-4"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="/login">Đăng nhập</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/register">Đăng ký</a>
                            </li>
                        </ul>
                    @endguest
                </div>

            </div>
        </div>
    </nav>


</body>

</html>
