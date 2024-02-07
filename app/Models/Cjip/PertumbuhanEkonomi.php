<?php

namespace App\Models\Cjip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PertumbuhanEkonomi extends Model
{
    use HasFactory;

    protected $table = 'pertumbuhan_ekonomis';

    protected $fillable = [
        'tahun', 'pertumbuhan_jateng', 'pertumbuhan_nasional', 'status'
    ];
}
