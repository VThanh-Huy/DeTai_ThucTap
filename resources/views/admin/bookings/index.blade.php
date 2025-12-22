@extends('admin.layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('CSS/StyleAdmin/booking.css') }}">
@endpush
@section('content')
<h2>Quản lý duyệt đặt tour</h2>

<table class="w-100 booking-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tour</th>
            <th>Khách hàng</th>
            <th>Số lượng</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($bookings as $b)
            <tr>
                <td>{{ $b->id_booking }}</td>

                <td>
                    {{ optional($b->tour)->ten_tour ?? '—' }}
                </td>

                <td>
                    {{ optional($b->user)->name ?? '—' }}
                </td>

                <td class="text-center">
                    {{ $b->so_luong }}
                </td>

                <td class="text-center">
                    @if ($b->trang_thai == 'CHO_XAC_NHAN')
                        <span class="badge badge-warning">Chờ xác nhận</span>
                    @elseif ($b->trang_thai == 'DA_XAC_NHAN')
                        <span class="badge badge-success">Đã duyệt</span>
                    @else
                        <span class="badge badge-danger">Đã hủy</span>
                    @endif
                </td>

                <td class="text-center">
                    @if ($b->trang_thai == 'CHO_XAC_NHAN')
                        <form method="POST"
                              action="{{ route('admin.bookings.approve', $b->id_booking) }}"
                              style="display:inline-block">
                            @csrf
                            <button class="btn btn-success btn-sm">
                                Duyệt
                            </button>
                        </form>

                        <form method="POST"
                              action="{{ route('admin.bookings.cancel', $b->id_booking) }}"
                              style="display:inline-block">
                            @csrf
                            <button class="btn btn-danger btn-sm">
                                Hủy
                            </button>
                        </form>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
