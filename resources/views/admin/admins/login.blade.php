@extends('layouts.app')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-5 mx-auto">
                <div class="card shadow p-4">
                    <h3 class="text-center mb-4">Admin login</h3>

                    <form method="POST" action="{{ route('admin.login.submit') }}">
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

                    </form>
                </div>
            </div>

            
        </div>
    </div>
@endsection

