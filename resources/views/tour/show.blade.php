@extends('layouts.app')

@section('content')
    <div class="container mt-5 pt-5">

        <div class="row">
            <!-- Ảnh -->
            <div class="col-md-6">
                <img src="{{ asset('images/tours/' . $tour->hinh_anh) }}" class="img-fluid rounded shadow w-100">
            </div>

            <!-- Thông tin -->
            <div class="col-md-6">
                <h2 class="fw-bold">{{ $tour->ten_tour }}</h2>

                <p class="text-danger fs-4 fw-bold">
                    {{ number_format($tour->gia_tien, 0, ',', '.') }} VND
                </p>

                <p>{{ $tour->mo_ta }}</p>

                <p><strong>Số ngày:</strong> {{ $tour->so_ngay }} ngày</p>
                <p><strong>Ngày đi:</strong> {{ $tour->ngay_bat_dau }}</p>
                <p><strong>Ngày về:</strong> {{ $tour->ngay_ket_thuc }}</p>

                <p>
                    <strong>Hướng dẫn viên:</strong>
                    {{ $tour->huongDanVien->ten_hdv ?? 'Chưa cập nhật' }}
                </p>

                <a href="{{ route('booking.create', ['id' => $tour->id_tour]) }}" class="btn btn-success mt-3">
                    Đặt tour ngay
                </a>

            </div>
        </div>

        <!-- LỊCH TRÌNH -->
        <div class="mt-5">
            <h4 class="fw-bold">Lịch trình</h4>
            <ul class="list-group">
                @foreach ($tour->lichTrinh as $lt)
                    <li class="list-group-item">
                        <strong>Ngày {{ $lt->ngay }}:</strong> {{ $lt->hoat_dong }}
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- REVIEW -->
        <div class="mt-5">
            <h4 class="fw-bold">Đánh giá</h4>

            @forelse ($tour->reviews as $review)
                <div class="border rounded p-3 mb-3">
                    <strong>{{ $review->user->name }}</strong>
                    <div class="text-warning">
                        @for ($i = 1; $i <= 5; $i++)
                            {{ $i <= $review->so_sao ? '⭐' : '☆' }}
                        @endfor
                    </div>
                    <p>{{ $review->noi_dung }}</p>
                </div>
            @empty
                <p class="text-muted">Chưa có đánh giá</p>
            @endforelse
        </div>

    </div>
@endsection
