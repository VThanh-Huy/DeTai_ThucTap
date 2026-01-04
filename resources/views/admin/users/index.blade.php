@extends('admin.layout')
@push('style')
<link rel="stylesheet" href="{{ asset('CSS/StyleAdmin/stylehdv.css') }}">
@section('content')
<h2>Quản lý người dùng</h2>

<table class="w-100 admin-table table-fixed">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $u)
            <tr>
                <td>{{ $u->id }}</td>

                <td>{{ $u->name }}</td>

                <td>{{ $u->email }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
@endsection
