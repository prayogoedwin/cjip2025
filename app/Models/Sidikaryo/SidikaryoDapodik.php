<?php

namespace App\Models\Sidikaryo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidikaryoDapodik extends Model
{
    use HasFactory;

    protected $table = 'sidikaryo_dapodiks';

    protected $fillable = [
        'tahun_data',
        'kode_kabkota',
        'kab_kota',
        'nama_sma_smk',
        'jumlah_laki_laki',
        'jumlah_perempuan',
        'siswa_laki12',
        'siswa_perempuan12',
        'siswa_laki13',
        'siswa_perempuan13',
        'jurusan',
        'total_jumlah_potensi',
        'cjip_kota_id',
        'kabkota_id',
        'kelulusan_laki',
        'kelulusan_perempuan',
        'tahun_tarik',
        'semester',
        'bentuk_pendidikan_id',
        'dataperiode'
    ];

    protected $casts = [
        'tahun_data' => 'integer',
        'jumlah_laki_laki' => 'integer',
        'jumlah_perempuan' => 'integer',
        'siswa_laki12' => 'integer',
        'siswa_perempuan12' => 'integer',
        'siswa_laki13' => 'integer',
        'siswa_perempuan13' => 'integer',
        'total_jumlah_potensi' => 'integer',
        'cjip_kota_id' => 'integer',
        'kabkota_id' => 'integer',
        'tahun_tarik'  => 'integer',
        'semester'  => 'integer',
        'bentuk_pendidikan_id'  => 'integer'
    ];

    // Define relationships if needed
    // public function cjipKota()
    // {
    //     return $this->belongsTo(CjipKota::class, 'cjip_kota_id');
    // }
    // 
    // public function kabKota()
    // {
    //     return $this->belongsTo(KabKota::class, 'kabkota_id');
    // }
}