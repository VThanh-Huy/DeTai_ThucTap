<h1>Trang quản trị</h1>

<p>Số tour: {{ $tourCount }}</p>
<p>Tổng đơn: {{ $bookingCount }}</p>
<p>Đơn chờ duyệt: {{ $pendingBooking }}</p>

<a href="{{ route('admin.bookings') }}">Quản lý booking</a>
<form method="POST" action="/logout">
    {{-- @csrf ? --}}
    @csrf 
    <button class="dropdown-item text-danger">
        Đăng xuất
    </button>
</form>
