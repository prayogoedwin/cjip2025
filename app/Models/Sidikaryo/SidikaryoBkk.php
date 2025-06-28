<?php

namespace App\Models\Sidikaryo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidikaryoBkk extends Model
{
    use HasFactory;

    protected $table = 'sidikaryo_bkks';

    protected $fillable = [
        'nama_sekolah',
        'nama_bkk',
        'id_kota',
        'telpon',
        'hp',
        'email',
        'website',
        'contact_person',
        'jabatan',
        'alamat',
        'kota',
        'cjip_kota_id',
    ];

    /**
     * Get the cjip_kota associated with the BKK.
     */
    public function cjipKota()
    {
        return $this->belongsTo(\App\Models\CjipKota::class, 'cjip_kota_id');
    }
}
