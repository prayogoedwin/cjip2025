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
use Illuminate\Support\Facades\DB;

class ReportSimike extends Page implements HasForms, HasTable
{
    use HasPageShield;
    use InteractsWithTable;
    use InteractsWithForms;
    protected static ?string $navigationLabel = "Report Simike";
    protected static ?string $pluralModelLabel = 'Report Simike";';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = "Graph";
    protected static string $view = 'filament.pages.si-mike.report-simike';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Report::query()
                    ->join('users', 'reports.user_id', '=', 'users.id')
                    ->distinct()
                    ->groupBy('users.id')
            )
            ->columns([
                TextColumn::make('user.kabkota.nama')->label('Nama User')->searchable(),

                // Kolom untuk bulan Januari
                TextColumn::make('bulan_januari')
                    ->label('Januari')
                    ->getStateUsing(function ($record) {
                        return $record->bulan == 1 ? 'Sudah' : '-';
                    })
                    ->color(function ($state) {
                        return $state === 'Sudah' ? 'success' : 'danger';
                    }),

                // Kolom untuk bulan Februari
                TextColumn::make('bulan_februari')
                    ->label('Februari')
                    ->getStateUsing(function ($record) {
                        return $record->bulan == 2 ? 'Sudah' : '-';
                    })
                    ->color(function ($state) {
                        return $state === 'Sudah' ? 'success' : 'danger';
                    }),

                // Kolom untuk bulan Maret
                TextColumn::make('bulan_maret')
                    ->label('Maret')
                    ->getStateUsing(function ($record) {
                        return $record->bulan == 3 ? 'Sudah' : '-';
                    })
                    ->color(function ($state) {
                        return $state === 'Sudah' ? 'success' : 'danger';
                    }),

                // Kolom untuk bulan April
                TextColumn::make('bulan_april')
                    ->label('April')
                    ->getStateUsing(function ($record) {
                        return $record->bulan == 4 ? 'Sudah' : '-';
                    })
                    ->color(function ($state) {
                        return $state === 'Sudah' ? 'success' : 'danger';
                    }),

                // Kolom untuk bulan Mei
                TextColumn::make('bulan_mei')
                    ->label('Mei')
                    ->getStateUsing(function ($record) {
                        return $record->bulan == 5 ? 'Sudah' : '-';
                    })
                    ->color(function ($state) {
                        return $state === 'Sudah' ? 'success' : 'danger';
                    }),

                // Kolom untuk bulan Juni
                TextColumn::make('bulan_juni')
                    ->label('Juni')
                    ->getStateUsing(function ($record) {
                        return $record->bulan == 6 ? 'Sudah' : '-';
                    })
                    ->color(function ($state) {
                        return $state === 'Sudah' ? 'success' : 'danger';
                    }),

                // Kolom untuk bulan Juli
                TextColumn::make('bulan_juli')
                    ->label('Juli')
                    ->getStateUsing(function ($record) {
                        return $record->bulan == 7 ? 'Sudah' : '-';
                    })
                    ->color(function ($state) {
                        return $state === 'Sudah' ? 'success' : 'danger';
                    }),

                // Kolom untuk bulan Agustus
                TextColumn::make('bulan_agustus')
                    ->label('Agustus')
                    ->getStateUsing(function ($record) {
                        return $record->bulan == 8 ? 'Sudah' : '-';
                    })
                    ->color(function ($state) {
                        return $state === 'Sudah' ? 'success' : 'danger';
                    }),

                // Kolom untuk bulan September
                TextColumn::make('bulan_september')
                    ->label('September')
                    ->getStateUsing(function ($record) {
                        return $record->bulan == 9 ? 'Sudah' : '-';
                    })
                    ->color(function ($state) {
                        return $state === 'Sudah' ? 'success' : 'danger';
                    }),

                // Kolom untuk bulan Oktober
                TextColumn::make('bulan_oktober')
                    ->label('Oktober')
                    ->getStateUsing(function ($record) {
                        return $record->bulan == 10 ? 'Sudah' : '-';
                    })
                    ->color(function ($state) {
                        return $state === 'Sudah' ? 'success' : 'danger';
                    }),

                // Kolom untuk bulan November
                TextColumn::make('bulan_november')
                    ->label('November')
                    ->getStateUsing(function ($record) {
                        return $record->bulan == 11 ? 'Sudah' : '-';
                    })
                    ->color(function ($state) {
                        return $state === 'Sudah' ? 'success' : 'danger';
                    }),

                // Kolom untuk bulan Desember
                TextColumn::make('bulan_desember')
                    ->label('Desember')
                    ->getStateUsing(function ($record) {
                        return $record->bulan == 12 ? 'Sudah' : '-';
                    })
                    ->color(function ($state) {
                        return $state === 'Sudah' ? 'success' : 'danger';
                    }),
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
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }
}
