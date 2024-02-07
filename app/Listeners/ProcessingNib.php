<?php

namespace App\Listeners;

use App\Events\AfterNibProcessed;
use App\Models\SiMike\Proyek;
use App\Models\SiRusa\Nib;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class ProcessingNib
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        logger('listener');
    }

    /**
     * Handle the event.
     */
    public function handle(AfterNibProcessed $event)
    {

        logger('listener handling');
        DB::table('nibs')->chunkById(1000, function ($nibs) {
            foreach ($nibs as $nib) {

                $proyeks = Proyek::where('nib', $nib->nib)->get();

                foreach ($proyeks as $proyek) {
                    $nibUpdate = Nib::find($nib->id);
                    $nibUpdate->kab_kota_id = $proyek->kab_kota_id;
                    $nibUpdate->is_jateng = true;
                    $nibUpdate->update();


                    $proyek->nib_id = $nib->id;
                    //dd($updateProyek);
                    $proyek->update();
                }

                //dd($proyek->nib);

                /*else{
                    Nib::create([
                       'nib' => $proyek->nib,
                       'nama_perusahaan' => $proyek->nama_perusahaan,
                       'status_penanaman_modal' => $proyek->uraian_status_penanaman_modal,
                       'alamat_perusahaan' => $proyek->alamat_perusahaan,
                       'is_jateng' => false
                    ]);
                }*/
            }
        });

        logger('listener pass through');



    }
}
