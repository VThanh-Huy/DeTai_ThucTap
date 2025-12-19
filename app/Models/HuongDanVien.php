<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HuongDanVien extends Model
{
    protected $table = 'huong_dan_vien';
    protected $primaryKey = 'id_hdv';
    public $timestamps = false;
    protected $fillable = [
        'ten_hdv',
        'ngay_sinh',
        'gioi_tinh',
        'sdt',
        'email',
        'nam_bat_dau',
        'ngon_ngu',
        'kinh_nghiem',
    ];
    public function tours()
    {
        return $this->hasMany(Tour::class, 'id_hdv', 'id_hdv');
    }
}
