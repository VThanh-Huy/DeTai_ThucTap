<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Hiển thị form login
    public function show()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'name';

        if (Auth::attempt([
            $loginType => $request->login,
            'password' => $request->password,
        ])) {
            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'login' => 'Tên đăng nhập hoặc mật khẩu không đúng',
        ]);
    }
}
