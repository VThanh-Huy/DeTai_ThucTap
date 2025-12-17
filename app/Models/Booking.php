<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';

    protected $fillable = [
        'id_tour',
        'user_id',
        'so_luong',
        'tong_tien',
        'ngay_dat',
        'phuong_thuc_tt',
        'trang_thai'
    ];

    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function tour()
    {
        return $this->belongsTo(
            Tour::class,
            'id_tour',   // khóa ngoại trong booking
            'id_tour'    // khóa chính trong tour
        );
    }
}
