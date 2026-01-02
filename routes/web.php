<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HuongDanVien\AuthController;
use App\Http\Controllers\HuongDanVien\TourHDVController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/gioi-thieu', 'pages.about')->name('about');
Route::view('/lien-he', 'pages.contact')->name('contact');

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

// routes đánh giá:
Route::post('/tour/{id}/review', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('review.store');

// routes trang cá nhân khách:
Route::get('/profile', [ProfileController::class, 'index'])
    ->middleware('auth')
    ->name('profile');

// route quên mật khẩu
Route::get('/forgot_password', [ForgotPasswordController::class, 'show'])
    ->name('password.request');

Route::post('/forgot_password', [ForgotPasswordController::class, 'sendResetLink'])
    ->name('password.email');

Route::get('/reset_password/{token}', [ResetPasswordController::class, 'show'])
    ->name('password.reset');

Route::post('/reset_password', [ResetPasswordController::class, 'reset'])
    ->name('password.update'); 

//route cho hdv
Route::prefix('huongdanvien')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('huongdanvien.login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('huongdanvien.login.submit');

    Route::middleware('auth:huongdanvien')->group(function () {

    Route::get('/', [TourHDVController::class, 'dashboard'])
        ->name('huongdanvien.dashboard');

    Route::get('/profile', [AuthController::class, 'profile'])
        ->name('huongdanvien.profile');

    // đổi mật khẩu
    Route::get('/change-password', [AuthController::class, 'showChangePassword'])
        ->name('huongdanvien.password.form');

    Route::post('/change-password', [AuthController::class, 'changePassword'])
        ->name('huongdanvien.password.update');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('huongdanvien.logout');
});

});
