<?php

namespace App\Models\Cjip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class JenisKawasan extends Model
{
    use HasFactory;


    protected $table = 'jenis_kawasans';

    protected $fillable = [
        'nama'
    ];
}
