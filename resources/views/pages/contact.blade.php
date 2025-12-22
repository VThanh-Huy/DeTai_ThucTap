@extends('layouts.app')
@section('content')
<!-- HERO -->
<div class="hero mt-2 pt-4">
    <img src="{{ asset('images/home/main_Image.jpg') }}">
    <div class="hero-text text-white text-center">
        <h1 class="fw-bold">Liên hệ với chúng tôi</h1>
        <p class="fs-5">Chúng tôi luôn sẵn sàng hỗ trợ bạn</p>
    </div>
</div>

<section class="container my-5">
    <div class="row g-4">
        <div class="col-md-5">
            <h4 class="fw-bold mb-3">Thông tin liên hệ</h4>
            <p><strong>📍 Địa chỉ:</strong> 123 Tố Hữu, TP.Nha Trang</p>
            <p><strong>📞 Hotline:</strong> 0123 456 789</p>
            <p><strong>📧 Email:</strong> travelvn@gmail.com</p>
            <p><strong>⏰ Giờ làm việc:</strong> 8:00 – 17:30 (T2–T6)</p>
        </div>

        <div class="col-md-7">
            <h4 class="fw-bold mb-3">Gửi tin nhắn</h4>

            <form>
                <div class="mb-3">
                    <label class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" placeholder="Nhập họ tên">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Nhập email">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nội dung</label>
                    <textarea class="form-control" rows="4" placeholder="Nội dung liên hệ"></textarea>
                </div>

                <button class="btn btn-primary px-4">
                    Gửi liên hệ
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
