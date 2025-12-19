@extends('admin.layout')

@section('content')
    <h1>Trang quản trị</h1>

    <p>Số tour: {{ $tourCount }}</p>
    <p>Tổng đơn: {{ $bookingCount }}</p>
    <p>Đơn chờ duyệt: {{ $pendingBooking }}</p>
@endsection

