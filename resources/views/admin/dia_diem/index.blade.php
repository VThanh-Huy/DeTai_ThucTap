@extends('admin.layout')
@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/StyleAdmin/stylehdv.css') }}">
@endpush
@section('content')
<div class="row">
<h2 class="col-lg-10">Quản lý địa điểm</h2>

<button class="btn btn-outline-info col-lg-1 me-1" onclick="openCreateModal()">
    Thêm
</button>
</div>


<table class="w-100 mt-3 table table-bordered table-fixed">
    <tr>
        <th>ID</th>
        <th>Tên địa điểm</th>
        <th>Miền</th>
        <th>Thao tác</th>
    </tr>

    @foreach ($diaDiems as $dd)
        <tr>
            <td>{{ $dd->id_dd }}</td>
            <td>{{ $dd->ten_dia_diem }}</td>
            <td>{{ $dd->mien->ten_mien }}</td>
            <td>
                <button class="btn btn-outline-info"
                    onclick="openEditModal({{ $dd }})">
                    Sửa
                </button>

                <button class="btn btn-outline-danger"
                    onclick="openDeleteModal({{ $dd->id_dd }})">
                    Xóa
                </button>
            </td>
        </tr>
    @endforeach
</table>
    <div class="d-flex justify-content-center mt-3">
        {{ $diaDiems->links('pagination::bootstrap-5') }}
    </div>

{{-- thêm --}}
<div id="createModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeCreateModal()">&times;</span>

        <h3>Thêm địa điểm</h3>

        <form id="createForm" method="POST"
              action="{{ route('admin.dia_diem.store') }}">
            @csrf

            <input name="ten_dia_diem" placeholder="Tên địa điểm" required>

            <select name="id_mien" required>
                <option value="">-- Chọn miền --</option>
                @foreach ($miens as $mien)
                    <option value="{{ $mien->id_mien }}">
                        {{ $mien->ten_mien }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Thêm</button>
        </form>
    </div>
</div>

{{-- sửa --}}
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>

        <h3>Cập nhật địa điểm</h3>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <input id="edit_ten_dia_diem" name="ten_dia_diem" required>

            <select id="edit_id_mien" name="id_mien" required>
                @foreach ($miens as $mien)
                    <option value="{{ $mien->id_mien }}">
                        {{ $mien->ten_mien }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Cập nhật</button>
        </form>
    </div>
</div>

{{-- xóa --}}
<div id="deleteModal" class="modal">
    <div class="modal-content delete-box">
        <h3>Xác nhận xóa</h3>

        <p>Bạn có chắc chắn muốn xóa địa điểm này?</p>

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
    <script src="{{ asset('js/diadiem.js') }}"></script>
@endpush
@endsection
