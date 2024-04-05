<?php

namespace App\Imports\SiMike;

use App\Models\Cjip\Sektor;
use App\Models\SiMike\Proyek;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpParser\Node\Stmt\Else_;

class SiMikeImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue, WithUpserts, WithEvents, WithValidation
{
    use RemembersChunkOffset, RemembersRowNumber, RegistersEventListeners;
    private $kab_kota_id;
    private $tahun;
    private $triwulan;
    private $user_id;
    private $mulai;
    private $akhir;
    private $rules_id;
    public $dikecualikan = false;

    public $kblis = [];
    public $anomaly = false;
    public $dataToInsert, $dashboardToInsert = [], $kabkotas = [], $sektors = [];
    public $nilai_investasi,
    $nilai_investasi_pma,
    $nilai_investasi_pmdn,
    $jumlah_nib = 1,
    $jumlah_proyek = 1,
    $jumlah_tk,
    $jumlah_proyek_pma = 1,
    $jumlah_proyek_pmdn = 1,
    $sumber_data,
    $kabkotaId;

    public function __construct($kab_kota_id, $tahun, $triwulan, $user_id, $mulai, $akhir, $rules_id)
    {
        $this->kab_kota_id = $kab_kota_id;
        $this->tahun = $tahun;
        $this->triwulan = $triwulan;
        $this->user_id = $user_id;
        $this->mulai = $mulai;
        $this->akhir = $akhir;
        $this->rules_id = $rules_id;
        //dd($bidang);

        //dd($aturan->rules);
        //$rules = json_decode($aturan->rules);
        //dd($rules);
    }

    public function rules(): array
    {
        return [
            'id_proyek' => [
                'required',
            ],
            'nib' => [
                'required',
            ],
        ];
    }

    public function model(array $row)
    {
        // dd($row);
        // $row['tanggal_terbit_oss'] = Carbon::createFromFormat('d/m/Y', $row['tanggal_terbit_oss']);

        $sektor = Sektor::where('kbli', $row['kbli'])->first();

        if (empty($row['jumlah_investasi']) && empty($row['modal_usaha'])) {
            $row['jumlah_investasi'] = 0;
        }
        //dd($row);
        /*if (Proyek::where('nib', $row['nib'])->exists()){
            $nib_count = 0;
        }
        else{
            $nib_count = 1;
        }*/



        $proyekRilis = [
            now()->year => [
                'tw1' => false,
                'tw2' => false,
                'tw3' => false,
                'tw4' => false,
            ]
        ];

        $user = [
            'user_id' => $this->user_id,
            'kab_kota_id' => $this->kab_kota_id,
            'tahun' => $this->tahun,
            'triwulan' => $this->triwulan,
            'periode_start' => $this->mulai,
            'periode_end' => $this->akhir,
            'rules_id' => $this->rules_id,
            'nama_user' => $row['nama_user'] ?? $row['nama_usaha'] ?? null,
            'nama_perusahaan' => $row['nama_perusahaan'] ?? $row['nama_usaha'] ?? null,
            'nomor_telp' => $row['nomor_telp'] ?? $row['telp'] ?? null,
            'alamat' => $row['alamat'] ?? $row['alamat_usaha'] ?? null,
            'tki' => $row['tki'] ?? $row['tenaga_kerja'] ?? null,
            'modal_kerja' => $row['modal_kerja'] ?? $row['modal_usaha'] ?? null,
            'jumlah_investasi' => $row['jumlah_investasi'] ?? str_replace(',', '', $row['modal_usaha']) ?? null,
            'id_proyek' => $row['id_proyek'] ?? $row['nib'] . $row['kbli'] ?? null,
            'id_proyek_tw' => $row['id_proyek'] . '-' . $this->triwulan ?? $row['nib'] . $row['kbli'] ?? null,
            'uraian_status_penanaman_modal' => $row['uraian_status_penanaman_modal'] ?? 'PMDN' ?? null,
            'uraian_skala_usaha' => $row['uraian_skala_usaha'] ?? 'Usaha Mikro',
            'sektor' => $sektor->sektor ?? null,
            'sektor_id' => $sektor->id ?? null,
            'is_anomaly' => $this->anomaly,
            'dikecualikan' => $this->dikecualikan,
            'rilis' => json_encode($proyekRilis)
        ];

        // if (!empty($row['jumlah_investasi'])) {
        //     //dd($row);
        //     //dd((int)$row('bangunan_gedung'));
        //     $total = (int) $user['jumlah_investasi'] - ((int) $row['pembelian_pematangan_tanah'] + (int) $row['bangunan_gedung']);
        // } else {
        //     $total = $user['jumlah_investasi'];
        // }
        // if (($total > 1000000000 or $total <= 0) && ($user['uraian_skala_usaha'] === 'Usaha Mikro')) {
        //     $this->anomaly = true;
        //     $user['is_anomaly'] = true;
        // }

        //  =========================================== Rumus Baru ============================================= //


        if (!empty($row['jumlah_investasi'])) {
            $total = $user['jumlah_investasi'];
        }
        if (($total > 1000000000 or $total = 0) && ($user['uraian_skala_usaha'] === 'Usaha Mikro')) {
            $this->anomaly = true;
            $user['is_anomaly'] = true;
        }

        // switch ($row['kbli']) {
        //     case '11090':
        //     case '11091':
        //     case '11092':
        //         $user['dikecualikan'] = true;
        //         break;
        //     default:
        //         $user['dikecualikan'] = false;
        //         break;
        // }

        if (in_array($row['kbli'], ['68111', '85122', '47301', '86105']) && ($user['uraian_skala_usaha'] === 'Usaha Mikro')) {
            $user['dikecualikan'] = true;
        }

        if (in_array($row['klsektor_pembina'], ['Kementerian Kesehatan', 'Kementerian Pekerjaan Umum dan Perumahan Rakyat', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', 'Kementerian Energi dan Sumber Daya Mineral', 'Kementerian Pekerjaan Umum dan Perumahan Rakyat'])) {
            $user['dikecualikan'] = true;
        }


        //  =========================================== Rumus Baru ============================================= //

        $data = array_merge(
            $row,
            $user,
            [
                'total_investasi' => $total
            ]
        );

        $this->dikecualikan = false;
        $this->anomaly = false;

        return new Proyek($data);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function uniqueBy()
    {
        return 'id_proyek_tw';
    }
}
