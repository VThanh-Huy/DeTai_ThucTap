<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Xin chào {{ $booking->user->name }}</h2>

    <p>
        Đơn đặt tour <strong>{{ $booking->tour->ten_tour }}</strong>
        của bạn đã được <strong>duyệt thành công</strong>.
    </p>

    <p>
        Ngày đặt: {{ $booking->ngay_bat_dau }} <br>
        Số lượng khách: {{ $booking->so_luong }}
    </p>

    <p>
        Cảm ơn bạn đã sử dụng dịch vụ 
    </p>

    <hr>
    <small>Tour Travel</small>
</body>
</html>
