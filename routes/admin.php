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
use App\Http\Controllers\Admin\AdminAuthController;


Route::prefix('admin')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])
            ->name('admin.login');

        Route::post('/login', [AdminAuthController::class, 'login'])
            ->name('admin.login.submit');
    });
});


Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth:admin')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        // super admin
        Route::middleware('admin.role:SUPER_ADMIN')->group(function () {

            // quản lý admin / user
            Route::get('/users', [UserController::class, 'index'])
                ->name('users');

            Route::post('/users/{id}/change-role', [UserController::class, 'changeRole'])
                ->name('users.changeRole');

            Route::get('/users/create', [UserController::class, 'create'])
                ->name('users.create');

            Route::post('/users/store', [UserController::class, 'store'])
                ->name('users.store');
                
            Route::put('/users/{id}', [UserController::class, 'update'])
                ->name('users.update');

            Route::post('/users/{id}/toggle', [UserController::class, 'toggleStatus'])
                ->name('users.toggle');
        });

        // admin duyệt booking
        Route::middleware('admin.role:SUPER_ADMIN,BOOKING_STAFF')->group(function () {

            // booking
            Route::get('/bookings', [AdminBookingController::class, 'index'])
                ->name('bookings');

            Route::post('/bookings/{id}/approve', [AdminBookingController::class, 'approve'])
                ->name('bookings.approve');

            Route::post('/bookings/{id}/complete', [AdminBookingController::class, 'complete'])
                ->name('bookings.complete');

            Route::post('/bookings/{id}/cancel', [AdminBookingController::class, 'cancel'])
                ->name('bookings.cancel');

            Route::post('/bookings/{id}/undo', [AdminBookingController::class, 'undo'])
                ->name('bookings.undo');

            // tour
            Route::resource('tour', TourController::class)
                ->except(['show']);

            // địa điểm
            Route::get('/dia_diem', [DiaDiemController::class, 'index'])
                ->name('dia_diem.index');

            Route::post('/dia_diem', [DiaDiemController::class, 'store'])
                ->name('dia_diem.store');

            Route::put('/dia_diem/{id}', [DiaDiemController::class, 'update'])
                ->name('dia_diem.update');

            Route::delete('/dia_diem/{id}', [DiaDiemController::class, 'destroy'])
                ->name('dia_diem.destroy');

            Route::get('/dia-diem-by-mien/{id_mien}', [DiaDiemController::class, 'getByMien']);

            // khách hàng
            Route::get('/khachhang', [KhachHangController::class, 'index'])
                ->name('khachhang.index');

            Route::post('/khachhang', [KhachHangController::class, 'store'])
                ->name('khachhang.store');

            Route::put('/khachhang/{id}', [KhachHangController::class, 'update'])
                ->name('khachhang.update');

            Route::delete('/khachhang/{id}', [KhachHangController::class, 'destroy'])
                ->name('khachhang.destroy');

            // thống kê
            Route::get('/statistics/revenue', [StatisticController::class, 'revenue'])
                ->name('statistics.revenue');
        });

        // admin quản lý hdv 
        Route::middleware('admin.role:SUPER_ADMIN,TOUR_MANAGER')->group(function () {

            Route::resource('huongdanvien', HuongDanVienController::class)
                ->except(['show']);
            // tour
            Route::resource('tour', TourController::class)
                ->except(['show']);
            
        });
    });
