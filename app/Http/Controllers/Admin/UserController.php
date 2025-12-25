<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function changeRole($id)
    {
        $user = User::findOrFail($id);

        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return back()->with('success', 'Đã cập nhật quyền');
    }
    public function create()
    {
        $admins = Admin::all();

        return view('admin.admins.index', compact('admins'));
    }
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        if ($admin->role === 'SUPER_ADMIN') {
            return back()->with('error', 'Không thể sửa SUPER ADMIN');
        }

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return back()->with('success', 'Cập nhật admin thành công');
    }

    public function store(Request $request)
    {

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success', 'Tạo admin thành công');
    }
}
