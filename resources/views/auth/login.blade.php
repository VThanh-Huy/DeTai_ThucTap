@extends('layouts.app')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-5 ms-auto">
                <div class="card shadow p-4">
                    <h3 class="text-center mb-4">Đăng nhập</h3>

                    <form method="POST" action="/login">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <input type="text" name="login" class="form-control @error('login') is-invalid @enderror"
                                value="{{ old('login') }}" placeholder="Tên đăng nhập hoặc Email">
                            @error('login')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Mật khẩu">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-primary w-100">Đăng nhập</button>

                        <div class="text-center mt-2">
                            <a href="{{ route('password.request') }}" class="text-decoration-none">
                                Quên mật khẩu?
                            </a>
                        </div>
                        <p class="text-center mt-3">
                            Chưa có tài khoản? <a href="/register">Đăng ký</a>
                        </p>
                    </form>
                </div>
            </div>

            <!-- Ảnh và chữ bên phải màn hình -->
            <div class="col-lg-5 d-none ms-auto d-lg-block">
                <div class="sticky-top" style="top:100px">
                    <h2 class="fw-bold">Tham gia Tour Travel</h2>
                    <p class="text-muted">
                        Chào mừng bạn quay trở lại.
                    </p>
                    <img src="{{ asset('images/home/image_login.jpg') }}" class="img-fluid rounded w-75">
                </div>
            </div>
        </div>
    </div>
@endsection
