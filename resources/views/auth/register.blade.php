@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">

        <!-- LEFT INFO -->
        <div class="col-lg-5 d-none d-lg-block">
            <div class="sticky-top" style="top:100px">
                <h2 class="fw-bold">Tham gia Tour Travel</h2>
                <p class="text-muted">
                    Đăng ký để đặt tour, theo dõi lịch trình và nhận ưu đãi hấp dẫn.
                </p>
                <img src="{{ asset('https://tse3.mm.bing.net/th/id/OIP.PiVfG-vtNlvQzrt_uevaLwHaH8?cb=ucfimg2&pid=ImgDet&ucfimg=1&w=184&h=197&c=7&dpr=1.3&o=7&rm=3') }}" class="img-fluid rounded w-50">
            </div>
        </div>

        <!-- REGISTER FORM -->
        <div class="col-lg-5">
            <div class="card shadow p-4">
                <h3 class="fw-bold mb-3 text-center">Đăng ký</h3>

                <form method="POST" action="{{ route('register.store') }}">
                    @csrf

                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Họ tên">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <input type="text" name="sdt" class="form-control" value="{{ old('sdt') }}" placeholder="Số điện thoại">
                        @error('sdt') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu">
                    </div>

                    <button class="btn btn-primary w-100 py-2 mt-3">
                        Đăng ký
                    </button>

                    <p class="text-center mt-3">
                        Đã có tài khoản? <a href="/login">Đăng nhập</a>
                    </p>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
