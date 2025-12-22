@extends('admin.layout')
@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/StyleAdmin/stylehdv.css') }}">
@endpush
@section('content')
    <h2>Quản lý tour</h2>

    <button class="btn btn-outline-info" onclick="openCreateModal()">Thêm tour</button>

    <table class="w-100 table table-bordered table-fixed">
        <tr>
            <th>ID</th>
            <th>Tên tour</th>
            <th>Giá</th>
            <th>Thời gian</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>

        @foreach ($tours as $tour)
            <tr>
                <td>{{ $tour->id_tour }}</td>
                <td>{{ $tour->ten_tour }}</td>
                <td>{{ number_format($tour->gia_tien) }}đ</td>
                <td>{{ $tour->so_ngay }} ngày</td>

                <td>
                    @if ($tour->trang_thai === 1)
                        <span class="badge badge-info">Đang mở</span>
                    @else
                        <span class="badge badge-danger">Đã đóng</span>
                    @endif
                </td>
                <td>
                    <button class="btn btn-outline-primary" onclick='openDetailModal(@json($tour))'>
                        Xem chi tiết
                    </button>
                </td>
            </tr>
        @endforeach
    </table>


    <div id="detailModal" class="modal">
    <div class="modal-content detail-modal">

        <!-- HEADER -->
        <div class="modal-header">
            <span class="close" onclick="closeDetailModal()">&times;</span>
            <h4 id="detail_ten_tour" class="fw-bold mb-0"></h4>
        </div>

        <!-- BODY -->
        <div class="modal-body">

            <div class="row g-3">
                <!-- THÔNG TIN -->
                <div class="col-md-7">
                    <div class="info-box">
                        <p><strong>Giá:</strong> <span id="detail_gia"></span></p>
                        <p><strong>Số ngày:</strong> <span id="detail_so_ngay"></span></p>
                        <p><strong>Số chỗ:</strong> <span id="detail_so_cho"></span></p>
                        <p><strong>Ngày khởi hành:</strong> <span id="detail_ngay"></span></p>
                        <p><strong>Miền:</strong> <span id="detail_mien"></span></p>
                        <p><strong>Hướng dẫn viên:</strong> <span id="detail_hdv"></span></p>
                    </div>
                </div>

                <!-- HÌNH ẢNH -->
                <div class="col-md-5 text-center">
                    <img id="detail_image" class="img-fluid rounded shadow"
                        src="" alt="Ảnh tour">
                </div>
            </div>

            <!-- MÔ TẢ -->
            <div class="mt-4">
                <h6 class="fw-bold">Mô tả</h6>
                <p id="detail_mo_ta" class="text-muted"></p>
            </div>

            <!-- ĐỊA ĐIỂM -->
            <div class="mt-3">
                <h6 class="fw-bold">Địa điểm</h6>
                <ul id="detail_dia_diem" class="list-group list-group-flush"></ul>
            </div>

        </div>

        <!-- FOOTER -->
        <div class="modal-footer actions">
            <button class="btn btn-outline-primary" id="btnEditTour">
                ✏️ Sửa
            </button>

            <button class="btn btn-outline-danger" id="btnDeleteTour">
                🗑️ Xóa
            </button>
        </div>

    </div>
</div>



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

            <form id="editForm" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')

                <label>Tên tour</label>
                <input id="edit_ten_tour" name="ten_tour">

                <label>Giá tiền</label>
                <input id="edit_gia_tien" type="number" name="gia_tien">

                <label>Số ngày</label>
                <input id="edit_so_ngay" type="number" name="so_ngay">
                <label>Hướng dẫn viên</label>
                <select id="edit_id_hdv" name="id_hdv">
                    <option value="">-- Chọn hướng dẫn viên --</option>
                    @foreach ($hdvs as $hdv)
                        <option value="{{ $hdv->id_hdv }}">
                            {{ $hdv->ten_hdv }}
                        </option>
                    @endforeach
                </select>

                <select id="mienSelect">
                    <option value="">-- Chọn miền --</option>
                    @foreach ($miens as $mien)
                        <option value="{{ $mien->id_mien }}">{{ $mien->ten_mien }}</option>
                    @endforeach
                </select>
                <label>Hình ảnh</label>
                <input type="file" name="hinh_anh" accept="image/*">

                <div id="diaDiemBox"></div>

                <textarea id="edit_mo_ta" class="w-100" name="mo_ta" required></textarea>

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