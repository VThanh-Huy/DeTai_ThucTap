<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::all();
        return view('admin.tour.index', compact('tours'));
    }

    public function store(Request $request)
    {
        Tour::create($request->all());
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);
        $tour->update($request->all());
        return redirect()->back();
    }

    public function destroy($id)
    {
        Tour::destroy($id);
        return redirect()->back();
    }
}
