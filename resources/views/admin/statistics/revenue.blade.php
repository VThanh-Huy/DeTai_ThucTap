@extends('admin.layout')

@section('content')
<h2 class="mb-4">Thống kê doanh thu</h2>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Tổng doanh thu</h6>
                <h3 class="fw-bold text-success">
                    {{ number_format($totalRevenue) }} đ
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Doanh thu hôm nay</h6>
                <h3 class="fw-bold text-primary">
                    {{ number_format($todayRevenue) }} đ
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Doanh thu tháng này</h6>
                <h3 class="fw-bold text-warning">
                    {{ number_format($monthRevenue) }} đ
                </h3>
            </div>
        </div>
    </div>
</div>

<hr>

<h4>Lọc doanh thu theo khoảng ngày</h4>

<form method="GET" class="row g-3 mb-4">
    <div class="col-md-4">
        <input type="date" name="from" class="form-control"
               value="{{ $from }}">
    </div>
    <div class="col-md-4">
        <input type="date" name="to" class="form-control"
               value="{{ $to }}">
    </div>
    <div class="col-md-4">
        <button class="btn btn-outline-primary">
            Lọc
        </button>
    </div>
</form>

@if ($rangeRevenue !== null)
    <div class="alert alert-info">
        Doanh thu từ <b>{{ $from }}</b> đến <b>{{ $to }}</b>:
        <b>{{ number_format($rangeRevenue) }} đ</b>
    </div>
@endif

<hr>

<h4>Doanh thu theo tour</h4>

<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>Tour</th>
            <th>Doanh thu</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($revenueByTour as $row)
            <tr>
                <td>{{ $row->tour->ten_tour ?? 'N/A' }}</td>
                <td>{{ number_format($row->total) }} đ</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
