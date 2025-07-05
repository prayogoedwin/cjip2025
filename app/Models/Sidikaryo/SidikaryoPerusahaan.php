<?php

namespace App\Models\Sidikaryo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SidikaryoPerusahaan extends Model
{
    use HasFactory;

    protected $table = 'sidikaryo_perusahaans';

    protected $fillable = [
        'id_emakaryo',
        'name',
        'deskripsi',
        'jenis_perusahaan',
        'nib',
        'email',
        'telpon',
        'hp',
        'website',
        'provinsi',
        'kabkota',
        'kabkota_kode',
        'cjip_kota_id',
        'kecamatan',
        'alamat',
        'kodepos',
        'jumlah_lowongan',
        'jumlah_lamaran_menunggu',
        'jumlah_lamaran_proses',
        'jumlah_lamaran_diterima',
        
    ];

    protected $casts = [
        'tanggal_daftar' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
