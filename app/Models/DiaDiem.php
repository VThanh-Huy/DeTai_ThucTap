<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mien;

class DiaDiem extends Model
{
    protected $table = 'dia_diem';
    protected $primaryKey = 'id_dd';
    public $timestamps = false;

    protected $fillable = [
        'ten_dia_diem',
        'id_mien',
        'id_mien'
    ];

    public function mien()
    {
        return $this->belongsTo(Mien::class, 'id_mien');
    }
}
