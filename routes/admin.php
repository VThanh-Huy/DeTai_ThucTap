<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminBookingController;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // router cho admin về danh sách tour 
    Route::get('/bookings', [AdminBookingController::class, 'index'])
        ->name('admin.bookings');

    Route::post('/bookings/{id}/approve', [AdminBookingController::class, 'approve'])
        ->name('admin.bookings.approve');

    Route::post('/bookings/{id}/cancel', [AdminBookingController::class, 'cancel'])
        ->name('admin.bookings.cancel');
});