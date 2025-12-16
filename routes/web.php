<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tour', [TourController::class, 'index'])->name('tour.index');
// route đăng ký:
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// route đăng nhập:
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');

// route đăng xuất:
Route::post('/logout', function (Request $request) {
    Auth::logout(); // xoá đăng nhập

    $request->session()->invalidate(); 
    $request->session()->regenerateToken(); 

    return redirect('/')->with('success', 'Đăng xuất thành công!');
})->name('logout');

// route xem chi tiết tour
Route::get('/tour/{id}', [TourController::class, 'show'])
    ->name('tour.show');

// route đặt tour
// Chặn người dùng nếu chưa đăng nhập sẽ không đặt tour được
Route::get('/tour/{id}/dat-tour', [BookingController::class, 'create'])
    ->middleware('auth')
    ->name('booking.create');
Route::post('/tour/{id}/dat-tour', [TourController::class, 'datTour'])
    ->middleware('auth')
    ->name('booking.store');

