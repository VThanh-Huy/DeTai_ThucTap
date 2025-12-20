<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiaDiem;

class DiaDiemController extends Controller
{
    public function byMien($id_mien)
    {
        return DiaDiem::where('id_mien', $id_mien)->get();
    }
}

