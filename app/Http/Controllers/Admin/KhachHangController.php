<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KhachHang;
use Illuminate\Http\Request;
class KhachHangController extends Controller
{
    public function index() {
        return view('admin.khachhang.index', [
            'khachhang' => KhachHang::all()
        ]);
    }

    public function store(Request $r) {
        KhachHang::create($r->all());
        return back()->with('success','Đã thêm khách hàng');
    }

    public function update(Request $r, $id) {
        KhachHang::findOrFail($id)->update($r->all());
        return back()->with('success','Đã cập nhật');
    }

    public function destroy($id) {
        KhachHang::destroy($id);
        return back()->with('success','Đã xóa');
    }
}
