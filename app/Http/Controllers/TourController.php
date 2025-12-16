<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::withAvg('reviews', 'so_sao')
            ->orderBy('id_tour', 'desc')
            ->paginate(9);

        return view('tour.index', compact('tours'));
    }


    public function show($id)
    {
        $tour = Tour::with([
            'huongDanVien',
            'lichTrinh',
            'diaDiems',
            'reviews.user'
        ])->findOrFail($id);

        return view('tour.show', compact('tour'));
    }

    public function datTour(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);

        $request->validate([
            'so_luong' => 'required|integer|min:1',
            'phuong_thuc_tt' => 'required',
        ]);
        
        Booking::create([
            'user_id'  => Auth::id(),
            'id_tour' => $id,
            'ngay_dat' => now(),
            'so_luong' => $request->so_luong,
            'tong_tien' => $tour->gia_tien * $request->so_luong,
            'phuong_thuc_tt' => $request->phuong_thuc_tt,
            'trang_thai' => 'CHO_XAC_NHAN',
        ]);

        return redirect()
            ->route('tour.index')
            ->with('success', 'Đặt tour thành công! Vui lòng chờ xác nhận.');
    }
}


