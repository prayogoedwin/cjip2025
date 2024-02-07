<?php

namespace App\Models\Cjip;

use App\Models\Cjip\Kabkota;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Loi extends Model
{
    use HasFactory;


    public $table = 'lois';

    public $fillable = [
        'nama_pengusaha',
        'jabatan_pengusaha',
        'bidang_usaha',

        'nama_perusahaan',
        'alamat_perusahaan',
        'email',
        'lokasi',
        'phone',
        'asal_negara',
        'tgl_ttd',
        'nilai_rp',
        'is_cjibf',

        'kab_kota_id',

        'parent_company',
        'investment_status',
        'rencana_bidang_usaha',
        'nilai_usd',
        'rencana_tki',
        'rencana_tka',
        'eksisting_tki',
        'eksisting_tka',
        'proyek_id',
        'deskripsi_proyek',
        'timeline_proyek',
        'signed_loi',
        'doc_loi',
        'event_id',
        'user_lo',
        'user_id',

        'is_proyek_jateng',
        'is_kawasan',
        'mata_uang',
        'kawasan_industri_id',
        'investment_status',
        'sektor',
    ];

    public function kabKota()
    {
        return $this->belongsTo(Kabkota::class);
    }

    public function kawasan(){
        return $this->belongsTo(KawasanIndustri::class, 'kawasan_industri_id');
    }

    public function lo(){
        return $this->belongsTo(User::class, 'user_lo');
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }
}
