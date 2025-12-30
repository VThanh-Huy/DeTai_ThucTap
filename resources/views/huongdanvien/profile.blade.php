<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tour phân công</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<div class="container my-4">
    <div class="card shadow rounded-4">
        <div class="card-body">
            <div class="row">
            <h4 class="mb-4 fw-bold text-primary col-lg-10 mt-3">Thông tin cá nhân</h4>
                <button class="btn btn-warning mt-4 col-lg-2" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                    🔐 Đổi mật khẩu
                </button>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Tên:</strong> {{ $hdv->ten_hdv }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $hdv->email }}</li>
                <li class="list-group-item"><strong>Số điện thoại:</strong> {{ $hdv->sdt }}</li>
                <li class="list-group-item"><strong>Giới tính:</strong> {{ $hdv->gioi_tinh }}</li>
                <li class="list-group-item"><strong>Năm bắt đầu:</strong> {{ $hdv->nam_bat_dau }}</li>
                <li class="list-group-item"><strong>Ngôn ngữ:</strong> {{ $hdv->ngon_ngu }}</li>
                <li class="list-group-item"><strong>Kinh nghiệm:</strong> {{ $hdv->kinh_nghiem }}</li>


            </ul>

            <a href="{{ route('huongdanvien.dashboard') }}" class="btn btn-secondary mt-4">
                ← Back
            </a>
        </div>
    </div>
</div>

<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <form method="POST" action="{{ route('huongdanvien.password.update') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">🔐 Đổi mật khẩu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu hiện tại</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu mới</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Xác nhận mật khẩu mới</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
