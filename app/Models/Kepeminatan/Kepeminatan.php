<?php

namespace App\Models\Kepeminatan;

use App\Models\Cjip\ProyekInvestasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepeminatan extends Model
{
    use HasFactory;
    protected $table = 'kepeminatans';
    protected $fillable = [
        'user_id',
        'rencana_bidang_usaha',
        'status_investasi',
        'prefensi_lokasi',
        'nilai_investasi',
        'nilai_investasi_rupiah',
        'deskripsi_proyek',
        'jadwal_proyek',
        'local_worker_plan',
        'local_worker_exis',
        'foreign_worker_plan',
        'foreign_worker_exis',
        'local_plan',
        'local_exis',
        'foreign_plan',
        'foreign_exis',
        'loi_signed',
        'status_id',
        'other_information',
        'proyek_id',
        'sektor',
        'interest_invesment'
    ];

    protected $cast = [
        'local_plan' => 'boolean',
        'local_exis' => 'boolean',
        'foreign_plan' => 'boolean',
        'foreign_exis' => 'boolean',
        'interest_invesment' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function status_template()
    {
        return $this->belongsTo(TemplateEmail::class, 'status_id');
    }

    public function proyek()
    {
        return $this->belongsTo(ProyekInvestasi::class, 'proyek_id');
    }
}
