<?php

namespace App\Models\SiMike;

use App\Models\Cjip\Kabkota;
use App\Models\SiRusa\Bap;
use App\Models\SiRusa\Nib;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Proyek extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_proyek';
    public $incrementing = false;

    protected $fillable = [
        'nib_id',
        'id_proyek',
        'user_id',
        'kab_kota_id',
        'sektor_id',
        'last_edited_by_id',
        'rules_id',

        'is_tambahan',
        'kbli',
        'judul_kbli',
        'flag',
        'uraian_risiko_proyek',
        'uraian_skala_usaha',
        'alamat_usaha',
        'kelurahan_usaha',
        'kecamatan_usaha',
        'kab_kota_usaha',
        'provinsi_usaha',
        'latitude',
        'longitude',
        'tanggal_terbit_oss',
        'tki',
        'tka',
        'tahun',
        'triwulan',
        'mesin_peralatan',
        'mesin_peralatan_impor',
        'pembelian_pematangan_tanah',
        'bangunan_gedung',
        'modal_kerja',
        'lain_lain',
        'jumlah_investasi',

        'klsektor_pembina',
        'sektor',
        'periode_start',
        'periode_end',
        'nib',
        'is_anomaly',
        'total_investasi',
        'nama_perusahaan',
        'npwp_perusahaan',
        'uraian_status_penanaman_modal',
        'nama_user',
        'nomor_identitas_user',
        'email',
        'alamat',
        'nomor_telp',
        'nib_count',

        'is_jateng',
        'is_lapor_tw1',
        'is_lapor_tw2',
        'is_lapor_tw3',
        'is_lapor_tw4',
        'pengawasan_id',
        'tahun_rilis',
        'rilis',
        'is_terfasilitasi',
        'is_terbina',
        'dikecualikan',

        'luas_tanah',
        'satuan_tanah',

    ];

    public function getProyekKbliAttribute()
    {
        return $this->nama_perusahaan . ' | ' . $this->kbli;
    }

    public function nibCheck(): BelongsTo
    {
        return $this->belongsTo(Nib::class, 'nib_id');
    }

    public function baps(): HasMany
    {
        return $this->hasMany(Bap::class, 'proyek_id');
    }

    public function status_pm()
    {
        return $this->hasOne(Nib::class, 'nib_id')
            ->select(
                'nib_id',
                DB::raw('sum(jumlah_investasi where uraian_penanaman_modal = "PMA") as `pma`'),
                DB::raw('sum(jumlah_investasi where uraian_penanaman_modal = "PMDN") as `pmdn`'),
            )->groupBy('nib_id');
    }

    public function kabkota()
    {
        return $this->belongsTo(Kabkota::class, 'kab_kota_id');
    }

    public function rules()
    {
        return $this->belongsTo(RulesSimike::class, 'rules_id');
    }

    public function scopeFilterMikro($query, $tahun, $triwulan, $kabkota, $sektor, $uraian_skala_usaha, $kecamatan_usaha)
    {
        return $query->when(!is_null('tahun'), function ($query) use ($tahun) {
            if ($tahun != null) {
                return $query->where('tahun', $tahun);
            }
        })->when(!is_null('triwulan'), function ($query) use ($triwulan) {
            if ($triwulan != null) {
                return $query->Where('triwulan', $triwulan);
            }
        })->when(!is_null('kab_kota_id'), function ($query) use ($kabkota) {
            if ($kabkota != null) {
                return $query->Where('kab_kota_id', $kabkota);
            }
        })->when(!is_null('sektor_id'), function ($query) use ($sektor) {
            if ($sektor != null) {
                return $query->Where('sektor_id', $sektor);
            }
        })->when(!is_null('uraian_skala_usaha'), function ($query) use ($uraian_skala_usaha) {
            if ($uraian_skala_usaha != null) {
                return $query->Where('uraian_skala_usaha', $uraian_skala_usaha);
            }
        })->when(!is_null('kecamatan_usaha'), function ($query) use ($kecamatan_usaha) {
            if ($kecamatan_usaha != null) {
                return $query->Where('kecamatan_usaha', $kecamatan_usaha);
            }
        })
            ->select(
                DB::raw('sum(CASE WHEN dikecualikan = "0" THEN jumlah_investasi ELSE 0 END) as `investasi`'),
                DB::raw('sum(CASE WHEN is_anomaly = "0" THEN jumlah_investasi ELSE 0 END) as `jumlah_investasi`'),
                DB::raw('sum(CASE WHEN is_anomaly = "0" THEN total_investasi ELSE 0 END) as `total_investasi`'),
                DB::raw('sum(CASE WHEN is_anomaly = "1" THEN jumlah_investasi ELSE 0 END) as `jumlah_investasi_anomaly`'),
                DB::raw('sum(CASE WHEN is_anomaly = "1" THEN total_investasi ELSE 0 END) as `total_investasi_anomaly`'),
                DB::raw('sum(CASE WHEN is_anomaly = "0" THEN nib_count ELSE 0 END) as `count_nib`'),
                DB::raw('sum(CASE WHEN is_anomaly = "1" THEN nib_count ELSE 0 END) as `count_nib_anomaly`'),
                DB::raw('sum(CASE WHEN is_anomaly = "0" THEN tki ELSE 0 END) as `count_tki`'),
                DB::raw('sum(CASE WHEN is_anomaly = "0" THEN tka ELSE 0 END) as `count_tka`'),
                DB::raw('count(CASE WHEN is_anomaly = "1" THEN nib_count ELSE 0 END) as `jumlah_proyek`'),
                DB::raw('count(is_anomaly or null) as `jumlah_proyek_anomaly`'),
            );
    }

    public function scopeFilterMikroNIB($query, $tahun, $triwulan, $kabkota, $sektor, $uraian_skala_usaha, $kecamatan_usaha)
    {
        return $query->when(!is_null('tahun'), function ($query) use ($tahun) {
            if ($tahun != null) {
                return $query->where('tahun', $tahun);
            }
        })->when(!is_null('triwulan'), function ($query) use ($triwulan) {
            if ($triwulan != null) {
                return $query->Where('triwulan', $triwulan);
            }
        })->when(!is_null('kab_kota_id'), function ($query) use ($kabkota) {
            if ($kabkota != null) {
                return $query->Where('kab_kota_id', $kabkota);
            }
        })->when(!is_null('sektor_id'), function ($query) use ($sektor) {
            if ($sektor != null) {
                return $query->Where('sektor_id', $sektor);
            }
        })->when(!is_null('uraian_skala_usaha'), function ($query) use ($uraian_skala_usaha) {
            if ($uraian_skala_usaha != null) {
                return $query->Where('uraian_skala_usaha', $uraian_skala_usaha);
            }
        })->when(!is_null('kecamatan_usaha'), function ($query) use ($kecamatan_usaha) {
            if ($kecamatan_usaha != null) {
                return $query->Where('kecamatan_usaha', $kecamatan_usaha);
            }
        })
            ->select(
                'nib',
                'jumlah_investasi',
                'total_investasi',
                'is_anomaly',
                'tki',
                'tka',
                DB::raw('sum(CASE WHEN is_anomaly = "0" THEN jumlah_investasi ELSE 0 END) as `jumlah_investasi`'),
                DB::raw('sum(CASE WHEN is_anomaly = "0" THEN total_investasi ELSE 0 END) as `total_investasi`'),
                DB::raw('sum(CASE WHEN is_anomaly = "1" THEN jumlah_investasi ELSE 0 END) as `jumlah_investasi_anomaly`'),
                DB::raw('sum(CASE WHEN is_anomaly = "1" THEN total_investasi ELSE 0 END) as `total_investasi_anomaly`'),
                // DB::raw('count(*) as `jumlah_proyek`'),
                DB::raw('count(CASE WHEN is_anomaly = "1" THEN nib_count ELSE 0 END) as `jumlah_proyek`'),
                DB::raw('count(is_anomaly or null) as `jumlah_proyek_anomaly`'),
            )
            ->groupBy('nib');
    }

    public function scopeFilterMikroKbli($query, $tahun, $triwulan, $kabkota, $sektor, $uraian_skala_usaha, $kecamatan_usaha)
    {
        return $query->when(!is_null('tahun'), function ($query) use ($tahun) {
            if ($tahun != null) {
                return $query->where('tahun', $tahun);
            }
        })->when(!is_null('triwulan'), function ($query) use ($triwulan) {
            if ($triwulan != null) {
                return $query->Where('triwulan', $triwulan);
            }
        })->when(!is_null('kab_kota_id'), function ($query) use ($kabkota) {
            if ($kabkota != null) {
                return $query->Where('kab_kota_id', $kabkota);
            }
        })->when(!is_null('sektor_id'), function ($query) use ($sektor) {
            if ($sektor != null) {
                return $query->Where('sektor_id', $sektor);
            }
        })->when(!is_null('uraian_skala_usaha'), function ($query) use ($uraian_skala_usaha) {
            if ($uraian_skala_usaha != null) {
                return $query->Where('uraian_skala_usaha', $uraian_skala_usaha);
            }
        })->when(!is_null('kecamatan_usaha'), function ($query) use ($kecamatan_usaha) {
            if ($kecamatan_usaha != null) {
                return $query->Where('kecamatan_usaha', $kecamatan_usaha);
            }
        });
    }

    public function scopeFilterPerusahaan($query, $dateRange, $status_pm, $kabkota, $sektor)
    {
        return $query->when(!is_null($dateRange), function ($query) use ($dateRange) {
            if ($dateRange != null) {
                $dates = explode(' - ', $dateRange);
                $startDate = date('Y-m-d', strtotime(str_replace('/', '-', $dates[0])));
                $endDate = date('Y-m-d', strtotime(str_replace('/', '-', $dates[1])));
                return $query->whereHas('nibCheck', function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('day_of_tanggal_terbit_oss', [$startDate, $endDate]);
                });
            }
        })->when(!is_null('uraian_status_penanaman_modal'), function ($query) use ($status_pm) {
            if ($status_pm != null) {
                return $query->Where('uraian_status_penanaman_modal', $status_pm);
            }
        })->when(!is_null('sektor_id'), function ($query) use ($sektor) {
            if ($sektor != null) {
                return $query->Where('sektor_id', $sektor);
            }
        })->when(!is_null('kab_kota_id'), function ($query) use ($kabkota) {
            if ($kabkota != null) {
                return $query->Where('kab_kota_id', $kabkota);
            }
        });
    }

    public function scopeFilterPerusahaanNon($query, $dateRange, $status_pm, $kabkota, $sektor)
    {
        return $query->when(!is_null($dateRange), function ($query) use ($dateRange) {
            if ($dateRange != null) {
                $dates = explode(' - ', $dateRange);
                $startDate = date('Y-m-d', strtotime(str_replace('/', '-', $dates[0])));
                $endDate = date('Y-m-d', strtotime(str_replace('/', '-', $dates[1])));
                return $query->whereDoesntHave('nibCheck')->whereBetween('created_at', [$startDate, $endDate]);
            }
        })->when(!is_null('uraian_status_penanaman_modal'), function ($query) use ($status_pm) {
            if ($status_pm != null) {
                return $query->Where('uraian_status_penanaman_modal', $status_pm);
            }
        })->when(!is_null('sektor_id'), function ($query) use ($sektor) {
            if ($sektor != null) {
                return $query->Where('sektor_id', $sektor);
            }
        })->when(!is_null('kab_kota_id'), function ($query) use ($kabkota) {
            if ($kabkota != null) {
                return $query->Where('kab_kota_id', $kabkota);
            }
        });
    }
}
