<?php

namespace App\Models\Kepeminatan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;
    protected $table = 'perusahaan';
    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        'jenis_usaha',
        'alamat_perusahaan',
        'nib',
        'negara_asal',
        'induk_perusahaan',
        'telepon_perusahaan',
        'nama_pimpinan',
        'telepon_pimpinan',
        'alamat_pimpinan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
