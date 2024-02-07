<?php

namespace App\Filament\Resources\SiRusa\RilisResource\Pages;

use App\Events\AfterRilisProcessed;
use App\Filament\Resources\SiRusa\RilisResource;
use App\Jobs\SiRusa\ImportRilis;
use App\Models\SiMike\Proyek;
use App\Models\SiRusa\ReportRilis;
use App\Models\SiRusa\Rilis;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;

class ListRilis extends ListRecords
{
    protected static string $resource = RilisResource::class;

    public $importFilePath;

    public $dataSend;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('import')
                ->modalHeading('Form Import Data Rilis Investasi')
                ->modalSubheading('Import Data Rilis Pertriwulan')
                ->action(function (array $data): void {

                    $this->importFilePath = storage_path('app/public/' . $data['file']);
                    //dd($this->kabkota);
                    // dd($this->importFilePath);
                    //dd($data);
                    $data['file'] = $this->importFilePath;
                    $tahun = Carbon::parse($data['tanggal_awal'])->format('Y');

                    $tw = Carbon::parse($data['tanggal_awal'])->format('m');
                    $q = ceil($tw / 3);
                    // dd($q);
                    $data['tahun'] = $tahun;

                    $this->dataSend = $data;
                    $batches = Bus::batch([
                        new ImportRilis($this->importFilePath, $data['tanggal_awal'], $data['tanggal_akhir'], \auth()->user()->id, $tahun),
                    ])
                        ->then(function (Batch $batch) use ($data) {
                            event(new AfterRilisProcessed($data));
                        })
                        ->dispatch();

                    Notification::make()
                        ->view('filament.resources.si-mike.notifications.notifications')
                        ->title('Importing Data Realisasi')
                        ->body(
                            'Proses **IMPORT** data **SIRUSA** sedang berlangsung.'
                        )
                        ->success()
                        ->send();

                    if ($batches) {
                        $this->storeReport($this->dataSend);
                    }
                })
                ->form([
                    Grid::make()->schema([
                        DatePicker::make('tanggal_awal')
                            ->label('Pediode Awal')
                            // ->format('d/m/Y')
                            // ->displayFormat('d/m/Y')
                            ->required(),
                        DatePicker::make('tanggal_akhir')
                            ->label('Pediode Akhir')
                            // ->format('d/m/Y')
                            // ->displayFormat('d/m/Y')
                            ->required(),
                    ])->columns(2),
                    FileUpload::make('file')
                        ->preserveFilenames()
                        ->directory('Si Rusa' . '/' . Carbon::now()->year)
                        ->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                        ->autofocus()
                        ->maxSize(51200)
                        ->required(),

                ]),
            Action::make('fix_rilis')
                ->action(function () {

                    $rilises = Rilis::whereNull('proyek_id')->get();

                    foreach ($rilises as $rilis) {
                        $tahun = Carbon::parse($rilis->tanggal_awal)->format('Y');

                        $tw = Carbon::parse($rilis->tanggal_awal)->format('m');
                        $q = ceil($tw / 3);

                        $proyek = Proyek::where('nib', $rilis->no_izin)
                            ->where('kbli', $rilis->deskripsi_kbli)
                            ->first();

                        if ($proyek) {
                            if ($proyek->rilis) {
                                $proyekRilis = json_decode($proyek->rilis, true);
                                //dd(array_key_exists('2022', $eksisting));
        
                                //dd($eksisting);
        
                                if (array_key_exists($tahun, $proyekRilis)) {
                                    $proyekRilis[$tahun]['tw' . (string) $q] = true;
                                } else {
                                    $add = [
                                        $tahun => [
                                            'tw1' => $q == 1 ? true : false,
                                            'tw2' => $q == 2 ? true : false,
                                            'tw3' => $q == 3 ? true : false,
                                            'tw4' => $q == 4 ? true : false,
                                        ]
                                    ];
                                    $proyekRilis[$tahun] = $add[$tahun];
                                }
                            } else {
                                $proyekRilis = [
                                    $tahun => [
                                        'tw1' => $q == 1 ? true : false,
                                        'tw2' => $q == 2 ? true : false,
                                        'tw3' => $q == 3 ? true : false,
                                        'tw4' => $q == 4 ? true : false,
                                    ]
                                ];
                            }


                            $proyek->nama_perusahaan = $proyek->nama_perusahaan ?? $rilis->nama_perusahaan;
                            $proyek->rilis = json_encode($proyekRilis);
                            $proyek->update();


                            $rilis->tahun = $tahun;
                            $rilis->triwulan = $q;
                            // $rilis->tambahan_investasi_dalam_rp_juta = $rilis->tambahan_investasi_dalam_rp_juta * 1000000;
                            $rilis->kab_kota_id = $proyek->kab_kota_id;
                            $rilis->proyek_id = $proyek->id;
                            $rilis->update();
                        } else {
                            $rilis->tahun = $tahun;
                            $rilis->triwulan = $q;
                            $rilis->update();
                        }
                    }
                })
        ];
    }

    public function storeReport(array $data)
    {
        $report = ReportRilis::create([
            'user_id' => \auth()->user()->id,
            'tanggal_awal' => $data['tanggal_awal'],
            'tanggal_akhir' => $data['tanggal_akhir'],
            'file' => $data['file'],
            'status' => 1,
        ]);

        $recipient = auth()->user();

        Notification::make()
            ->title('*Import Finished* ' . '(' . \auth()->user()->name . ')')
            ->body(
                'import data *REALISASI*  telah behasil.'
            )
            ->sendToDatabase($recipient);

        Notification::make()
            ->view('filament.resources.si-mike.notifications.notifications')
            ->title('Pengolahan Data Realisasi')
            ->body(
                'Proses **Pengolahan** data **SIRUSA** sedang berlangsung. Proses ini mungkin berjalan selama beberapa waktu.'
            )
            ->success()
            ->send();
    }

    public function findProyek(array $data)
    {
        Rilis::where('tahun', $data['tahun'])
            ->where('triwulan', $data['triwulan'])
            ->chunkById(1000, function ($rilisess) {
                foreach ($rilisess as $rilis) {
                    $proyek = Proyek::where('nib', $rilis->no_izin)
                        ->where('kbli', $rilis->deskripsi_kbli)
                        ->first();
                    if ($proyek) {
                        $proyek->tahun_rilis = $rilis->tahun;
                        $proyek->is_lapor_tw . $rilis->triwulan = true;
                        $proyek->update();

                        $rilis->kab_kota_id = $proyek->kab_kota_id;
                        $rilis->proyek_id = $proyek->id;
                        $rilis->update();
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

    protected function getHeaderWidgets(): array
    {
        return [
            // FilterWidget::class,
            // PmaPmdnPieChart::class,
            // NakerPmaPmdnPieChart::class,
            // SektorBarChart::class,
            // KabkotaBarChart::class,
            // KabkotaAllBarChart::class,
            // PmaPmdnYoYNowPieChart::class,
            // PmaPmdnYoYPieChart::class,
            // RilisInvestasiChart::class,
            // RilisWidgets::class,
            // RilisLastImport::class
        ];
    }
}
