<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BridgingKabkota extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bridging_kabkota';

    protected $fillable = [
        'kabkota_id',
        'cjip_kabkota_id', 
        'nama_kota'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];
}