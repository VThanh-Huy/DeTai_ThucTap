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

        <div class="mt-5">
            <h4 class="fw-bold">Lịch trình</h4>
            <ul class="list-group">
                @if ($tour->lich_trinh && count($tour->lich_trinh))
    @foreach ($tour->lich_trinh as $ngay => $noiDung)
        <p><strong>Ngày {{ $ngay }}:</strong> {{ $noiDung }}</p>
    @endforeach
@else
    <p>Chưa có lịch trình</p>
@endif

            </ul>
        </div>

        <!-- đánh giá -->
        @auth
            @if ($daDatTour && !$daDanhGia)
                <form method="POST" action="{{ route('review.store', $tour->id_tour) }}">
                    @csrf

                    <label>Đánh giá của bạn</label>
                    <select name="so_sao" class="form-select mb-2" required>
                        <option value="">-- Chọn sao --</option>
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}">{{ $i }} sao</option>
                        @endfor
                    </select>

                    <textarea name="noi_dung" class="form-control mb-2" placeholder="Nhận xét"></textarea>

                    <button class="btn btn-warning">Gửi đánh giá</button>
                </form>
            @endif
        @endauth

        <div class="mt-5">
            <h4 class="fw-bold">Đánh giá</h4>

            @forelse ($tour->reviews as $review)
                <div class="border rounded p-3 mb-3">
                    <strong>
                        {{ $review->user->name ?? 'Khách ẩn danh' }}
                    </strong>

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
