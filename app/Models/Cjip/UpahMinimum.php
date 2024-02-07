<?php

namespace App\Models\Cjip;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpahMinimum extends Model
{
    use HasFactory;

    protected $table = 'upah_minimums';


    protected $fillable = [
        'tahun',
        'sumber_data',
        'kab_kota_id',
        'nilai_umr'
    ];
    public function kabkota()
    {
        return $this->belongsTo(Kabkota::class, 'kab_kota_id');
    }
}
