<?php

namespace App\Models\Cjip;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Translatable\HasTranslations;

class KawasanIndustri extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = [
        'nama',
        'perusahaan',
        'kawasan',
        'masterplan',
        'produk',
        'lahan_siap_bangun',
        'bangun_pabrik_siap_pakai',
        'produk_lainnya',

        'jaringan_energi_listrik',
        'jaringan_telekomunikasi',
        'jaringan_sda',
        'sanitasi',
        'jaringan_transportasi',

        'perumahan',
        'pendidikan_pelatihan',
        'penelitian_pengembangan',
        'kesehatan',
        'pemadam_kebakaran',
        'tempat_pembuangan_sampah',

        'instalasi_pengelolaan_air_baku',
        'instalasi_pengelolaan_air_limbah',
        'saluran_drainase',
        'instalasi_penerangan_jalan',
        'jaringan_jalan',
        'fasilitas',


        // 'tenant_en',
    ];

    protected $casts = [
        'lokasi' => 'array',
        'tenant' => 'array',
        'foto' => 'array',
    ];

    protected $table = 'kawasan_industris';

    protected $fillable = [
        'foto',
        'nama',
        'jenis_kawasan_id',
        'perusahaan',
        'kawasan',
        'lokasi',
        'masterplan',

        // 'produk',
        'produk',
        'image_produk',
        'lahan_siap_bangun',
        'image_lahan_siap_bangun',
        'bangun_pabrik_siap_pakai',
        'image_bangun_pabrik_siap_pakai',
        'produk_lainnya',
        'image_produk_lainnya',
        'image_masterplan',

        // 'infrastruktur_industri',
        'jaringan_energi_listrik',
        'image_jaringan_energi_listrik',
        'jaringan_telekomunikasi',
        'image_jaringan_telekomunikasi',
        'jaringan_sda',
        'image_jaringan_sda',
        'sanitasi',
        'image_sanitasi',
        'jaringan_transportasi',
        'image_transportasi',

        // 'infrastruktur_penunjang',
        'perumahan',
        'image_perumahan',
        'pendidikan_pelatihan',
        'image_pendidikan_pelatihan',
        'penelitian_pengembangan',
        'image_penelitian_pengembangan',
        'kesehatan',
        'image_kesehatan',
        'pemadam_kebakaran',
        'image_pemadam_kebakaran',
        'tempat_pembuangan_sampah',
        'image_tempat_pembuangan_sampah',

        // 'infrastruktur_dasar',
        'instalasi_pengelolaan_air_baku',
        'image_instalasi_pengelolaan_air_baku',
        'instalasi_pengelolaan_air_limbah',
        'image_instalasi_pengelolaan_air_limbah',
        'saluran_drainase',
        'image_saluran_drainase',
        'instalasi_penerangan_jalan',
        'image_instalasi_penerangan_jalan',
        'jaringan_jalan',
        'image_jaringan_jalan',

        'fasilitas',
        'image_fasilitas',
        'tenant',
        'url_video',
        'user_id',

        // Menambah coloum status
        'status',
        'lat',
        'lng',
        'kawasan_id',
        'url_website',

    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function jeniskawasan()
    {
        return $this->belongsTo(JenisKawasan::class, 'jenis_kawasan_id');
    }

    public function lois()
    {
        return $this->hasMany(Loi::class);
    }

    // public function save(array $options = [])
    // {
    //     if(Auth::guard('admin')->user()->hasRole('kab')){
    //         $this->user_id = Auth::guard('admin')->user()->id;
    //     };

    //     parent::save();
    // }
}