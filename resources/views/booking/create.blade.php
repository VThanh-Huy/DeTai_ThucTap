@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">
    <h3 class="fw-bold mb-4">Đặt tour: {{ $tour->ten_tour }}</h3>

    <form method="POST" action="{{ route('booking.store', $tour->id_tour) }}">
        @csrf

        <!-- Số người -->
        <div class="mb-3">
            <label class="form-label">Số người</label>
            <input type="number" name="so_luong" id="so_luong"
                   class="form-control" min="1" value="1">
        </div>

        <!-- Tổng tiền -->
        <div class="mb-3">
            <label class="form-label">Tổng tiền</label>
            <input type="text" id="tong_tien"
                   class="form-control text-danger fw-bold" readonly>
        </div>

        <!-- Phương thức thanh toán -->
        <div class="mb-3">
            <label class="form-label">Phương thức thanh toán</label>

            <select name="phuong_thuc_tt" class="form-select" required>
                <option value="">-- Chọn --</option>
                <option value="MOMO">Ví MOMO</option>
                <option value="VCB">Vietcombank</option>
                <option value="BIDV">BIDV</option>
                <option value="MB">MB Bank</option>
            </select>
        </div>

        <button class="btn btn-success">
            Xác nhận đặt tour
        </button>
    </form>
</div>

<script>
    const giaTour = {{ $tour->gia_tien }};
    const soChoInput = document.getElementById('so_luong');
    const tongTienInput = document.getElementById('tong_tien');

    function tinhTien() {
        const soCho = soChoInput.value;
        const tong = giaTour * soCho;
        tongTienInput.value = tong.toLocaleString('vi-VN') + ' VND';
    }

    soChoInput.addEventListener('input', tinhTien);
    tinhTien();
</script>
@endsection


