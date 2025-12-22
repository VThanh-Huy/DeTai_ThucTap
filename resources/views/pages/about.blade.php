@extends('layouts.app')

@section('content')

<section class="container mt-5">
    <div class="row  align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold mb-3">Chúng tôi là ai?</h2>
            <p class="text-muted">
                TravelVN là nền tảng đặt tour du lịch uy tín, mang đến cho khách hàng
                những hành trình an toàn, chất lượng và giá cả hợp lý.
            </p>
            <p class="text-muted">
                Với đội ngũ hướng dẫn viên chuyên nghiệp và hệ thống tour đa dạng,
                chúng tôi cam kết mang lại trải nghiệm du lịch đáng nhớ.
            </p>
        </div>

        <div class="col-md-6">
            <img src="{{ asset('images/home/card1.jpg') }}"
                 class="img-fluid rounded shadow">
        </div>
    </div>
</section>

<section class="bg-light py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Giá trị cốt lõi</h2>
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <h5 class="fw-bold">🌍 Đa dạng tour</h5>
                <p class="text-muted">Hàng trăm tour trong và ngoài nước</p>
            </div>
            <div class="col-md-4">
                <h5 class="fw-bold">💼 Chuyên nghiệp</h5>
                <p class="text-muted">Hướng dẫn viên giàu kinh nghiệm</p>
            </div>
            <div class="col-md-4">
                <h5 class="fw-bold">❤️ Tận tâm</h5>
                <p class="text-muted">Luôn đồng hành cùng khách hàng</p>
            </div>
        </div>
    </div>
</section>
@endsection
