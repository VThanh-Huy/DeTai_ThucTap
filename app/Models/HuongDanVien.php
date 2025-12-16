<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HuongDanVien extends Model
{
    protected $table ='huong_dan_vien';
    protected $primaryKey = 'id_hdv';
    public $timestamps = false;
    protected $fillable =[
        'ten_hdv',
        'gioi_tinh',
        'email',
        'kinh-nghiem'
    ];

}
