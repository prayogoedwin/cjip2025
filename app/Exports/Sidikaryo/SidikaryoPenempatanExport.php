<?php

namespace App\Exports\Sidikaryo;

use App\Models\Sidikaryo\SidikaryoPenempatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SidikaryoPenempatanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SidikaryoPenempatan::all();
    }

    public function headings(): array
    {
        return [
            'Kabupaten/Kota',
            'Jumlah Laki-laki',
            'Jumlah Perempuan',
            'Total',
            'Tanggal Tarik',
        ];
    }

    public function map($row): array
    {
        return [
            $row->kota,
            $row->jmllaki,
            $row->jmlperempuan,
            $row->total,
            $row->created_at,
        ];
    }
}
