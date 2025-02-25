<?php

namespace App\Filament\Resources\SiMike\ProyekResource\Pages;

use App\Filament\Resources\SiMike\ProyekResource;
use App\Filament\Resources\SiMike\ProyekResource\Widgets\LastImportSimike;
use App\Filament\Widgets\Simike\DashboardSimike;
use App\Jobs\ImportSimikeAdmin;
use App\Jobs\SiMike\ImportSiMike;
use App\Models\SiMike\Report;
use App\Models\SiMike\RulesSimike;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ListProyeks extends ListRecords
{
    protected static string $resource = ProyekResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            // DashboardSimike::class,
            LastImportSimike::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('import')
                ->modalHeading('Form Import Data Proyek')
                ->modalSubheading('Import Data Proyek Unduhan OSS *Perbulan')
                ->action(function (array $data): void {
                    // dd($data);

                    if (Auth::user()->hasRole('kabkota')) {
                        $this->kabkota = Auth::user()->kabkota->id;
                    }

                    $this->importing = true;
                    $this->importFilePath = storage_path('app/public/' . $data['file']);
                    //dd($this->kabkota);

                    if (auth()->user()->hasRole('super_admin')) {
                        $batch = Bus::batch([
                            new ImportSimikeAdmin($this->importFilePath, $data['tahun'], $data['triwulan'], $data['periode_start'], $data['periode_end'], $data['rules_id'])
                        ])->dispatch();
                    } else {
                        $batch = Bus::batch([
                            new ImportSiMike($this->importFilePath, $this->kabkota, $data['tahun'], $data['triwulan'], $data['periode_start'], $data['periode_end'], $data['rules_id']),
                        ])->dispatch();

                        if ($batch) {

                            $this->storeReport($data);
                        }
                    }

                    $this->batchId = $batch->id;
                    Notification::make()
                        ->view('filament.resources.si-mike.notifications.notifications')
                        ->title('Importing Si Mike')
                        ->body(
                            'Proses **IMPORT** data **SIMIKE**
                        periode **' . Carbon::parse($data['periode_start'])->toDateString() . '-' . Carbon::parse($data['periode_end'])->toDateString() . '**'
                                . ' sedang berlangsung. '
                        )
                        ->success()
                        ->send();
                })
                ->form([
                    Hidden::make('rules_id')->label('Rules')
                        ->label('Sumber Data')
                        ->default(function () {
                            return RulesSimike::where('is_active', true)->first()->id;
                        }),
                    Grid::make()->schema([
                        DatePicker::make('periode_start')
                            ->label('Periode Data (mulai)')
                            ->helperText('Sesuaikan dengan *Tanggal Awal* saat mengunduh data OSS')
                            ->default(Carbon::now()->subMonth()->startOfMonth()),
                        DatePicker::make('periode_end')
                            ->label('Periode Data (akhir)')
                            ->helperText('Sesuaikan dengan *Tanggal Akhir* saat mengunduh data OSS'),
                    ])->columns(2),
                    Grid::make()->schema([
                        Select::make('tahun')
                            ->options(function () {
                                $years = range(Carbon::now()->year, Carbon::now()->subYear(5)->year);
                                //dd($years);
                                //dd(array_combine($years, $years));
                                return array_combine($years, $years);
                            })
                            ->helperText('Isikan *Tahun* dengan data yang diunduh')
                            ->default(Carbon::now()->year)
                            ->required(),
                        Select::make('triwulan')
                            ->options([
                                1 => 'I',
                                2 => 'II',
                                3 => 'III',
                                4 => 'IV',
                            ])
                            ->helperText('Isikan *Triwulan* dengan data yang diunduh')
                            ->default(function () {
                                $bulan_ini = Carbon::now()->month;
                                if ($bulan_ini <= 3) {
                                    return 1;
                                } elseif ($bulan_ini >= 3 && $bulan_ini <= 6) {
                                    return 2;
                                } elseif ($bulan_ini >= 6 && $bulan_ini <= 9) {
                                    return 3;
                                } elseif ($bulan_ini >= 9 && $bulan_ini <= 12) {
                                    return 4;
                                }
                                return null;
                            })
                            ->required(),
                    ])->columns(2),

                    FileUpload::make('file')
                        ->getUploadedFileNameForStorageUsing(
                            fn(TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                ->prepend(Carbon::now()->subMonth()->format('M Y') . '_'),
                        )
                        ->directory('Si Mike/' . Auth::user()->name . '/' . Carbon::now()->year)
                        ->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                        ->autofocus()
                        ->maxSize(51200)
                        ->required()
                        ->helperText('File asli unduhan OSS tidak diedit.')
                ])
                ->icon('heroicon-m-document-plus')
                ->size('md')
        ];
    }

    protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery()->with(['kabkota', 'sektor', 'kbli2digit', 'nibCheck', 'rules'])->where('dikecualikan', 0)->where('is_mapping', 1);

        if (auth()->user()->hasRole('kabkota')) {
            $query->where('kab_kota_id', auth()->user()->kabkota->id);
        }

        return $query;
    }
    public function storeReport(array $data)
    {
        $report = Report::create([
            'user_id' => \auth()->user()->id,
            'triwulan' => $data['triwulan'],
            'tahun' => $data['tahun'],
            'periode_start' => $data['periode_start'],
            'periode_end' => $data['periode_end'],
            'bulan' => Carbon::parse($data['periode_start'])->month,
        ]);

        $recipient = auth()->user();

        Notification::make()
            ->title('*Import Finished* ' . '(' . \auth()->user()->kabkota->nama . ')')
            ->body(
                'import data *SIMIKE* pada periode '
                    . Carbon::parse($data['periode_start'])->toDateString()
                    . ' hingga '
                    . Carbon::parse($data['periode_end'])->toDateString()
                    . 'telah behasil'
            )
            ->sendToDatabase($recipient);
    }
}
