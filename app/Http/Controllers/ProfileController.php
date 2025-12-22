<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\User;

class ProfileController extends Controller
{

public function index()
{
    $user = User::with('khachHang')
        ->findOrFail(Auth::id());

    $bookings = Booking::with('tour')
        ->where('user_id', $user->id)
        ->orderBy('ngay_dat', 'desc')
        ->get();

    return view('auth.profile', compact('user', 'bookings'));
}

}
