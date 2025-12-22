<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $tourId)
    {
        $request->validate([
            'so_sao' => 'required|integer|min:1|max:5',
            'noi_dung' => 'nullable|string'
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'id_tour' => $tourId,
            'so_sao' => $request->so_sao,
            'noi_dung' => $request->noi_dung,
        ]);

        return back()->with('success', 'Cảm ơn bạn đã đánh giá!');
    }
}
