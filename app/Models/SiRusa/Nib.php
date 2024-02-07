<?php

namespace App\Models\SiRusa;

use App\Models\General\Kabkota;
use App\Models\SiMike\Proyek;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nib extends Model
{
    use HasFactory;

    protected $table = 'nibs';
    protected $fillable = [
        'nib',
        'day_of_tanggal_terbit_oss',
        'nama_perusahaan',
        'status_penanaman_modal',
        'flag_umk',
        'uraian_jenis_perusahaan',
        'alamat_perusahaan',
        'kab_kota',
        'email',
        'kab_kota_id',
        'is_jateng',
        'tanggal_awal',
        'tanggal_akhir',
        'nomor_telp',
    ];

    public function proyeks(): HasMany{
        return $this->hasMany(Proyek::class);
    }

    public function kabkota(): BelongsTo{
        return $this->belongsTo(Kabkota::class, 'kab_kota_id');
    }


}
