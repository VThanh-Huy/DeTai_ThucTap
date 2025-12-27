<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class HuongDanVien extends Authenticatable
{
    protected $table = 'huong_dan_vien';
    protected $primaryKey = 'id_hdv';
    public $timestamps = false;

    protected $fillable = [
        'ten_hdv',
        'email',
        'password',
        'ngay_sinh',
        'gioi_tinh',
        'sdt',
        'nam_bat_dau',
        'ngon_ngu',
        'kinh_nghiem',
    ];

    protected $hidden = ['password'];

    // Tự hash password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class, 'id_hdv', 'id_hdv');
    }
}
