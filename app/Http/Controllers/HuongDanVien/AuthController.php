<?php

namespace App\Http\Controllers\HuongDanVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\HuongDanVien;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('huongdanvien.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('huongdanvien')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('huongdanvien.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng'
        ]);
    }

    public function profile()
    {
        $hdv = auth('huongdanvien')->user();
        return view('huongdanvien.profile', compact('hdv'));
    }

    public function logout(Request $request)
    {
        Auth::guard('huongdanvien')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('huongdanvien.login');
    }
    // form đổi mật khẩu
    public function showChangePassword()
    {
        return view('huongdanvien.change-password');
    }

    // xử lý đổi mật khẩu
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        /** @var \App\Models\HuongDanVien $hdv */
        $hdv = auth('huongdanvien')->user();

        // check mật khẩu cũ
        if (!Hash::check($request->current_password, $hdv->password)) {
            return back()->withErrors([
                'current_password' => 'Mật khẩu hiện tại không đúng'
            ]);
        }
        $hdv->password = $request->password; // mutator
        $hdv->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }
}
