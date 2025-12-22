<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;
use App\Models\Mien;
use App\Models\HuongDanVien;

class TourController extends Controller
{
    public function index()
    {
        
        return view('admin.tour.index', [
            'tours' => Tour::with('diaDiems.mien', 'huongDanVien')->get(),
            'miens' => Mien::all(),
            'hdvs'  => HuongDanVien::all()
        ]);
    }

    
    public function store(Request $request)
    {
        Tour::create($request->all());
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);

        $data = $request->except(['dia_diem', 'hinh_anh']);

        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');

            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/tours'), $filename);

            $data['hinh_anh'] = $filename;


            $data['hinh_anh'] = $filename;
        }

        $tour->update($data);

        // sync địa điểm
        if ($request->has('dia_diem')) {
            $tour->diaDiems()->sync($request->dia_diem);
        } else {
            $tour->diaDiems()->sync([]);
        }

        return redirect()->back();
    }


    public function destroy($id)
    {
        Tour::destroy($id);
        return redirect()->back();
    }
}
