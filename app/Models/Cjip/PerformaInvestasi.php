<?php

namespace App\Models\Cjip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PerformaInvestasi extends Model
{
    use HasFactory;

    protected $table = 'performa_investasis';

    protected $fillable = [
        'tahun', 'target', 'realisasi'
    ];
}
