<?php

namespace App\Models\Cjibf;

use App\Models\Cjip\KawasanIndustri;
use App\Models\Cjip\ProyekInvestasi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountInterest extends Model
{
    use HasFactory;


    protected $table = 'count_interests';

    public function proyek()
    {
        return $this->belongsTo(ProyekInvestasi::class, 'proyek_id');
    }
    public function proyekKi()
    {
        return $this->belongsTo(KawasanIndustri::class, 'proyek_id');
    }
    // public function manual()
    // {
    //     return $this->belongsTo(ManualProjects::class, 'proyek_id');
    // }
}
