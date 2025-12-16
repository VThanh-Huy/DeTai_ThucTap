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
        return $this->belongsTo(User::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}

