<?php

namespace App\Exports\Sidikaryo;

use App\Models\Sidikaryo\SidikaryoDapodik;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SidikaryoDapodikExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SidikaryoDapodik::all();
    }

     public function headings(): array
    {
        return [
            'Tahun Data',
            'Kode Kab/Kota',
            'Kabupaten/Kota',
            'Nama SMA/SMK',
            // 'Jumlah Laki-laki',
            // 'Jumlah Perempuan',
            // 'Siswa Laki Kelas 12',
            // 'Siswa Perempuan Kelas 12',
            // 'Siswa Laki Kelas 13',
            // 'Siswa Perempuan Kelas 13',
            'Bntuk Pndidikan',
            'Jurusan',
            'Jumlah Kelulusan Laki-laki',
            'Jumlah Kelulusan Perempuan',
            'CJIP Kota ID',
            'Kab/Kota ID'
        ];
    }

    public function map($row): array
    {
        return [
            $row->tahun_data,
            $row->kode_kabkota,
            $row->kab_kota,
            $row->nama_sma_smk,
            $row->bentuk_pendidikan_id,
            // $row->jumlah_laki_laki,
            // $row->jumlah_perempuan,
            // $row->siswa_laki12,
            // $row->siswa_perempuan12,
            // $row->siswa_laki13,
            // $row->siswa_perempuan13,
            $row->jurusan,
            $row->kelulusan_laki,
            $row->kelulusan_perempuan,
            $row->cjip_kota_id,
            $row->kabkota_id
        ];
    }
}
