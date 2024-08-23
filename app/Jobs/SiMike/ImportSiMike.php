<?php

namespace App\Jobs\SiMike;

use App\Imports\SiMike\SiMikeImport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Filament\Notifications\Notification;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Validators\ValidationException;

class ImportSiMike implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $file, $kabkota, $tahun, $triwulan, $user, $mulai, $akhir, $rules_id;

    /**
     * Create a new job instance.
     */
    public function __construct($file, $kabkota, $tahun, $triwulan, $mulai, $akhir, $rules_id)
    {
        $this->file = $file;
        $this->kabkota = $kabkota;
        $this->tahun = $tahun;
        $this->triwulan = $triwulan;
        $this->user = auth()->id();
        $this->mulai = $mulai;
        $this->akhir = $akhir;
        $this->rules_id = $rules_id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Log::info('ImportSimike job started');
        Log::info('File path: ' . $this->file);
        Log::info('Kabkota: ' . $this->kabkota);
        Log::info('Year: ' . $this->tahun);
        Log::info('Quarter: ' . $this->triwulan);
        Log::info('Period start: ' . $this->mulai);
        Log::info('Period end: ' . $this->akhir);
        Log::info('Rules ID: ' . $this->rules_id);
        try {
            Excel::import(new SiMikeImport($this->kabkota, $this->tahun, $this->triwulan, $this->user, $this->mulai, $this->akhir, $this->rules_id), $this->file);
        } catch (ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {

                Notification::make()
                    ->view('filament.resources.si-mike.notifications.notifications')
                    ->title('Importing Si Mike')
                    ->body(
                        'Proses **IMPORT** data **SIMIKE**
                        gagal. ' .
                            $failure->row() .
                            $failure->attribute() .
                            $failure->errors() .
                            $failure->values()
                    )
                    ->danger()
                    ->send();
            }
        }
    }
}
