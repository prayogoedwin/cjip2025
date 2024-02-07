<?php

namespace App\Models\Cjip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaAir extends Model
{
    use HasFactory;

    protected $table = 'biaya_airs';

    protected $fillable = [
        'tahun', 'category', 'first', 'second', 'third', 'four', 'display', 'jenis_user_id'
    ];

    public function kategoriair()
    {
        return $this->belongsTo(KategoriAir::class, 'jenis_user_id');
    }
}
