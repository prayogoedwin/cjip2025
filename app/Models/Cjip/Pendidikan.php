<?php

namespace App\Models\Cjip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

    protected $table = 'pendidikans';


    protected $fillable = [
        'nama',
        'kab_kota_id',
        'jenis_sekolah'
    ];
    public function kabkota()
    {
        return $this->belongsTo(Kabkota::class, 'kab_kota_id');
    }
}