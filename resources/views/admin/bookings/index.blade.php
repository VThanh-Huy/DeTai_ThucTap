@extends('admin.layout')

@section('content')
    <h2>Danh sách booking</h2>

    @foreach ($bookings as $b)
        <div style="border:1px solid #ccc; margin:10px; padding:10px; background:white">
            <p>Tour: {{ optional($b->tour)->ten_tour }}</p>
            <p>Khách: {{ optional($b->user)->name }}</p>
            <p>Số lượng: {{ $b->so_luong }}</p>
            <p>Trạng thái: {{ $b->trang_thai }}</p>

            @if ($b->trang_thai == 'CHO_XAC_NHAN')
                <form method="POST" action="{{ route('admin.bookings.approve', $b->id_booking) }}">
                    @csrf
                    <button>Duyệt</button>
                </form>

                <form method="POST" action="{{ route('admin.bookings.cancel', $b->id_booking) }}">
                    @csrf
                    <button>Huỷ</button>
                </form>
            @endif
        </div>
    @endforeach
@endsection
