<?php

namespace App\Exports\Sidikaryo;

use App\Models\Sidikaryo\SidikaryoPencaker;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SidikaryoPencakerExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SidikaryoPencaker::all();
    }

      public function headings(): array
    {
        return [
            'Kabupaten/Kota',
            'Laki-laki',
            'Perempuan',
            'Lulusan SMA/SMK',
            'Lulusan Di Bawah SMA',
            'Lulusan Sarjana+',
            'Jurusan Terbanyak',
            'Tanggal Tarik Data'
        ];
    }

    public function map($row): array
    {
        return [
            $row->kota,
            $row->l,
            $row->p,
            $row->lulusan_sma_smk,
            $row->lulusan_dibawah_sma_smk,
            $row->lulusan_sarjana_keatas,
            $row->jurusan_terbanyak,
            $row->created_at->format('d/m/Y H:i:s') // Format tanggal sesuai kebutuhan
        ];
    }
}
