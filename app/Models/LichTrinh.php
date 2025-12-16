<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichTrinh extends Model
{
    protected $table = 'lich_trinh';     
    protected $primaryKey = 'id_lich_trinh';
    public $timestamps = false;

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'id_tour', 'id_tour');
    }
}

