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
            <h4 class="mb-4 fw-bold text-primary">👤 Thông tin cá nhân</h4>

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
                ← Quay lại dashboard
            </a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>