<?php

namespace App\Http\Controllers;
use App\Models\Tour;
use App\Models\Booking;
use App\Models\User;
use App\Models\KhachHang;

class DashBoardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'tourCount'       => Tour::count(),
            'bookingCount'    => Booking::count(),
            'pendingBooking'  => Booking::where('trang_thai', 'CHO_XAC_NHAN')->count(),
        ]);
    }
}
