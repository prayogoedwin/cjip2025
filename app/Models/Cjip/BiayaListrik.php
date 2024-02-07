<?php

namespace App\Models\Cjip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BiayaListrik extends Model
{
    use HasFactory;

    protected $table = 'biaya_listriks';

    protected $fillable = [
        'kode', 'kapasitas', 'tarif', 'tanggal', 'keterangan', 'jenis_user_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriListrik::class, 'jenis_user_id');
    }
}
