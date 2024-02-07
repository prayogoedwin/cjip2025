<?php

namespace App\Exports\SiRusa\Nib;

use App\Models\SiMike\Proyek;
use App\Models\SiRusa\Nib;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class AllNib implements FromCollection, WithHeadings
{
    public $status, $day_of_tanggal_terbit_oss, $status_pm, $kabkota, $sektor;

    public function __construct($status, $day_of_tanggal_terbit_oss, $status_pm, $kabkota, $sektor)
    {
        $this->status = $status;
        $this->day_of_tanggal_terbit_oss = $day_of_tanggal_terbit_oss;
        $this->status_pm = $status_pm;
        $this->kabkota = $kabkota;
        $this->sektor = $sektor;
    }

    /**
     * @return \Illuminate\Support\Collection
     */


    public function headings(): array
    {
        return [
            'id',
            'nib_id',
            'is_tambahan',
            'id_proyek',
            'kbli',
            'judul_kbli',
            'flag',
            'uraian_risiko_proyek',
            'uraian_skala_usaha',
            'alamat_usaha',
            'kelurahan_usaha',
            'kecamatan_usaha',
            'kabkota_usaha',
            'provinsi_usaha',
            'langitude',
            'longitude',
            'tanggal_pengajuan_proyek',
            'tki',
            'tka',
            'tahun',
            'triwulan',
            'mesin_peralatan',
            'mesin_peralatan_import',
            'pembelian_pematangan_tanah',
            'modal_kerja',
            'lain_lain',
            'jumlah_investasi',
            'kab_kota_id',
            'user_id',
            'klsektor_pembina',
            'last_edited_by_id',
            'created_at',
            'updated_at',
            'sektor',
            'sektor_id',
            'periode_start',
            'periode_end',
            'rules_id',
            'nib',
            'is_anomaly',
            'total_investasi',
            'nama_perusahaan',
            'npwp_perusahaan',
            'uraian_status_penanaman_modal',
            'nama_user',
            'nomor_identitas_user',
            'email',
            'alamat',
            'no_telp',
            'nib_count',
            'bangunan_gedung',
            'kl_sektor_pembina',

            'is_jateng',
            'is_lapor_tw1',
            'is_lapor_tw2',
            'is_lapor_tw3',
            'is_lapor_tw4',
            'pengawasan_id',
            'tahun_rilis',
            'rilis',
        ];
    }
    public function collection()
    {
        if ($this->status === 'jatengnonjateng') {
            return Proyek::with('nibCheck')
                ->filterPerusahaan($this->day_of_tanggal_terbit_oss, $this->status_pm, $this->kabkota, $this->sektor)
                ->get();
        } elseif ($this->status === 'jateng') {
            return Proyek::whereHas('nibCheck')
                ->filterPerusahaan($this->day_of_tanggal_terbit_oss, $this->status_pm, $this->kabkota, $this->sektor)
                ->get();
        } elseif ($this->status === 'non_jateng') {
            return Proyek::whereDoesntHave('nibCheck')
                ->filterPerusahaan($this->day_of_tanggal_terbit_oss, $this->status_pm, $this->kabkota, $this->sektor)
                ->get();
        } else {
            return Nib::whereDoesntHave('proyeks')->get();
        }
    }
}