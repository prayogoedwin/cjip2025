<?php

namespace App\Models\Sidikaryo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SidikaryoIntegrasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sidikaryo_integrasi';

    protected $fillable = [
        'nama_app',
        'username',
        'password',
        'apikey',
        'token',
    ];

    protected $hidden = [
        'password',
    ];
}
