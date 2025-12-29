<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = 'tour';
    protected $primaryKey = 'id_tour';
    protected $casts = [
        'lich_trinh' => 'array'
    ];
    protected $attributes = [
        'lich_trinh' => '[]',
    ];

    public $timestamps = false;

    protected $fillable = [
        'ten_tour',
        'so_ngay',
        'so_cho',
        'gia_tien',
        'mo_ta',
        'lich_trinh',
        'hinh_anh',
        'id_hdv',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'trang_thai'
    ];
    public function huongDanVien()
    {
        return $this->belongsTo(
            HuongDanVien::class,
            'id_hdv',     // foreign key trong bảng tour
            'id_hdv'      // primary key bảng huong_dan_vien
        );
    }

    // public function lichTrinh()
    // {
    //     return $this->hasMany(LichTrinh::class, 'id_tour');
    // }

    public function diaDiems()
    {
        return $this->belongsToMany(
            DiaDiem::class,
            'tour_dia_diem',
            'id_tour',
            'id_dd'
        );
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_tour', 'id_tour');
    }
}
