@extends('admin.layout')
@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/StyleAdmin/stylehdv.css') }}">
@endpush
@section('content')
<h2>Quản lý khách hàng</h2>

<button class="btn btn-outline-info" onclick="openCreateModal()">
    Thêm khách hàng
</button>

<table class="w-100 mt-3 table table-bordered table-fixed">
    <tr class="ds_kh">
        <th>ID</th>
        <th>Tên khách</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>Id tài khoản</th>
        <th>Thao tác</th>
    </tr>

    @foreach ($khachhang as $kh)
        <tr>
            <td>{{ $kh->id_kh }}</td>
            <td>{{ $kh->ten_kh }}</td>
            <td>{{ $kh->email }}</td>
            <td>{{ $kh->sdt }}</td>
            <td>{{ $kh->user_id }}</td>
            <td>
                <button class="btn btn-outline-info"
                    onclick="openEditModal({{ $kh }})">
                    Sửa
                </button>

                <button class="btn btn-outline-danger"
                    onclick="openDeleteModal({{ $kh->id_kh }})">
                    Xóa
                </button>
            </td>
        </tr>
    @endforeach
</table>

{{-- thêm --}}
<div id="createModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeCreateModal()">&times;</span>
        <h3>Thêm khách hàng</h3>

        <form id="createForm" method="POST"
              action="{{ route('admin.khachhang.store') }}">
            @csrf
            <input name="ten_kh" placeholder="Tên khách" required>
            <input name="email" placeholder="Email">
            <input name="sdt" placeholder="Số điện thoại">
            <input name="user_id" placeholder="Địa chỉ">

            <button type="submit">Thêm</button>
        </form>
    </div>
</div>

{{-- sửa --}}
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h3>Cập nhật khách hàng</h3>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <input id="edit_ten_kh" name="ten_kh" required>
            <input id="edit_email" name="email">
            <input id="edit_sdt" name="sdt">
            <input id="edit_user_id" name="user_id">

            <button type="submit">Cập nhật</button>
        </form>
    </div>
</div>

{{-- xóa --}}
<div id="deleteModal" class="modal">
    <div class="modal-content delete-box">
        <h3>Xác nhận xóa</h3>
        <p>Bạn có chắc chắn muốn xóa khách hàng này?</p>

        <div class="actions">
            <button class="btn btn-secondary"
                onclick="closeDeleteModal()">Hủy</button>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Xóa</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('JS/khachhang.js') }}"></script>
@endpush
@endsection
