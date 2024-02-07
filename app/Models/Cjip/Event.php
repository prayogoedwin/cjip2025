<?php

namespace App\Models\Cjip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'start_date',
        'end_date',
        'kurs_dollar',
        'logo',
        'banner',
        'jumlah_peserta',
    ];
}
