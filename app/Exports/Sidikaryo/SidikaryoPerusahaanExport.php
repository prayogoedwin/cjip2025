<?php

namespace App\Exports\Sidikaryo;

use App\Models\Sidikaryo\SidikaryoPerusahaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SidikaryoPerusahaanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SidikaryoPerusahaan::all();
    }

      public function headings(): array
    {
        return [
            'Kabupaten/Kota',
            'NIB',
            'Nama Perusahaan',
            'NoTlp/Hp',
            'Jumlah Lowongan',
            'Kebutuhan L',
            'Kebutuhan P',
            'Tanggal Tarik Data'
        ];
    }

    public function map($row): array
    {
        return [
            $row->kota,
            $row->nib,
            $row->name,
            $row->telpon.'-'.$row->hp,
            $row->jumlah_lowongan,
            $row->kebutuhan_l,
            $row->kebutuhan_p,
            $row->created_at->format('d/m/Y H:i:s') // Format tanggal sesuai kebutuhan
        ];
    }
}
