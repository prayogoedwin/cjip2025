<?php

namespace App\Jobs\SiRusa;

use App\Imports\SiRusa\RilisImport;
use Filament\Notifications\Notification;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class ImportRilis implements ShouldQueue, WithEvents
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels, RegistersEventListeners;

    private $file, $tanggal_awal, $tanggal_akhir, $triwulan, $user, $tahun;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $tanggal_awal, $tanggal_akhir, $user, $tahun)
    {
        $this->file = $file;
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
        $this->user = $user;
        $this->tahun = $tahun;

        //dd($file);
        // dd($kabkota);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        try {
            Excel::import(new RilisImport($this->tanggal_awal, $this->tanggal_akhir, $this->user, $this->tahun), $this->file);
        } catch (ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {

                //dd($failure->errors());

                Notification::make()
                    ->view('filament.resources.si-mike.notifications.notifications')
                    ->title('Importing Si Mike')
                    ->body(
                        'Proses **IMPORT** data **SIRUSA**
                        gagal. ' .
                        $failure->row() .
                        $failure->attribute() .
                        implode(',', $failure->errors()) .
                        $failure->values()
                    )
                    ->danger()
                    ->send();
            }
        }

    }

}
