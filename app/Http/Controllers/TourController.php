<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class TourController extends Controller
{

    public function index(Request $request)
    {
        $query = Tour::withAvg('reviews', 'so_sao');

        if ($request->filled('keyword')) {
            $query->where('ten_tour', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('start_date')) {
            $query->whereDate('ngay_bat_dau', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('ngay_ket_thuc', '<=', $request->end_date);
        }

        $tours = $query
            ->orderBy('id_tour', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('tour.index', compact('tours'));
    }


    public function show($id)
    {
        $tour = Tour::with([
            'huongDanVien',
            'diaDiems',
            'reviews' => function ($q) {
                $q->whereNotNull('user_id');
            },
            'reviews.user'
        ])->findOrFail($id);


        $daDatTour = false;
        $daDanhGia = false;

        if (Auth::check()) {
            // Kiểm tra đã đặt tour chưa
            $daDatTour = Booking::where('user_id', Auth::id())
                ->where('id_tour', $id)
                ->exists();

            // Kiểm tra đã đánh giá chưa
            $daDanhGia = Review::where('user_id', Auth::id())
                ->where('id_tour', $id)
                ->exists();
        }

        return view('tour.show', compact(
            'tour',
            'daDatTour',
            'daDanhGia'
        ));
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
