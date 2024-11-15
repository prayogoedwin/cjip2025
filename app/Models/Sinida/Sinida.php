<?php

namespace App\Models\Sinida;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sinida extends Model
{
    use HasFactory;
    protected $table = 'sinida';
    protected $fillable = [
        'user_id', 'file_1', 'file_2', 'file_ktp', 'file_permohonan_direktur', 'status_id', 'kirim_kepala_dinas', 'disposisi', 'menerima_diterima',
        'kesatu_insentif', 'kesatu_sebesar', 'kedua', 'ketiga', 'keempat',
    ];

    protected $casts = [
        'disposisi' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function status_template()
    {
        return $this->belongsTo(TemplateEmail::class, 'status_id');
    }
}
