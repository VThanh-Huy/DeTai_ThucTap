<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 
class StatisticController extends Controller

{
    public function revenue(Request $request)
    {
        // Tổng doanh thu
        $totalRevenue = Booking::where('trang_thai', 'HOAN_THANH')
            ->sum('tong_tien');

        // Doanh thu hôm nay
        $todayRevenue = Booking::where('trang_thai', 'HOAN_THANH')
            ->whereDate('ngay_dat', Carbon::today())
            ->sum('tong_tien');

        // Doanh thu tháng hiện tại
        $monthRevenue = Booking::where('trang_thai', 'HOAN_THANH')
            ->whereMonth('ngay_dat', Carbon::now()->month)
            ->whereYear('ngay_dat', Carbon::now()->year)
            ->sum('tong_tien');

        // Doanh thu theo tour
        $revenueByTour = Booking::select(
                'id_tour',
                DB::raw('SUM(tong_tien) as total')
            )
            ->where('trang_thai', 'HOAN_THANH')
            ->groupBy('id_tour')
            ->with('tour')
            ->get();

        // Lọc theo khoảng ngày
        $from = $request->from;
        $to   = $request->to;

        $rangeRevenue = null;

        if ($from && $to) {
            $rangeRevenue = Booking::where('trang_thai', 'HOAN_THANH')
                ->whereBetween('ngay_dat', [$from, $to])
                ->sum('tong_tien');
        }

        return view('admin.statistics.revenue', compact(
            'totalRevenue',
            'todayRevenue',
            'monthRevenue',
            'revenueByTour',
            'rangeRevenue',
            'from',
            'to'
        ));
    }
}