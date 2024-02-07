<?php

namespace App\Imports\SiRusa;

use App\Models\SiRusa\Rilis;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RilisPMDN implements ToModel, SkipsEmptyRows, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue, WithUpserts, WithEvents
{
    use RemembersChunkOffset, RemembersRowNumber, RegistersEventListeners;

    private $tanggal_awal;
    private $tanggal_akhir;
    private $user_id;
    private $tahun;

    public function __construct($tanggal_awal, $tanggal_akhir, $user_id, $tahun)
    {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
        $this->user_id = $user_id;
        $this->tahun = $tahun;
        //dd($bidang);

        //dd($aturan->rules);
        //$rules = json_decode($aturan->rules);
        //dd($rules);
    }
    public function model(array $row)
    {
        $statusPm = 'PMDN';

        if (!empty($row['deskripsi_kbli'])){
            preg_match('#\((.*?)\)#', $row['deskripsi_kbli'], $matches);
        }
        $tw = Carbon::parse($row['tanggal_approve_laporan'])->format('m');
        $q = ceil($tw / 3);
        $row['triwulan'] = (string) $q;
        $row['id_laporan'] = $row['id_laporan'] ?? '-';
        $row['tanggal_laporan'] = empty($row['tanggal_laporan']) ? null : Date::excelToDateTimeObject($row['tanggal_laporan']);
        $row['tanggal_approve_laporan'] = empty($row['tanggal_approve_laporan']) ? null : Date::excelToDateTimeObject($row['tanggal_approve_laporan']);
        $row['deskripsi_kbli'] = $matches[1] ?? null;
        $row['tanggal_awal'] = $this->tanggal_awal;
        $row['tanggal_akhir'] = $this->tanggal_akhir;
        $row['tahun'] = $this->tahun;
        $row['tambahan_investasi_dalam_rp_juta'] = number_format((float)$row['tambahan_investasi_dalam_rp_juta'], 2);
        $row['status_pm'] = $statusPm;

        return Rilis::create($row);
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
        return 'id_laporan';
    }

    public function headingRow(): int
    {
        return 2;
    }
}
