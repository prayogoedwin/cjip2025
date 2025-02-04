<?php

namespace App\Filament\Widgets\Simike;

use App\Models\SiMike\Proyek;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class KabupatenTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static bool $isLazy = false;

    //FILTERS
    public $filter;
    public $tahun,
        $triwulan,
        $kabkota,
        $sektor,
        $kbli,
        $uraian_skala_usaha,
        $kecamatan_usaha,
        $tanggal_terbit_oss,
        $tanggal;

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
    protected $listeners = ['filterUpdated' => 'updateFilter'];

    public function updateFilter($tanggal_terbit_oss, $tahun, $triwulan, $kabkota, $sektor, $uraian_skala_usaha, $kecamatan_usaha)
    {
        //dd([$tahun, $triwulan, $kabkota, $sektor, $uraian_skala_usaha]);
        $this->tanggal_terbit_oss = $tanggal_terbit_oss['tanggal'];
        $this->tahun = $tahun['tahun'];
        $this->triwulan = $triwulan['triwulan'];
        $this->kabkota = $kabkota['kabkota'];
        $this->sektor = $sektor['sektor'];
        $this->uraian_skala_usaha = $uraian_skala_usaha['uraian_skala_usaha'];
        $this->kecamatan_usaha = $kecamatan_usaha['kecamatan_usaha'];
        // dd(range(Carbon::now()->year, Carbon::now()->subYear(5)->year));
    }

    public function mount()
    {
        // dd(auth()->user()->kabkota_id);
        //DEAFULT FILTERS
        $this->tahun = now()->year;
        // $this->uraian_skala_usaha = 'Usaha Mikro';
    }

    public static function canView(): bool
    {
        /*return auth()->user()->hasRole('kabkota');*/
        if (URL::current() == \url('/admin')) {
            return false;
        }
        return true;
    }

    protected function getTableQuery(): Builder
    {
        if (auth()->user()->hasRole('kabkota')) {
            return Proyek::filterMikro($this->tanggal_terbit_oss, $this->tahun, $this->triwulan, auth()->user()->kabkota->id, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                ->select(
                    DB::raw('*'),
                    DB::raw('MIN(id_proyek) as id_proyek'),
                    DB::raw('count(CASE WHEN dikecualikan = "1" OR is_mapping = "0" THEN nib_count ELSE 0 END) as `proyek`'),
                    DB::raw('count(dikecualikan or null) as `jumlah_proyek_anomaly`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "0" THEN jumlah_investasi ELSE 0 END) as `total`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "1" THEN total_investasi ELSE 0 END) as `total_anomaly`'),
                    DB::raw('count(nib) as nib_count'),
                    DB::raw('sum(CASE WHEN dikecualikan = "0" THEN tki ELSE 0 END) as `count_tki`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "0" THEN tka ELSE 0 END) as `count_tka`'),
                )
                // ->orderByDesc('total')
                ->groupBy('kecamatan_usaha');
        } else {
            return Proyek::filterMikro($this->tanggal_terbit_oss, $this->tahun, $this->triwulan, $this->kabkota, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                ->select(
                    DB::raw('*'),
                    DB::raw('MIN(id_proyek) as id_proyek'),
                    DB::raw('count(CASE WHEN dikecualikan = "1" OR is_mapping = "0" THEN nib_count ELSE 0 END) as `proyek`'),
                    DB::raw('count(dikecualikan or null) as `jumlah_proyek_anomaly`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "0" AND is_mapping = "1" THEN jumlah_investasi ELSE 0 END) as `total`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "1" THEN total_investasi ELSE 0 END) as `total_anomaly`'),
                    DB::raw('count(CASE WHEN dikecualikan = "0" AND is_mapping = "1" THEN nib ELSE 0 END) as nib_count'),
                    DB::raw('count(CASE WHEN dikecualikan = "1" AND is_mapping = "0" THEN nib ELSE 0 END) as nib_count_anomaly'),
                    DB::raw('sum(CASE WHEN dikecualikan = "0" AND is_mapping = "1" THEN tki ELSE 0 END) as `count_tki`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "0" AND is_mapping = "1" THEN tka ELSE 0 END) as `count_tka`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "1" AND is_mapping = "0" THEN tki ELSE 0 END) as `count_tki_anomaly`'),
                    DB::raw('sum(CASE WHEN dikecualikan = "1" AND is_mapping = "0" THEN tka ELSE 0 END) as `count_tka_anomaly`'),
                )
                // ->orderByDesc('total')
                ->groupBy('kab_kota_id');
        }
    }
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('kabkota.nama')
                ->searchable()
                ->wrap()
                ->visible(function () {
                    if (auth()->user()->hasRole('kabkota')) {
                        return false;
                    }
                    return true;
                }),

            // Tables\Columns\TextColumn::make('kecamatan_usaha')
            //     ->searchable()
            //     ->wrap()
            //     ->visible(function () {
            //         if (auth()->user()->hasRole('kabkota')) {
            //             return true;
            //         }
            //         return false;
            //     }),

            Tables\Columns\TextColumn::make('proyek')
                ->label('Jumlah Proyek')
                ->formatStateUsing(function ($state) {
                    return number_format($state);
                })->sortable(),

            Tables\Columns\TextColumn::make('kabkota.id')
                ->label('Jumlah NIB')
                ->formatStateUsing(function ($state) {
                    // dd($state);
                    $count = Proyek::filterMikro($this->tanggal_terbit_oss, $this->tahun, $this->triwulan, $this->kabkota, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                        ->where('dikecualikan', 0)
                        ->where('is_mapping', 1)
                        ->where('kab_kota_id', $state)
                        ->groupBy('nib')
                        ->get()
                        ->count();

                    // Format the count as number
                    return number_format($count, 0, ',', ',');
                })
                ->sortable(),

            Tables\Columns\TextColumn::make('count_tki')
                ->label('Jumlah Naker')
                ->formatStateUsing(function ($state, Model $record) {
                    return number_format($state + $record->count_tka);
                })->sortable(),

            Tables\Columns\TextColumn::make('total')
                ->label('Rencana Nilai Investasi')
                ->description('Sesuai Dengan Parameter BKPM')
                ->formatStateUsing(function ($state) {
                    return 'Rp. ' . number_format($state);
                })
                ->sortable(),
            // Tables\Columns\TextColumn::make('jumlah_proyek_anomaly')
            //     ->label('Jumlah Proyek Anomaly')
            //     ->formatStateUsing(function ($state) {
            //         return number_format($state);
            //     }),

            // Tables\Columns\TextColumn::make('total_anomaly')
            //     ->label('Rencana Nilai Investasi Anomaly')
            //     ->description('Sudah Dikurangi Tanah dan Bangunan')
            //     ->formatStateUsing(function ($state) {
            //         return 'Rp. ' . number_format($state);
            //     })
            //     ->sortable(),
        ];
    }

    protected function getTableHeaderActions(): array
    {
        return [
            ExportAction::make()->exports([
                ExcelExport::make('table')
                    ->fromTable()
                    ->withFilename(date('d-M-Y') . ' - Data Simike')
                    ->withWriterType(\Maatwebsite\Excel\Excel::XLSX),
            ])
                ->button()
                ->color('success')
        ];
    }
}
