@extends('admin.layout')

@section('content')
<h3 class="fw-bold mb-4">📊 Dashboard</h3>

<div class="row g-3">

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Tổng tour</h6>
                <h2 class="fw-bold text-primary">{{ $tourCount }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Tổng đơn</h6>
                <h2 class="fw-bold text-success">{{ $bookingCount }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Đơn chờ duyệt</h6>
                <h2 class="fw-bold text-warning">{{ $pendingBooking }}</h2>
            </div>
        </div>
    </div>


</div>

<div class="row mt-5">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-header fw-bold bg-white">
                🔔 Thông báo
            </div>
            <div class="card-body">
                <p class="text-muted">Không có thông báo mới</p>
            </div>
        </div>
    </div>

</div>
@endsection
