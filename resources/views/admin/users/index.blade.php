@extends('admin.layout')

@section('content')
<h2>Quản lý người dùng</h2>

<table border="1" cellpadding="10" bgcolor="white">
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Email</th>
        <th>Quyền</th>
        <th>Hành động</th>
    </tr>

    @foreach ($users as $u)
    <tr>
        <td>{{ $u->id }}</td>
        <td>{{ $u->name }}</td>
        <td>{{ $u->email }}</td>
        <td>{{ $u->role }}</td>
        <td>
            <form method="POST" action="{{ route('admin.users.changeRole', $u->id) }}">
                @csrf
                <button>Đổi quyền</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
