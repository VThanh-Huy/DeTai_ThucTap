<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    protected $table = 'khach_hang';

    protected $fillable = [
        'ten_kh',
        'email',
        'sdt',
        'user_id'
    ];
}
