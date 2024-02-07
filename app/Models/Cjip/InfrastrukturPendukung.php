<?php

namespace App\Models\Cjip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class InfrastrukturPendukung extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'infrastruktur_pendukungs';


    protected $fillable = [
        'tanggal', 'nama', 'detail', 'status', 'gambar', 'icon'
    ];

    protected $translatable = [
        'nama', 'detail',
    ];
}
