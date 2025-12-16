@extends('layouts.app')
@section('content')

    <!-- HERO -->
    <div class="hero mt-2 pt-4">
        <img src="{{ asset('images/home/main_Image.jpg') }}">

        <div class="hero-search bg-white shadow p-3 rounded d-flex gap-3">
            <div>
                <label class="fw-semibold">Ngày khởi hành</label>
                <input type="date" class="form-control">
            </div>
            <div>
                <label class="fw-semibold">Ngày kết thúc</label>
                <input type="date" class="form-control">
            </div>
            <div class="d-flex align-items-end">
                <button class="btn btn-primary px-4">Tìm kiếm</button>
            </div>
        </div>
    </div>

    <!-- TOUR GỢI Ý -->
    <section class="container my-5">
        <h2 class="fw-bold mb-4 fs-3">Tour nổi bật</h2>

        <div class="row g-4">

            <!-- CARD -->
            @php
                $tours = [
                    ["Đà Lạt 3N2Đ", "3 ngày", "2,500,000", asset('images/home/card1.jpg')],
                    ["Phú Quốc 4N3Đ", "4 ngày", "3,900,000", asset('images/home/card2.jpg')],
                    ["Nha Trang 3N2Đ", "3 ngày", "2,800,000", asset('images/home/card3.jpg')],
                    ["Hà Giang 5N4Đ", "5 ngày", "4,500,000", asset('images/home/card4.jpg')],
                    ["Sapa 3N2Đ", "3 ngày", "3,300,000", asset('images/home/card5.jpg')],
                    ["Hội An 2N1Đ", "2 ngày", "1,800,000", asset('images/home/card6.jpg')],
                    ["Đà Nẵng 4N3Đ", "4 ngày", "3,500,000", asset('images/home/card7.jpg')],
                    ["Huế 2N1Đ", "2 ngày", "1,500,000", asset('images/home/card8.jpg')]
                ];
            @endphp

            @foreach ($tours as $tour)
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="tour-card bg-white rounded shadow h-100">
                        <img src="{{ $tour[3] }}" class="w-100" style="height: 160px; object-fit: cover;">
                        <div class="p-3">
                            <h5 class="fw-bold">{{ $tour[0] }}</h5>
                            <p class="text-muted">{{ $tour[1] }}</p>
                            <p class="text-primary fw-bold fs-5">{{ $tour[2] }} VND</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>



@endsection
