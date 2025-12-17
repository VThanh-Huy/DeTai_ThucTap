<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['tour', 'user'])
            ->orderBy('ngay_dat', 'desc')
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function approve($id)
    {
        Booking::where('id_booking', $id)
            ->update(['trang_thai' => 'DA_XAC_NHAN']);

        return back()->with('success', 'Đã duyệt đơn');
    }

    public function cancel($id)
    {
        Booking::where('id_booking', $id)
            ->update(['trang_thai' => 'DA_HUY']);

        return back()->with('success', 'Đã hủy đơn');
    }
}
