<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HuongDanVienController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\DiaDiemController;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        // router cho admin về danh sách tour 
        Route::get('/bookings', [AdminBookingController::class, 'index'])
            ->name('bookings');

        Route::post('/bookings/{id}/approve', [AdminBookingController::class, 'approve'])
            ->name('bookings.approve');

        Route::post('/bookings/{id}/cancel', [AdminBookingController::class, 'cancel'])
            ->name('bookings.cancel');

        Route::get('/users', [UserController::class, 'index'])
            ->name('users');
        Route::post('/users/{id}/change-role', [UserController::class, 'changeRole'])
            ->name('users.changeRole');

        Route::resource('tour', TourController::class)
            ->except(['show']);

        Route::get('/dia-diem-by-mien/{id}', function ($id) {
            return \App\Models\DiaDiem::where('id_mien', $id)->get();
        });


        Route::resource('huongdanvien', HuongDanVienController::class)
            ->except(['show']);
    });
