<?php

namespace App\Models\Cjibf;

use App\Models\Cjip\Kabkota;
use App\Models\Cjip\Kawasan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Investasi\ProyekInvestasi;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CjibfRegisterO3m extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'company_name',
        'mobile_phone',
        'o3m_interest_id',
        'kawasan_id',
        'kab_kota_id',
    ];

    protected $table = 'cjibf_register_o3ms';

    public function kabKota(): BelongsTo
    {
        return $this->belongsTo(Kabkota::class);
    }

    public function kawasan(): BelongsTo
    {
        return $this->belongsTo(Kawasan::class);
    }
    public function interest(): BelongsTo
    {
        return $this->belongsTo(O3mInterest::class, 'o3m_interest_id');
    }
    public function getInterestLocationAttribute()
    {
        if ($this->kab_kota_id) {
            return $this->kabKota->nama ?? $this->kab_kota_id;
        } elseif ($this->kawasan_id) {
            return $this->kawasan->nama ?? $this->kawasan_id;
        }
        return "-";
    }
}
