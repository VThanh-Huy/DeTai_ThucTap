@extends('admin.layout')
@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/StyleAdmin/stylehdv.css') }}">
@endpush
@section('content')
    <h2>Quản lý tour</h2>

    <button class="btn btn-outline-info" onclick="openCreateModal()">Thêm tour</button>

    <table class="w-100">
        <tr>
            <th>ID</th>
            <th>Tên tour</th>
            <th>Giá</th>
            <th>Thời gian</th>
            <th>Mô tả</th>
            <th>Số chỗ</th>
            <th>Hình ảnh</th>
            <th>Hướng dẫn viên</th>
            <th>Ngày khởi hành</th>
            <th>Trạng thái</th>
            <th>Chỉnh sửa</th>
        </tr>

        @foreach ($tours as $tour)
            <tr>
                <td>{{ $tour->id_tour }}</td>
                <td>{{ $tour->ten_tour }}</td>
                <td>{{ number_format($tour->gia_tien) }}đ</td>
                <td>{{ $tour->so_ngay }} ngày</td>
                <td>{{ $tour->mo_ta }}</td>
                <td>{{ $tour->so_cho }}</td>
                <td>{{ $tour->hinh_anh }}</td>
                <td>{{ $tour->id_hdv }}</td>
                <td>{{ $tour->ngay_bat_dau }}</td>
                <td>{{ $tour->trang_thai }}</td>

                <td>
                    <button class="btn btn-outline-info" onclick="openEditModal({{ $tour }})">Sửa</button>
                    <button class="btn btn-outline-danger" onclick="openDeleteModal({{ $tour->id_tour }})">Xóa</button>
                </td>
            </tr>
        @endforeach
    </table>

    <div id="createModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCreateModal()">&times;</span>

            <h3>Thêm tour</h3>

            <form method="POST" action="{{ route('admin.tour.store') }}">
                @csrf
                <input name="ten_tour" placeholder="Tên tour">
                <input name="gia_tien" type="number" placeholder="Giá">
                <input name="so_ngay" type="number" placeholder="Số ngày">

                <textarea name="mo_ta" placeholder="Mô tả"></textarea>

                <button type="submit">Thêm</button>
            </form>
        </div>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>

            <h3>Cập nhật tour</h3>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <input id="edit_ten_tour" name="ten_tour">
                <input id="edit_gia_tien" type="number" name="gia_tien">
                <input id="edit_so_ngay" type="number" name="so_ngay">
                <textarea id="edit_mo_ta" name="mo_ta"></textarea>

                <button type="submit">Cập nhật</button>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content delete-box">
            <h3>Xác nhận xóa</h3>

            <p>Bạn có chắc muốn xóa tour này?</p>

            <div class="actions">
                <button class="btn btn-secondary" onclick="closeDeleteModal()">
                    Hủy
                </button>

                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('JS/tour.js') }}"></script>
    @endpush
@endsection
