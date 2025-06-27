<?php

namespace App\Models\Sidikaryo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SidikaryoPenempatan extends Model
{
    use SoftDeletes;

    protected $table = 'sidikaryo_penempatans';

    protected $fillable = [
        'id_kota',
        'kota',
        'cjip_kota_id',
        'jmllaki',
        'jmlperempuan',
        'total'
    ];

    protected $casts = [
        'cjip_kota_id' => 'integer',
        'jmllaki',
        'jmlperempuan',
        'total'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Jika perlu relasi dengan tabel kota
    public function kota()
    {
        return $this->belongsTo(Kota::class, 'cjip_kota_id', 'id');
    }

    // Di model SidikaryoPencaker
    public function scopeByKota($query, $kotaId)
    {
        return $query->where('cjip_kota_id', $kotaId);
    }
}
