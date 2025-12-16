<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $primaryKey = 'id_review';

    public $timestamps = false;

    protected $fillable = [
        'id_tour',
        'user_id',
        'so_sao',
        'noi_dung',
        'ngay'
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id', // foreign key trong reviews
            'id'       // primary key trong users
        );
    }
    /*reviews*/
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'id_tour', 'id_tour');
    }
}
