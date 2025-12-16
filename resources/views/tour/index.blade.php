@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tours.css') }}">
@endpush
@section('content')
    <!-- HERO IMAGE -->
    <div class="w-100">
        <img src="{{ asset('https://i.pinimg.com/1200x/ec/ad/20/ecad20438395bd4e8e67e0f1969be794.jpg') }}"
            class="img-fluid w-100 hero-img" alt="Tour Image">
    </div>


    <div class="container mt-5">

        <h2 class="fw-bold mb-4">Danh sách tour</h2>

        <div class="row g-4">

            @foreach ($tours as $tour)
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">

                        <img src="{{ asset('images/tours/' . $tour->hinh_anh) }}" class="card-img-top"
                            style="height:200px; object-fit:cover;">

                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $tour->ten_tour }}</h5>

                            <p class="text-muted">{{ $tour->so_ngay }} ngày</p>

                            <p class="text-danger fw-bold">
                                {{ number_format($tour->gia_tien, 0, ',', '.') }} VND
                            </p>

                            <!-- ⭐ Hiển thị sao -->
                            @php
                                $rating = round($tour->reviews_avg_so_sao ?? 0);
                            @endphp

                            <div class="mb-2 text-warning">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rating)
                                        ⭐
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>


                            <a href="{{ route('tour.show', $tour->id_tour) }}" class="btn btn-primary w-100">
                                Xem chi tiết
                            </a>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <!-- PHÂN TRANG -->
        <div class="mt-5 d-flex justify-content-center">
            {{ $tours->onEachSide(1)->links('vendor.pagination.tour-pagination') }}

        </div>


    </div>
@endsection
