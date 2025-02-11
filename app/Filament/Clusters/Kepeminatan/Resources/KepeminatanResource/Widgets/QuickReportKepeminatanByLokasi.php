<?php

namespace App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource\Widgets;

use App\Models\Kepeminatan\Kepeminatan;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class QuickReportKepeminatanByLokasi extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    public static function canView(): bool
    {
        if (URL::current() == \url('/admin')) {
            return false;
        }
        return true;
    }
    public function getTableRecordKey(Model $record): string
    {
        return $record->synthetic_key ?? uniqid();
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Kepeminatan::query()
                    ->select('prefensi_lokasi')
                    ->selectRaw('SUM(nilai_investasi) as total_investasi_usd, SUM(nilai_investasi_rupiah) as total_investasi_rupiah')
                    ->groupBy('prefensi_lokasi')
            )->headerActions(
                [
                    ExportAction::make()->exports([
                        ExcelExport::make('table')
                            ->fromTable()
                            ->withFilename(date('Y-m-d') . 'Kepeminatan by Sektor - export')
                            ->withWriterType(\Maatwebsite\Excel\Excel::XLSX),
                    ])
                ]
            )
            ->columns([
                TextColumn::make('prefensi_lokasi')
                    ->label('Preferensi Lokasi')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('total_investasi_usd')
                    ->label('Total Investasi (USD)')
                    ->sortable()
                    ->formatStateUsing(fn($state) => number_format($state, 2)),

                TextColumn::make('total_investasi_rupiah')
                    ->label('Total Investasi (Rupiah)')
                    ->sortable()
                    ->formatStateUsing(fn($state) => number_format($state, 2)),
            ]);
    }
}
