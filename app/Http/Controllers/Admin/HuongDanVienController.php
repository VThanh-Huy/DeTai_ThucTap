<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HuongDanVien;
use Illuminate\Http\Request;


class HuongDanVienController extends Controller
{
    // LIST
    public function index()
    {
        $huongdanvien = HuongDanVien::all();
        return view('admin.huongdanvien.index', compact('huongdanvien'));
    }

    public function create()
    {
        return view('admin.huongdanvien.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'ten_hdv' => 'required',
        'email' => 'required|email|unique:huong_dan_vien,email',
        'nam_bat_dau' => 'required|integer'
    ]);

    HuongDanVien::create([
        'ten_hdv' => $request->ten_hdv,
        'email' => $request->email,
        'password' => 'HDV@2025', // tự hash qua mutator
        'ngay_sinh' => $request->ngay_sinh,
        'gioi_tinh' => $request->gioi_tinh,
        'sdt' => $request->sdt,
        'nam_bat_dau' => $request->nam_bat_dau,
        'ngon_ngu' => $request->ngon_ngu,
        'kinh_nghiem' => $request->kinh_nghiem,
    ]);

    return redirect()
        ->route('admin.huongdanvien.index')
        ->with('success', 'Đã thêm HDV. Mật khẩu mặc định: HDV@2025');
}

    public function edit($id)
    {
        $huongdanvien = HuongDanVien::findOrFail($id);
        return view('admin.huongdanvien.edit', compact('huongdanvien'));
    }

   
    public function update(Request $request, $id)
    {
        $hdv = HuongDanVien::findOrFail($id);
        $hdv->update($request->all());

        return redirect()
            ->route('admin.huongdanvien.index')
            ->with('success', 'Cập nhật thành công');
    }

    
    public function destroy($id)
    {
        $hdv = HuongDanVien::findOrFail($id);

        if ($hdv->tours()->count() > 0) {
            return back()->with(
                'error',
                'Không thể xóa: Hướng dẫn viên đang được gán cho tour'
            );
        }

        $hdv->delete();

        return redirect()
            ->route('admin.huongdanvien.index')
            ->with('success', 'Đã xóa');

    }
}
