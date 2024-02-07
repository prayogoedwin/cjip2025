<?php

namespace App\Exports\SiRusa\Nib;

use App\Models\SiMike\Proyek;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllSkala implements FromCollection
{

    public $status, $skala, $tahun;

    public function __construct($status, $skala, $tahun)
    {
        $this->status = $status;
        $this->skala = $skala;
        $this->tahun = $tahun;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if ($this->status === 'jateng'){
            return Proyek::where('tahun', $this->tahun)
                ->where('uraian_skala_usaha', $this->skala)
                ->whereHas('nibCheck')
                ->get();
        }
        else{
            return Proyek::where('tahun', $this->tahun)
                ->where('uraian_skala_usaha', $this->skala)
                ->whereDoesntHave('nibCheck')
                ->get();
        }
    }
}
