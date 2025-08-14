<?php

namespace App\Exports\Sidikaryo;

use App\Models\Sidikaryo\SidikaryoBkk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SidikaryoBkkExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SidikaryoBkk::all();
    }

    public function headings(): array
    {
        return [
            'Kabupaten/Kota',
            'Nama Sekolah',
            'Nama BKK',
            'Telepon',
            'HP',
            'Email',
            'Website',
            'Contact Person',
            'Jabatan',
            'Alamat'
        ];
    }

    public function map($row): array
    {
        return [
            $row->kota,
            $row->nama_sekolah,
            $row->nama_bkk,
            $row->telpon,
            $row->hp,
            $row->email,
            $row->website,
            $row->contact_person,
            $row->jabatan,
            $row->alamat
        ];
    }
}
