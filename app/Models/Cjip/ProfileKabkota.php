<?php

namespace App\Models\Cjip;

use App\Models\Cjip\Kabkota;
use App\Models\User;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProfileKabkota extends Model
{
    use HasFactory, HasTranslations;

    protected $casts = [
        'proyek_investasi' => 'array',
        'proyek_kerja_sama' => 'array',
        'infrastruktur' => 'array',
    ];

    protected $table = 'profile_kabkotas';

    protected $fillable = [
        'profil', 'desc_profil','kab_kota_id', 'foto','icon','luas','infrastruktur','jarak_ke_smg',
        'rtrw','grdp','pert_ekonomi','inflasi',
        'populasi','angka_kerja','umr','komp_usia',
        'tahun','status','proyek_kerja_sama','proyek_investasi'
    ];

    protected $translatable = [
        'profil', 'desc_profil', 'luas','jarak_ke_smg',
        'rtrw','grdp','pert_ekonomi','inflasi',
        'populasi','angka_kerja','umr','komp_usia',
    ];

    public function kabkota(){
        return $this->belongsTo(Kabkota::class, 'kab_kota_id');
    }

    // public function admin(){
    //     return $this->belongsTo(User::class, 'user_id');
    // }
}
