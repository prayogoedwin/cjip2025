<?php

namespace App\Jobs\SiRusa;

use App\Models\SiMike\Proyek;
use App\Models\SiRusa\Nib;
use Filament\Notifications\Notification;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CompareNIB implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        DB::table('nibs')
            ->orderBy('day_of_tanggal_terbit_oss')
            ->chunk(1000, function ($nibs) {
                $nibIds = $nibs->pluck('nib')->toArray();

                $proyeks = Proyek::with('nibCheck')
                    ->whereIn('nib', $nibIds)
                    ->whereNull('nib_id')
                    ->get();

                $nibsToUpdate = [];
                $proyeksToUpdate = [];

                foreach ($proyeks as $proyek) {
                    $nib = Nib::where('nib', $proyek->nib)->first();

                    if ($nib){
                        $nibsToUpdate[] = [
                            'id' => $nib->id,
                            'kab_kota_id' => $proyek->kab_kota_id,
                            'is_jateng' => true,
                        ];

                        $proyeksToUpdate[] = [
                            'id' => $proyek->id,
                            'nib_id' => $nib->id,
                        ];
                    }


                }

                if (!empty($nibsToUpdate)) {
                    Nib::upsert($nibsToUpdate, ['id'], ['kab_kota_id', 'is_jateng']);
                }

                if (!empty($proyeksToUpdate)) {
                    Proyek::upsert($proyeksToUpdate, ['id'], ['nib_id']);
                }
            });
    }
}
