<h2>Danh sách booking</h2>

@foreach ($bookings as $b)
    <div>
        <p>Tour: {{ $b->tour->ten_tour }}</p>
        <p>Khách: {{ $b->user->name }}</p>
        <p>Số lượng: {{ $b->so_luong }}</p>
        <p>Trạng thái: {{ $b->trang_thai }}</p>

        @if ($b->trang_thai == 'CHO_XAC_NHAN')
            <form method="POST" action="{{ route('admin.bookings.approve', $b->id_booking) }}">
                @csrf
                <button>Duyệt</button>
            </form>

            <form method="POST" action="{{ route('admin.bookings.cancel', $b->id_booking) }}">
                @csrf
                <button>Hủy</button>
            </form>
        @endif
    </div>
@endforeach
