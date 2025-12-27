@extends('admin.layout')
@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/StyleAdmin/stylehdv.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/StyleAdmin/table_all.css') }}">
@endpush
@section('content')
    <h2>Quản lý hướng dẫn viên</h2>

    <button class="btn btn-outline-info" onclick="openCreateModal()">
        Thêm
    </button>

    <table class="w-100">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Giới tính</th>
            <th>Năm bắt đầu</th>
            <th>Ngoại ngữ</th>
            <th>Số năm kinh nghiệm</th>
            <th>Lĩnh vực</th>
        </tr>

        @foreach ($huongdanvien as $hdv)
            <tr class="ds_hdv">
                <td>{{ $hdv->id_hdv }}</td>
                <td>{{ $hdv->ten_hdv }}</td>
                <td>{{ $hdv->email }}</td>
                <td>{{ $hdv->gioi_tinh }}</td>
                <td>{{ $hdv->nam_bat_dau }}</td>
                <td>{{ $hdv->ngon_ngu }}</td>
                <td>{{ now()->year - $hdv->nam_bat_dau }} năm</td>
                <td>{{ $hdv->kinh_nghiem }}</td>
                <td>
                    <button class="btn btn-outline-info" onclick="openEditModal({{ $hdv }})">Sửa</button>
                    <button class="btn btn-outline-danger" onclick="openDeleteModal({{ $hdv->id_hdv }})">Xóa</button>
                </td>

            </tr>
        @endforeach
    </table>
    <div id="createModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCreateModal()">&times;</span>

            <h3>Thêm hướng dẫn viên</h3>

            <form id="createForm" method="POST" action="{{ route('admin.huongdanvien.store') }}">
                @csrf

                <input name="ten_hdv" placeholder="Tên"required>
                <input name="email" placeholder="Email" required>
                <input type="date" name="ngay_sinh" required>
                <input name="sdt" placeholder="Số điện thoại">
                <select name="gioi_tinh" required>
                    <option value="" >-- Giới tính --</option>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>

                <input type="number" name="nam_bat_dau" placeholder="Năm bắt đầu" required>
                <input name="ngon_ngu" placeholder="Ngoại ngữ" required>
                <input name="kinh_nghiem" placeholder="Lĩnh vực" required>

                <button type="submit">Thêm</button>
            </form>
        </div>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>

            <h3>Cập nhật hướng dẫn viên</h3>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <input id="edit_ten_hdv" name="ten_hdv">
                <input id="edit_email" name="email">
                <input id="edit_ngay_sinh" type="date" name="ngay_sinh">
                <input id="edit_sdt" name="sdt">
                <input id="edit_nam_bat_dau" type="number" name="nam_bat_dau">
                <input id="edit_ngon_ngu" name="ngon_ngu">
                <input id="edit_kinh_nghiem" name="kinh_nghiem">

                <button type="submit">Cập nhật</button>
            </form>
        </div>
    </div>


    <div id="deleteModal" class="modal">
        <div class="modal-content delete-box">
            <h3>Xác nhận xóa</h3>

            <p>
                Bạn có chắc chắn muốn xóa hướng dẫn viên này?<br>
            </p>

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
        <script src="{{ asset('js/huongdanvien.js') }}"></script>
    @endpush
@endsection
