<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingApprovedMail;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['tour', 'user'])
            ->orderBy('ngay_dat', 'desc')
            ->paginate(6);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function approve($id)
    {
        // 1. Cập nhật trạng thái

        $booking = Booking::with(['user', 'tour'])
            ->where('id_booking', $id)
            ->firstOrFail(); // lấy bản ghi thỏa điều kiện

        $booking->update([
            'trang_thai' => 'DA_XAC_NHAN'
        ]);

        // 2. Lấy địa chỉ email và gửi mail
        Mail::to($booking->user->email)// lấy đ/c: từ booking lấy user -> từ user ra email
            ->send(new BookingApprovedMail($booking)); // tạo ra một đối tượng

        return back()->with('success', 'Đã duyệt đơn'); // đưa vào session
    }

    public function complete($id)
    {
        Booking::where('id_booking', $id)
            ->update(['trang_thai' => 'HOAN_THANH']);

        return back()->with('success', 'Đã hoàn thành tour');
    }

    public function cancel($id)
    {
        Booking::where('id_booking', $id)
            ->update(['trang_thai' => 'DA_HUY']);

        return back()->with('success', 'Đã hủy đơn');
    }

    public function undo($id)
    {
        $booking = Booking::findOrFail($id);

        if (in_array($booking->trang_thai, ['HOAN_THANH', 'DA_HUY'])) {
            $booking->update([
                'trang_thai' => 'DA_XAC_NHAN'
            ]);
        }

        return back()->with('success', 'Hoàn tác trạng thái thành công!');
    }
}
