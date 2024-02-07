<?php

namespace App\Exports\SiRusa\Nib;

use App\Models\SiMike\Proyek;
use Maatwebsite\Excel\Concerns\FromCollection;

class AllResiko implements FromCollection
{
    public $status, $skala, $resiko, $tahun;

    public function __construct($status, $skala, $resiko, $tahun)
    {
        $this->status = $status;
        $this->skala = $skala;
        $this->resiko = $resiko;
        $this->tahun = $tahun;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->status === 'jateng') {
            return Proyek::where('tahun', $this->tahun)
                ->where('uraian_skala_usaha', $this->skala)
                ->where('uraian_risiko_proyek', $this->resiko)
                ->whereHas('nibCheck')
                ->get();
        } else {
            return Proyek::where('tahun', $this->tahun)
                ->where('uraian_skala_usaha', $this->skala)
                ->where('uraian_risiko_proyek', $this->resiko)
                ->whereDoesntHave('nibCheck')
                ->get();
        }
    }
}