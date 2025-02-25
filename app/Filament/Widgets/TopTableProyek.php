<?php

namespace App\Filament\Widgets;

use App\Models\SiMike\Proyek;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use stdClass;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class TopTableProyek extends BaseWidget
{
    use HasWidgetShield;
    public $tahun,
        $triwulan,
        $kabkota,
        $sektor,
        $kbli,
        $uraian_skala_usaha,
        $kecamatan_usaha,
        $tanggal_terbit_oss,
        $tanggal;
    public $start, $end;
    protected static ?string $heading = 'Top 5 Table Nilai Investasi';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $loadingIndicator = 'Loading...';
    protected $listeners = ['filterUpdated' => 'updateFilter'];

    public function mount()
    {
        $this->tahun = now()->year;
        $this->start = Carbon::now()->startOfYear()->format('d M Y');
        $this->end = Carbon::now()->format('d M Y');
        $this->tanggal_terbit_oss = $this->start . ' - ' . $this->end;
    }

    public function updateFilter($tanggal_terbit_oss, $tahun, $triwulan, $kabkota, $sektor, $uraian_skala_usaha, $kecamatan_usaha)
    {

        $this->tanggal_terbit_oss = $tanggal_terbit_oss['tanggal'];
        $this->tahun = $tahun['tahun'];
        $this->triwulan = $triwulan['triwulan'];
        $this->kabkota = $kabkota['kabkota'];
        // $this->sektor = $sektor['sektor'] ? $sektor['sektor'] : null;
        // $this->uraian_skala_usaha = $uraian_skala_usaha['uraian_skala_usaha'] ? $sektor['uraian_skala_usaha'] : null;
        // $this->kecamatan_usaha = $kecamatan_usaha['kecamatan_usaha'] ? $sektor['kecamatan_usaha'] : null;
    }
    public function table(Table $table): Table
    {
        if (auth()->user()->hasRole('kabkota')) {
            $query = Proyek::filterMikro(
                $this->tanggal_terbit_oss,
                $this->tahun,
                $this->triwulan,
                auth()->user()->kabkota->id,
                $this->sektor,
                $this->uraian_skala_usaha,
                $this->kecamatan_usaha
            )
                ->select(
                    DB::raw('*'),
                    DB::raw('MIN(id_proyek) as id_proyek'),
                    DB::raw('count(CASE WHEN dikecualikan = "1" OR is_mapping = "0" THEN nib_count ELSE 0 END) as `proyek`'),
                    DB::raw('count(dikecualikan or null) as `jumlah_proyek_anomaly`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "0" AND is_mapping = "1" THEN jumlah_investasi ELSE 0 END) as `total`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "1" THEN total_investasi ELSE 0 END) as `total_anomaly`'),
                    DB::raw('count(DISTINCT CASE WHEN dikecualikan = "0" AND is_mapping = "1" THEN nib ELSE NULL END) as nib_count'), // Menggunakan DISTINCT
                    DB::raw('count(CASE WHEN dikecualikan = "1" AND is_mapping = "0" THEN nib ELSE 0 END) as nib_count_anomaly'),
                    DB::raw('sum(CASE WHEN dikecualikan = "0" AND is_mapping = "1" THEN tki ELSE 0 END) as `count_tki`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "0" AND is_mapping = "1" THEN tka ELSE 0 END) as `count_tka`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "1" AND is_mapping = "0" THEN tki ELSE 0 END) as `count_tki_anomaly`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "1" AND is_mapping = "0" THEN tka ELSE 0 END) as `count_tka_anomaly`')
                )->limit(5)
                ->with('kabkota')
                ->groupBy('kecamatan_usaha');
        } else {
            $query = Proyek::filterMikro(
                $this->tanggal_terbit_oss,
                $this->tahun,
                $this->triwulan,
                $this->kabkota,
                $this->sektor,
                $this->uraian_skala_usaha,
                $this->kecamatan_usaha
            )
                ->select(
                    DB::raw('*'),
                    DB::raw('MIN(id_proyek) as id_proyek'),
                    DB::raw('count(CASE WHEN dikecualikan = "1" OR is_mapping = "0" THEN nib_count ELSE 0 END) as `proyek`'),
                    DB::raw('count(dikecualikan or null) as `jumlah_proyek_anomaly`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "0" AND is_mapping = "1" THEN jumlah_investasi ELSE 0 END) as `total`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "1" THEN total_investasi ELSE 0 END) as `total_anomaly`'),
                    DB::raw('count(DISTINCT CASE WHEN dikecualikan = "0" AND is_mapping = "1" THEN nib ELSE NULL END) as nib_count'), // Menggunakan DISTINCT
                    DB::raw('count(CASE WHEN dikecualikan = "1" AND is_mapping = "0" THEN nib ELSE 0 END) as nib_count_anomaly'),
                    DB::raw('sum(CASE WHEN dikecualikan = "0" AND is_mapping = "1" THEN tki ELSE 0 END) as `count_tki`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "0" AND is_mapping = "1" THEN tka ELSE 0 END) as `count_tka`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "1" AND is_mapping = "0" THEN tki ELSE 0 END) as `count_tki_anomaly`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "1" AND is_mapping = "0" THEN tka ELSE 0 END) as `count_tka_anomaly`')
                )->limit(5)
                ->with('kabkota')
                ->groupBy('kab_kota_id');
        }
        return $table
            ->striped()
            // ->deferLoading()
            ->heading('Top 5 Nilai Investasi')
            ->query($query)
            ->paginated(false)
            ->defaultSort('total', 'desc')
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make('table')
                        ->fromTable()
                        ->only([
                            'kabkota.nama',
                            'kecamatan_usaha',
                            'proyek',
                            'nib_count',
                            'count_tki',
                            'total',
                        ])
                        ->withFilename(date('d-M-Y') . ' - Top 5 Rekap Data Simike')
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX),
                ])
                    ->button()
                    ->color('success')
            ])
            ->columns([
                TextColumn::make('No.')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),

                Tables\Columns\TextColumn::make('kabkota.nama')
                    ->label('Kabupaten/Kota')
                    ->wrap()
                    ->visible(function () {
                        if (auth()->user()->hasRole('kabkota')) {
                            return false;
                        }
                        return true;
                    }),

                Tables\Columns\TextColumn::make('kecamatan_usaha')
                    ->wrap()
                    ->label('Kecamatan')
                    ->visible(function () {
                        if (auth()->user()->hasRole('kabkota')) {
                            return true;
                        }
                        return false;
                    }),

                Tables\Columns\TextColumn::make('proyek')
                    ->label('Jumlah Proyek')
                    ->formatStateUsing(function ($state) {
                        return number_format($state);
                    }),
                Tables\Columns\TextColumn::make('nib_count')
                    ->label('Jumlah NIB')
                    ->formatStateUsing(function ($state) {
                        return number_format($state);
                    }),

                Tables\Columns\TextColumn::make('count_tki')
                    ->label('Jumlah Naker')
                    ->formatStateUsing(function ($state, Model $record) {
                        return number_format($state + $record->count_tka);
                    }),

                Tables\Columns\TextColumn::make('total')
                    ->label('Jumlah Nilai Investasi')
                    ->formatStateUsing(function ($state) {
                        return 'Rp. ' . number_format($state);
                    }),
            ]);
    }
}
