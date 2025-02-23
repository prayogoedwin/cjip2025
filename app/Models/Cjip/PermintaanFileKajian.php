<?php

namespace App\Models\Cjip;

use Illuminate\Database\Eloquent\Model;

class PermintaanFileKajian extends Model
{
    protected $fillable = [
        'proyek_id',
        'name',
        'email',
        'phone',
        'company',
        'message',
        'file',
        'status',
    ];

    public function proyek()
    {
        return $this->belongsTo(ProyekInvestasi::class, 'proyek_id');
    }
}
