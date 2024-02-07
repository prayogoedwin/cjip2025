<?php

namespace App\Imports\SiRusa;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RilisImport implements WithMultipleSheets
{

    private $tanggal_awal;
    private $tanggal_akhir;
    private $user;
    private $tahun;

    public function __construct($tanggal_awal, $tanggal_akhir, $user, $tahun)
    {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
        $this->user = $user;
        $this->tahun = $tahun;
        //dd($bidang);

        //dd($aturan->rules);
        //$rules = json_decode($aturan->rules);
        //dd($rules);

        //dd($this->sheets());
    }

    public function sheets(): array
    {
        return [
            'PMA JATENG' => new RilisPMA($this->tanggal_awal, $this->tanggal_akhir, $this->user, $this->tahun),
            'PMDN JATENG' => new RilisPMDN($this->tanggal_awal, $this->tanggal_akhir, $this->user, $this->tahun),
        ];
    }


}
