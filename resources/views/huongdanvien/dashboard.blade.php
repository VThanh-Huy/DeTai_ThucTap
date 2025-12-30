<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tour phân công</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Hướng dẫn viên: {{ auth('huongdanvien')->user()->ten_hdv }}</h4>

    <div class="dropdown">
        <button class="btn btn-outline-primary dropdown-toggle m-3" data-bs-toggle="dropdown">
            👤 Tài khoản
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="{{ route('huongdanvien.profile') }}">
                    Thông tin cá nhân
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('huongdanvien.logout') }}">
                    @csrf
                    <button class="dropdown-item text-danger">
                        Đăng xuất
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>

    <div class="container my-4">

    <div class="row mb-3">
        <div class="col-12">
            <h3 class="fw-bold text-primary">
                Danh sách tour được phân công
            </h3>
        </div>
    </div>

    <div class="card shadow-sm rounded-4">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>Tên tour</th>
                            <th>Ngày bắt đầu</th>
                            <th>Số ngày</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($tours as $tour)
                            <tr>
                                <td class="text-start">
                                    <strong>{{ $tour->ten_tour }}</strong>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($tour->ngay_bat_dau)->format('d/m/Y') }}
                                </td>
                                <td>
                                    {{ $tour->so_ngay }} ngày
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-muted py-4">
                                    🚫 Chưa được phân công tour
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>