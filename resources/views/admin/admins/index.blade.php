@extends('admin.layout')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Quản trị Admin</h4>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAdminModal">
                Tạo quản trị
            </button>
        </div>

        <!-- TABLE -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="80">ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th width="200">Vai trò</th>
                            <th>Chỉnh sửa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admins as $ad)
                            <tr>
                                <td>{{ $ad->id }}</td>
                                <td class="fw-semibold">{{ $ad->name }}</td>
                                <td>{{ $ad->email }}</td>

                                <td>
                                    @if ($ad->role === 'SUPER_ADMIN')
                                        <span class="badge bg-info">Admin</span>
                                    @elseif($ad->role === 'BOOKING_STAFF')
                                        <span class="badge bg-info">Quản trị booking</span>
                                    @else
                                        <span class="badge bg-info">Quản trị tour & guider</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($ad->role !== 'SUPER_ADMIN')
                                        <!-- EDIT -->
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#editAdminModal{{ $ad->id }}">
                                            ✏️
                                        </button>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Chưa có admin nào
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @foreach ($admins as $ad)
                    @if ($ad->role !== 'SUPER_ADMIN')
                        <div class="modal fade" id="editAdminModal{{ $ad->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <form method="POST" action="{{ route('admin.users.update', $ad->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Cập nhật admin</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label>Tên</label>
                                                <input type="text" name="name" value="{{ $ad->name }}"
                                                    class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label>Email</label>
                                                <input type="email" name="email" value="{{ $ad->email }}"
                                                    class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label>Vai trò</label>
                                                <select name="role" class="form-select">
                                                    <option value="BOOKING_STAFF" @selected($ad->role == 'BOOKING_STAFF')>
                                                        Nhân viên duyệt booking
                                                    </option>
                                                    <option value="TOUR_MANAGER" @selected($ad->role == 'TOUR_MANAGER')>
                                                        Nhân viên phân công HDV
                                                    </option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                            <button class="btn btn-primary">Lưu</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>

    <!-- thêm admin -->
    <div class="modal fade" id="createAdminModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Thêm nhân viên admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Tên</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Vai trò</label>
                            <select name="role" class="form-select">
                                <option value="BOOKING_STAFF">
                                    Nhân viên duyệt booking
                                </option>
                                <option value="TOUR_ASSIGN_STAFF">
                                    Nhân viên phân công HDV
                                </option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Hủy
                        </button>

                        <button class="btn btn-primary">
                            Tạo admin
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
