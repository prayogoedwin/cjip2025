<?php

namespace App\Models\Cjip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPpp extends Model
{
    use HasFactory;
    protected $table = 'jenis_ppp';
    protected $fillable = ['nama', 'kode', 'kode_data'];
}
