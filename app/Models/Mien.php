<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mien extends Model
{
    protected $table = 'mien';
    protected $primaryKey = 'id_mien';
    public $timestamps = false;

    protected $fillable = ['ten_mien'];

    public function diaDiems()
    {
        return $this->hasMany(DiaDiem::class, 'id_mien');
    }
}
