<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="col-md-4 mx-auto">
        <div class="card p-4 shadow">
            <h4 class="text-center mb-3">Login tour guide</h4>

            <form method="POST" action="{{ route('huongdanvien.login.submit') }}">
                @csrf

                <div class="mb-3">
                    <input type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="password" name="password"
                        class="form-control"
                        placeholder="Mật khẩu">
                </div>

                <button class="btn btn-primary w-100">Đăng nhập</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
