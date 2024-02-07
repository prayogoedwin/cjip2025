<?php

namespace App\Jobs;

use App\Imports\NewSiMikeImportAdmin;
use App\Imports\ProyekImport;
use App\Imports\SiMikeImportAdmin;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ImportSimikeAdmin implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $tahun, $triwulan, $user, $file, $mulai, $akhir, $rules_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $tahun, $triwulan, $mulai, $akhir, $rules_id)
    {
        $this->tahun = $tahun;
        $this->triwulan = $triwulan;
        $this->user = auth()->id();
        $this->file = $file;
        $this->mulai = $mulai;
        $this->akhir = $akhir;
        $this->rules_id = $rules_id;

        // dd($kabkota);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Excel::import(new ProyekImport( $this->tahun, $this->triwulan, $this->user, $this->mulai, $this->akhir, $this->rules_id), $this->file);
    }
}
