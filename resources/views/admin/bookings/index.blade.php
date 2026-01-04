@extends('admin.layout')
@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/StyleAdmin/stylehdv.css') }}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-clipboard-check"></i>
                    Quản lý duyệt đặt tour
                </h5>
            </div>

            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>ID</th>
                            <th class="text-start">Tour</th>
                            <th class="text-start">Khách hàng</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th>Ngày đặt</th>
                            <th width="220">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($bookings as $b)
                            <tr>
                                <td class="text-center">{{ $b->id_booking }}</td>

                                <td>
                                    {{ optional($b->tour)->ten_tour ?? '—' }}
                                </td>

                                <td>
                                    {{ optional($b->user)->name ?? '—' }}
                                </td>

                                <td class="text-center">
                                    <span class="fw-bold">{{ $b->so_luong }}</span>
                                </td>

                                <td class="text-center">
                                    @switch($b->trang_thai)
                                        @case('CHO_XAC_NHAN')
                                            <span class="badge bg-warning text-dark">
                                                Chờ xác nhận
                                            </span>
                                        @break

                                        @case('DA_XAC_NHAN')
                                            <span class="badge bg-success">
                                                Đã duyệt
                                            </span>
                                        @break

                                        @case('HOAN_THANH')
                                            <span class="badge bg-info text-dark">
                                                Hoàn thành
                                            </span>
                                        @break

                                        @case('DA_HUY')
                                            <span class="badge bg-danger">
                                                Đã hủy
                                            </span>
                                        @break
                                    @endswitch
                                </td>

                                <td>{{ $b ->ngay_dat }}</td>
                                <td class="text-center">
                                    @if ($b->trang_thai === 'CHO_XAC_NHAN')
                                        <div class="btn-group "role="group">
                                            <form method="POST"
                                                action="{{ route('admin.bookings.approve', $b->id_booking) }}">
                                                @csrf
                                                <button class="btn btn-success">
                                                    Duyệt
                                                </button>
                                            </form>

                                            <form method="POST"
                                                action="{{ route('admin.bookings.cancel', $b->id_booking) }}">
                                                @csrf
                                                <button class="btn btn-danger ms-1">
                                                    Hủy
                                                </button>
                                            </form>
                                        </div>
                                    @elseif ($b->trang_thai === 'DA_XAC_NHAN')
                                        <div class="btn-group btn-group-sm">
                                            <form method="POST"
                                                action="{{ route('admin.bookings.complete', $b->id_booking) }}">
                                                @csrf
                                                <button class="btn btn-info">
                                                    Hoàn thành
                                                </button>
                                            </form>


                                        </div>
                                    @else
                                        <form method="POST" action="{{ route('admin.bookings.undo', $b->id_booking) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-secondary">
                                                Hoàn tác
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $bookings->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
