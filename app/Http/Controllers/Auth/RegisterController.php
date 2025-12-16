<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'sdt' => 'required|unique:khach_hang,sdt',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.unique' => 'Email đã được sử dụng',
            'sdt.unique' => 'Số điện thoại đã tồn tại',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
        ]);

        // Tạo user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Tạo khách hàng
        KhachHang::create([
            'ten_kh' => $request->name,
            'email' => $request->email,
            'sdt' => $request->sdt,
            'user_id' => $user->id,
        ]);

        Auth::login($user);
        return redirect('/')->with('success', 'Đăng ký thành công!');
    }
}
