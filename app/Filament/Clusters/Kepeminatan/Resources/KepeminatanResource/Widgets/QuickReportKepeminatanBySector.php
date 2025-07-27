<?php

namespace App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource\Widgets;

use App\Models\Kepeminatan\Kepeminatan;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class QuickReportKepeminatanBySector extends BaseWidget
{
    /*protected int | string | array $columnSpan = 'full';*/
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
            ->heading('Quick Report Kepeminatan By Sektor')
            ->query(
                Kepeminatan::query()
                    ->select('sektor')
                    ->selectRaw('SUM(nilai_investasi) as total_investasi_usd, SUM(nilai_investasi_rupiah) as total_investasi_rupiah')
                    ->groupBy('sektor')
            )
            ->headerActions(
                [
                    ExportAction::make()->exports([
                        ExcelExport::make('table')
                            ->fromTable()
                            ->withFilename(date('Y-m-d') . 'Kepeminatan by Lokasi - export')
                            ->withWriterType(\Maatwebsite\Excel\Excel::XLSX),
                    ])
                ]
            )
            ->filters([
                Filter::make('created_at')
                    ->form([
                        Grid::make()
                            ->schema([
                                DatePicker::make('created_from')->label('Dari Tanggal')->default(today()),
                                DatePicker::make('created_until')->label('Sampai Tanggal')->default(today()),
                            ])
                        ->columns(2)
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ], layout: FiltersLayout::AboveContent)
            ->filtersFormColumns(1)
            ->columns([
                TextColumn::make('sektor')
                    ->label('Sektor')
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
