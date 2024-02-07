<?php

namespace App\Imports\SiRusa;

use App\Models\SiMike\Proyek;
use App\Models\SiRusa\Nib;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class NibImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue, WithUpserts
{
    use RemembersChunkOffset, RemembersRowNumber, RegistersEventListeners;

    private $tanggal_awal;
    private $tanggal_akhir;

    public function __construct($tanggal_awal, $tanggal_akhir)
    {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
        //dd($bidang);
    }

    public function model(array $row)
    {

        $row['day_of_tanggal_terbit_oss'] = Carbon::createFromFormat('m/d/Y', $row['day_of_tanggal_terbit_oss']);
        $row['tanggal_awal'] = $this->tanggal_awal;
        $row['tanggal_akhir'] = $this->tanggal_akhir;

        // Log::debug($this->tanggal_awal);
        // Log::debug($this->tanggal_akhir);
        // Log::debug($row['tanggal_awal']);
        // Log::debug($row['tanggal_akhir']);

        // $nib = Nib::where('nib', $row['nib'])->first();
        // if ($nib){
        //     $nib->tanggal_awal = $this->tanggal_awal ?? $row['tanggal_awal'];
        //     $nib->tanggal_akhir = $this->tanggal_akhir ?? $row['tanggal_akhir'];
        //     $nib->update();
        // }

        $nib = Nib::create($row);
        $proyeks = Proyek::whereNull('nib_id')->where('nib', $row['nib'])->get();
        //dd($proyeks);
        if ($proyeks) {

            $proyekRilis = [
                now()->year => [
                    'tw1' => false,
                    'tw2' => false,
                    'tw3' => false,
                    'tw4' => false,
                ]
            ];

            foreach ($proyeks as $proyek) {
                $proyek->nib_id = $nib->id;
                $proyek->update();
            }
        }

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
        return 'nib';
    }





}
