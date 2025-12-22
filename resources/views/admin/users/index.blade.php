@extends('admin.layout')
@push('style')
<link rel="stylesheet" href="{{ asset('CSS/StyleAdmin/user.css') }}">
@section('content')
<h2>Quản lý người dùng</h2>

<table class="w-100 admin-table table-fixed">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Quyền</th>
            <th class="text-center">Hành động</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $u)
            <tr>
                <td>{{ $u->id }}</td>

                <td>{{ $u->name }}</td>

                <td>{{ $u->email }}</td>

                <td>
                    @if ($u->role === 'admin')
                        <span class="badge badge-danger">Admin</span>
                    @else
                        <span class="badge badge-info">User</span>
                    @endif
                </td>

                <td class="text-center">
                    <form method="POST"
                          action="{{ route('admin.users.changeRole', $u->id) }}"
                          onsubmit="return confirm('Bạn có chắc muốn đổi quyền người dùng này?')">
                        @csrf
                        <button class="btn btn-warning btn-sm">
                            Đổi quyền
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
