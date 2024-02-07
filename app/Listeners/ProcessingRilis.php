<?php

namespace App\Listeners;

use App\Events\AfterRilisProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\SiMike\Proyek;
use App\Models\SiRusa\Rilis;
use Filament\Notifications\Notification;

class ProcessingRilis
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AfterRilisProcessed $event)
    {

        //dd($event);

        DB::table('rilis')->where('tahun', $event->data['tahun'])
            ->chunkById(1000, function ($rilisess) {
                foreach ($rilisess as $rilis) {
                    $proyek = Proyek::where('nib', $rilis->no_izin)
                        ->where('kbli', $rilis->deskripsi_kbli)
                        ->first();
                    if ($proyek) {

                        if ($proyek->rilis) {
                            $proyekRilis = json_decode($proyek->rilis, true);
                            //dd(array_key_exists('2022', $eksisting));
    
                            //dd($eksisting);
    
                            if (array_key_exists($rilis->tahun, $proyekRilis)) {
                                $proyekRilis[$rilis->tahun]['tw' . (string) $rilis->triwulan] = true;
                            } else {
                                $add = [
                                    $rilis->tahun => [
                                        'tw1' => $rilis->triwulan == 1 ? true : false,
                                        'tw2' => $rilis->triwulan == 2 ? true : false,
                                        'tw3' => $rilis->triwulan == 3 ? true : false,
                                        'tw4' => $rilis->triwulan == 4 ? true : false,
                                    ]
                                ];
                                $proyekRilis[$rilis->tahun] = $add[$rilis->tahun];
                            }
                        } else {
                            $proyekRilis = [
                                $rilis->tahun => [
                                    'tw1' => $rilis->triwulan == 1 ? true : false,
                                    'tw2' => $rilis->triwulan == 2 ? true : false,
                                    'tw3' => $rilis->triwulan == 3 ? true : false,
                                    'tw4' => $rilis->triwulan == 4 ? true : false,
                                ]
                            ];
                        }


                        $proyek->nama_perusahaan = $proyek->nama_perusahaan ?? $rilis->nama_perusahaan;
                        $proyek->rilis = json_encode($proyekRilis);
                        $proyek->update();

                        $updateRilis = Rilis::find($rilis->id);

                        $updateRilis->kab_kota_id = $proyek->kab_kota_id;
                        $updateRilis->proyek_id = $proyek->id;
                        $updateRilis->update();
                    }
                }
            });


        $recipient = auth()->user();

        Notification::make()
            ->title('*Data Selesai Diolah* ' . '(' . \auth()->user()->name . ')')
            ->body(
                'olah data *REALISASI* telah behasil'
            )
            ->sendToDatabase($recipient);
    }
}
