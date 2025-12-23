<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HuongDanVienController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\DiaDiemController;
use App\Http\Controllers\Admin\KhachHangController;
use App\Http\Controllers\Admin\StatisticController;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        // router cho admin về danh sách booking
        Route::get('/bookings', [AdminBookingController::class, 'index'])
            ->name('bookings');

        Route::post('/bookings/{id}/approve', [AdminBookingController::class, 'approve'])
            ->name('bookings.approve');

        Route::post('/bookings/{id}/complete', [AdminBookingController::class, 'complete'])
            ->name('bookings.complete');

        Route::post('/bookings/{id}/cancel', [AdminBookingController::class, 'cancel'])
            ->name('bookings.cancel');

        Route::post('/bookings/{id}/undo',[AdminBookingController::class, 'undo'])
            ->name('bookings.undo');


        // route admin -> user
        Route::get('/users', [UserController::class, 'index'])
            ->name('users');
        Route::post('/users/{id}/change-role', [UserController::class, 'changeRole'])
            ->name('users.changeRole');

        // route admin -> tour
        Route::resource('tour', TourController::class)
            ->except(['show']);

        Route::get('/dia-diem-by-mien/{id}', function ($id) {
            return \App\Models\DiaDiem::where('id_mien', $id)->get();
        });

        // route admin -> địa điểm
        Route::get('/dia_diem', [DiaDiemController::class, 'index'])
            ->name('dia_diem.index');

        Route::post('/dia_diem', [DiaDiemController::class, 'store'])
            ->name('dia_diem.store');

        Route::put('/dia_diem/{id}', [DiaDiemController::class, 'update'])
            ->name('dia_diem.update');

        Route::delete('/dia_diem/{id}', [DiaDiemController::class, 'destroy'])
            ->name('dia_diem.destroy');

        Route::get('/dia-diem-by-mien/{id_mien}', [DiaDiemController::class, 'getByMien']);

        // routes admin -> hdv
        Route::resource('huongdanvien', HuongDanVienController::class)
            ->except(['show']);

        // routes khách hàng
        Route::get('/khachhang', [KhachHangController::class, 'index'])
            ->name('khachhang.index');
        Route::post('/khachhang', [KhachHangController::class, 'store'])
            ->name('khachhang.store');

        Route::put('/khachhang/{id}', [KhachHangController::class, 'update'])
            ->name('khachhang.update');

        Route::delete('/khachhang/{id}', [KhachHangController::class, 'destroy'])
            ->name('khachhang.destroy');

        // routes doanh thu
        Route::get('statistics/revenue',[StatisticController::class, 'revenue'])
            ->name('statistics.revenue');
});
