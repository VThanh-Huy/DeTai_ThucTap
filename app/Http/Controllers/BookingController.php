<?php

namespace App\Http\Controllers;
use App\Models\Tour;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create($id)
    {
        $tour = Tour::findOrFail($id);

        return view('booking.create', compact('tour'));
    }
}


