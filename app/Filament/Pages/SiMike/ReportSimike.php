<?php

namespace App\Filament\Pages\SiMike;

use App\Models\SiMike\Report;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Carbon\Carbon;
use Dompdf\FrameDecorator\Text;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Illuminate\Support\Facades\DB;

class ReportSimike extends Page implements HasForms, HasTable
{
    use HasPageShield;
    use InteractsWithTable;
    use InteractsWithForms;
    protected static ?string $navigationLabel = "Report Import";
    protected static ?string $pluralModelLabel = 'Report Import';
    protected static ?string $title = "Report Import";
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = "Si-Mike";
    protected static string $view = 'filament.pages.si-mike.report-simike';

    public function table(Table $table): Table
    {
        return $table
            ->paginated([35, 'all'])
            ->defaultPaginationPageOption(35)
            // ->paginated(false)
            ->query(
                Report::query()
                    ->join('users', 'reports.user_id', '=', 'users.id')
                    ->leftJoin('kabkotas', 'kabkotas.id', '=', 'users.kabkota_id')
                    ->select('users.id', 'kabkotas.nama as kabkota_nama')
                    ->addSelect(DB::raw('
                    MAX(CASE WHEN reports.bulan = 1 THEN "Sudah" ELSE "-" END) as bulan_januari,
                    MAX(CASE WHEN reports.bulan = 2 THEN "Sudah" ELSE "-" END) as bulan_februari,
                    MAX(CASE WHEN reports.bulan = 3 THEN "Sudah" ELSE "-" END) as bulan_maret,
                    MAX(CASE WHEN reports.bulan = 4 THEN "Sudah" ELSE "-" END) as bulan_april,
                    MAX(CASE WHEN reports.bulan = 5 THEN "Sudah" ELSE "-" END) as bulan_mei,
                    MAX(CASE WHEN reports.bulan = 6 THEN "Sudah" ELSE "-" END) as bulan_juni,
                    MAX(CASE WHEN reports.bulan = 7 THEN "Sudah" ELSE "-" END) as bulan_juli,
                    MAX(CASE WHEN reports.bulan = 8 THEN "Sudah" ELSE "-" END) as bulan_agustus,
                    MAX(CASE WHEN reports.bulan = 9 THEN "Sudah" ELSE "-" END) as bulan_september,
                    MAX(CASE WHEN reports.bulan = 10 THEN "Sudah" ELSE "-" END) as bulan_oktober,
                    MAX(CASE WHEN reports.bulan = 11 THEN "Sudah" ELSE "-" END) as bulan_november,
                    MAX(CASE WHEN reports.bulan = 12 THEN "Sudah" ELSE "-" END) as bulan_desember
                '))
                    ->groupBy('users.id', 'kabkotas.nama')
            )
            ->striped()
            ->columns([
                TextColumn::make('kabkota_nama')
                    ->label('Nama Kabkota'),

                $this->getMonthColumn('bulan_januari', 'Januari'),
                $this->getMonthColumn('bulan_februari', 'Februari'),
                $this->getMonthColumn('bulan_maret', 'Maret'),
                $this->getMonthColumn('bulan_april', 'April'),
                $this->getMonthColumn('bulan_mei', 'Mei'),
                $this->getMonthColumn('bulan_juni', 'Juni'),
                $this->getMonthColumn('bulan_juli', 'Juli'),
                $this->getMonthColumn('bulan_agustus', 'Agustus'),
                $this->getMonthColumn('bulan_september', 'September'),
                $this->getMonthColumn('bulan_oktober', 'Oktober'),
                $this->getMonthColumn('bulan_november', 'November'),
                $this->getMonthColumn('bulan_desember', 'Desember'),
            ])
            ->filters([
                SelectFilter::make('tahun')
                    ->default(Carbon::now()->year)
                    ->searchable()
                    ->options(function () {
                        $currentYear = Carbon::now()->year;
                        $years = range($currentYear, $currentYear - 5);
                        return array_combine($years, $years);
                    })
            ])
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make('table')
                        ->fromTable()
                        ->withFilename(date('d-M-Y') . ' - Report Import Simike')
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX),
                ])
                    ->button()
                    ->color('success')
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    private function getMonthColumn($columnName, $monthName)
    {
        return TextColumn::make($columnName)
            ->label($monthName)
            ->getStateUsing(function ($record) use ($columnName) {
                return $record->$columnName;
            })
            ->color(function ($state) {
                return $state === 'Sudah' ? 'success' : 'danger';
            });
    }
}
