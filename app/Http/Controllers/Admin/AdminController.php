<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'tourCount' => Tour::count(),
            'bookingCount' => Booking::count(),
            'pendingBooking' => Booking::where('trang_thai', 'CHO_XAC_NHAN')->count(),
        ]);
    }
}
