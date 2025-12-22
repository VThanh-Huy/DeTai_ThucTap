@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">

    <h2 class="fw-bold mb-4">Trang cá nhân</h2>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-info text-white fw-semibold">
                    Thông tin cá nhân
                </div>

                <div class="card-body">
                    <p class="mb-2">
                        <strong>Họ tên:</strong><br>
                        {{ optional($user->khachHang)->ten_kh ?? $user->name }}
                    </p>

                    <p class="mb-2">
                        <strong>Email:</strong><br>
                        {{ optional($user->khachHang)->email ?? $user->email }}
                    </p>

                    <p class="mb-0">
                        <strong>Số điện thoại:</strong><br>
                        {{ optional($user->khachHang)->sdt ?? 'Chưa cập nhật' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- TOUR ĐÃ ĐẶT -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header fw-semibold">
                    Tour đã đặt
                </div>

                <div class="card-body">

                    @forelse ($bookings as $b)
                        <div class="border rounded p-3 mb-3">

                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="fw-bold mb-1">
                                        {{ $b->tour->ten_tour }}
                                    </h6>

                                    <p class="mb-1 text-muted">
                                        Số lượng: {{ $b->so_luong }}
                                    </p>
                                </div>

                                <span class="badge
                                    @if ($b->trang_thai === 'HOAN_THANH') bg-success
                                    @elseif ($b->trang_thai === 'CHO_XAC_NHAN') bg-warning
                                    @else bg-secondary
                                    @endif
                                ">
                                    {{ $b->trang_thai }}
                                </span>
                            </div>

                            @if ($b->trang_thai === 'HOAN_THANH')
                                <a href="{{ route('tour.show', $b->tour->id_tour) }}"
                                   class="btn btn-sm btn-outline-warning mt-2">
                                    ✍️ Đánh giá tour
                                </a>
                            @endif
                        </div>
                    @empty
                        <p class="text-muted mb-0">Bạn chưa đặt tour nào.</p>
                    @endforelse

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
