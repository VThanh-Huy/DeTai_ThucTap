<?php

namespace App\Http\Controllers\HuongDanVien;

use App\Http\Controllers\Controller;

class TourHDVController extends Controller
{
    public function dashboard()
    {
        $hdv = auth('huongdanvien')->user();
        $tours = $hdv->tours;

        return view('huongdanvien.dashboard', compact('tours'));
    }
}
