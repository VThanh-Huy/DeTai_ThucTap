<?php

namespace App\Http\Controllers\HuongDanVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
