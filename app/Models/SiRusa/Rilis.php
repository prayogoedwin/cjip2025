<?php

namespace App\Models\SiRusa;

use App\Models\General\Kabkota;
use App\Models\SiMike\Proyek;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Rilis extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_laporan',
        'periode_tahap',
        'sektor_utama',
        '23_sektor',
        'tanggal_laporan',
        'tanggal_approve_laporan',
        'jenis_badan_usaha',
        'nama_perusahaan',
        'email',
        'alamat',
        'cetak_lokasi',
        'sektor',
        'deskripsi_kbli',
        'wilayah',
        'provinsi',
        'kabkot',
        'negara',
        'no_izin',
        'tambahan_investasi_dalam_rp_juta',
        'tambahan_investasi_dalam_us_ribu',
        'proyek',
        'tki',
        'tka',
        'status',
        'triwulan',
        'tahun',
        'proyek_id',
        'kab_kota_id',
        'status_pm',
        'tanggal_awal',
        'tanggal_akhir',
    ];


    public function kabkota(): BelongsTo{
        return $this->belongsTo(Kabkota::class);
    }

    public function proyek(): BelongsTo{
        return $this->belongsTo(Proyek::class);
    }


    public function scopefilterRilis($query, $tahun, $triwulan, $kabkota, $sektor)
    {
        return $query->when(!is_null('tahun'), function ($query) use ($tahun) {
            if ($tahun != null) {
                return $query->where('tahun', $tahun);
            }
        })->when(!is_null('triwulan'), function ($query) use ($triwulan) {
            if ($triwulan != null) {
                return $query->WhereIn('triwulan', $triwulan);
            }
        })->when(!is_null('kab_kota_id'), function ($query) use ($kabkota) {
            if ($kabkota != null) {
                return $query->Where('kab_kota_id', $kabkota);
            }
        })->when(!is_null('sektor_id'), function ($query) use ($sektor) {
            if ($sektor != null) {
                return $query->Where('sektor_id', $sektor);
            }
        })
            ->select(
                '*',
                DB::raw('sum(CASE WHEN status_pm = "PMA" THEN tambahan_investasi_dalam_rp_juta ELSE 0 END) as `nilai_pma`'),
                DB::raw('sum(CASE WHEN status_pm = "PMDN" THEN tambahan_investasi_dalam_rp_juta ELSE 0 END) as `nilai_pma`'),
                DB::raw('sum(tambahan_investasi_dalam_rp_juta) as `total_nilai`'),
            );
    }

}
