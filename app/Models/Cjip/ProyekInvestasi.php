<?php

namespace App\Models\Cjip;

use App\Models\Cjip\Kabkota;
use App\Models\Cjip\ProfileKabkota;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Translatable\HasTranslations;

class ProyekInvestasi extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'proyek_investasis';

    protected $casts = [
        'lokasi' => 'array',
        'location' => 'array',
        'foto' => 'array',
    ];

    public $translatable = [
        'nama',
        'latar_belakang',
        'lingkup_pekerjaan',
        'eksisting',
        'luas_lahan',
        'status_kepemilikan',
        'nilai_investasi',
        'skema_investasi',
        'npv',
        'irr',
        'bc_ratio',
        'playback_period',
        'cp_alamat',
        // 'cp_email',
        // 'cp_hp',
        // 'file_kajian',
        // 'file_keuangan',
        'ketersediaan_pasar',
        'ketersediaan_sd',
        'rincian_investasi',
        'desc_luas_lahan',
        'desain_layout_proyek',

        'sumber_air',
        'kelistrikan',
        'telekomunikasi',
    ];

    protected $fillable = [
        'nama',
        'sektor_id',
        'user_id',
        'profile_kabkota_id',
        'kab_kota_id',
        'market_id',
        'latar_belakang',
        'lokasi',
        'lingkup_pekerjaan',
        'eksisting',
        'luas_lahan',
        'status_kepemilikan',
        'nilai_investasi',
        'skema_investasi',
        'npv',
        'irr',
        'bc_ratio',
        'playback_period',
        'cp_nama',
        'cp_email',
        'cp_alamat',
        'cp_hp',
        'file_kajian',
        'foto',
        'file_keuangan',
        'status',
        'ketersediaan_pasar',
        'ketersediaan_sd',
        'desain_layout_proyek',
        'rincian_investasi',
        'desc_luas_lahan',

        'lat',
        'lng',
        'location',

        'sumber_air',
        'kelistrikan',
        'telekomunikasi',
    ];


    protected $appends = [
        'location',
    ];

    protected $spatial = ['location'];

    public function getLocationAttribute(): array
    {
        return [
            "lat" => (float) $this->lat,
            "lng" => (float) $this->lng,
        ];
    }

    public function setLocationAttribute(?array $location): void
    {
        if (is_array($location)) {
            $this->attributes['lat'] = $location['lat'];
            $this->attributes['lng'] = $location['lng'];
            unset($this->attributes['location']);
        }
    }

    public static function getLatLngAttributes(): array
    {
        return [
            'lat' => 'lat',
            'lng' => 'lng',
        ];
    }

    public static function getComputedLocation(): string
    {
        return 'location';
    }

    public function sektor()
    {
        return $this->belongsTo(SektorCjibf::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function profilDaerah()
    {
        return $this->belongsTo(ProfileKabkota::class);
    }

    public function kabKota()
    {
        return $this->belongsTo(Kabkota::class);
    }

    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function allData()
    {
        $result = DB::table('proyek_investasis')
            ->select('lokasi')
            ->get();
        return $result;
    }
}