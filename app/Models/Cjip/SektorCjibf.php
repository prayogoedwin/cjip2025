<?php

namespace App\Models\Cjip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SektorCjibf extends Model
{
    use HasFactory;

    protected $table = 'sektor_cjibfs';

    protected $fillable = [
        'nama'
    ];
    public $timestamps = false;
}
