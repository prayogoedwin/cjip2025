<?php

namespace App\Models\Sidikaryo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SidikaryoPencaker extends Model
{
    use SoftDeletes;

    protected $table = 'sidikaryo_pencakers';

    protected $fillable = [
        'id_kota',
        'kota',
        'cjip_kota_id',
        'l',
        'p',
        'lulusan_sma_smk',
        'lulusan_dibawah_sma_smk',
        'lulusan_sarjana_keatas'
    ];

    protected $casts = [
        'cjip_kota_id' => 'integer',
        'l' => 'integer',
        'p' => 'integer',
        'lulusan_sma_smk' => 'integer',
        'lulusan_dibawah_sma_smk' => 'integer',
        'lulusan_sarjana_keatas' => 'integer',
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