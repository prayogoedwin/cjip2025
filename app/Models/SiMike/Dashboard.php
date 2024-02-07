<?php

namespace App\Models\SiMike;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    protected $casts = [
        'kabkota' => 'array',
        'sektor' => 'array',
    ];

    protected $fillable = [
        'tahun',
        'triwulan',
        'kabkota',
        'sektor',
    ];

}
