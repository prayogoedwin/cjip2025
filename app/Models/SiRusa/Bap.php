<?php

namespace App\Models\SiRusa;

use App\Models\SiMike\Proyek;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bap extends Model
{
    use HasFactory;

    protected $casts = [
        'detail_ss' => 'array',
        'sumber_listriks' => 'array',
        'potensi_investasi' => 'array',
        'tk' => 'array',
        'jenis_kapasitas_produksi' => 'array',
        'kemitraan' => 'array',
        'jenis_fasilitas' => 'array',
        'rekomendasi' => 'array',
        'tindak_lanjut' => 'array',
        'foto_proyek' => 'array',
        'masalah' => 'array',
    ];

    protected $fillable = [
        'proyek_id',
        'nib',
        'is_punya_ss',
        'status_riil',
        'tanggal_konstruksi_selesai',
        'tanggal_mulai_operasi',
        'detail_ss',
        'rencana_investasi',
        'realisasi_investasi',
        'sumber_listriks',
        'luas_tanah',
        'luas_bangunan',
        'status_tanah',
        'kesusaian_investasi',
        'keterangan_investasi_tidak_sesuai',
        'is_lapor_lkpm',
        'potensi_investasi',
        'tk',
        'jenis_kapasitas_produksi',
        'is_mengajukan_fasilitas',
        'jenis_fasilitas',
        'is_bermitra',
        'kemitraan',
        'is_bpjs',
        'no_bpjs_ketenagakerjaan',
        'is_csr',
        'alokasi_dana_csr',
        'objek_csr',
        'program_csr',
        'dokumen_lingkungan',
        'mateial_lingkungan',
        'ipal',
        'jumlah_unit',
        'fungsi_unit',
        'jenis_pelatihan',
        'jumlah_pelatihan',
        'rekomendasi',
        'tindak_lanjut',
        'foto_proyek',
        'nama',
        'jabatan',
        'no_hp',
        'summary',

        'tanggal_bap',
        'badan_hukum',
        'nama_perusahaan',
        'status_perusahaan',
        'alamat',
        'keterangaan_riil',
        'tka',
        'jam_kerja',
        'alur_produksi',
        'status_lkpm',
        'kendala_lkpm',
        'masalah',
    ];

    public function proyek(): BelongsTo{
        return $this->belongsTo(Proyek::class, 'proyek_id', 'id');
    }
}
