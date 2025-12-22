<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiaDiem;
use App\Models\Mien;
use Illuminate\Http\Request;

class DiaDiemController extends Controller
{
    public function byMien($id_mien)
    {
        return DiaDiem::where('id_mien', $id_mien)->get();
    }

    public function index()
    {
        $diaDiems = DiaDiem::with('mien')->get();
        $miens = Mien::all();

        return view('admin.dia_diem.index', compact('diaDiems', 'miens'));
    }

    public function store(Request $request)
    {
        DiaDiem::create($request->all());
        return back();
    }

    public function update(Request $request, $id)
    {
        DiaDiem::findOrFail($id)->update($request->all());
        return back();
    }

    public function destroy($id)
    {
        DiaDiem::findOrFail($id)->delete();
        return back();
    }

    // ⭐ AJAX
    public function getByMien($id_mien)
    {
        return DiaDiem::where('id_mien', $id_mien)
            ->get();
    }
}

