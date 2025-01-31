<?php

namespace App\Filament\Pages\SiRusa;

use App\Models\SiMike\Proyek;
use App\Models\SiRusa\Nib;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class DataPerusahaan extends Page implements HasForms, HasTable
{
    use HasPageShield;
    use InteractsWithTable;
    use InteractsWithForms;
    protected static ?string $navigationGroup = 'Si-Rusa';

    protected static ?int $navigationSort = -1;


    public function table(Table $table): Table
    {
        return $table
            ->query(Nib::query()
                ->withCount('proyeks')
                ->with(['proyeks' => function ($query) {
                    $query->select('nib_id', DB::raw('SUM(rilis.tambahan_investasi_dalam_rp_juta) as total_investasi'))
                        ->leftJoin('rilis', 'proyeks.id', '=', 'rilis.proyek_id')
                        ->groupBy('proyeks.nib_id');
                }])
                ->select('nibs.*', DB::raw(
                    '(SELECT r.status FROM rilis
                r WHERE r.proyek_id IN
                (SELECT p.id FROM proyeks
                p WHERE p.nib_id = nibs.id) LIMIT 1) as status_rilis'
                )))
            ->columns([
                TextColumn::make('nama_perusahaan')
                    ->searchable()
                    ->label('Nama Perusahaan'),
                TextColumn::make('nib')
                    ->searchable()
                    ->label('NIB'),
                TextColumn::make('proyeks.nama_23_sektor')
                    ->label('Sektor')
                    ->wrap()
                    ->getStateUsing(function (Nib $record) {
                        return $record->proyeks()->pluck('nama_23_sektor')->implode(', ');
                    }),
                TextColumn::make('status_penanaman_modal')->label('Status Penanaman Modal'),
                TextColumn::make('uraian_jenis_perusahaan')->label('Uraian Jenis Perusahaan'),
                TextColumn::make('proyeks_count')->label('Jml Proyek')->counts('proyeks'),
                TextColumn::make('total_investasi')
                    ->label('Total Investasi')
                    ->getStateUsing(function (Nib $record) {
                        return $record->proyeks()
                            ->leftJoin('rilis', 'proyeks.id', '=', 'rilis.proyek_id')
                            ->sum('rilis.tambahan_investasi_dalam_rp_juta');
                    })
                    ->money('IDR', true),
            ])
            ->filters([
                Filter::make('day_of_tanggal_terbit_oss')
                    ->label('Tanggal Terbit OSS')
                    ->form([
                        DatePicker::make('from')
                            ->label('From Date'),
                        DatePicker::make('until')
                            ->label('Until Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        if ($data['from']) {
                            $query->whereDate('day_of_tanggal_terbit_oss', '>=', $data['from']);
                        }
                        if ($data['until']) {
                            $query->whereDate('day_of_tanggal_terbit_oss', '<=', $data['until']);
                        }
                        return $query;
                    }),

                // Filter::make('total_investasi')
                //     ->label('With Total Investasi')
                //     ->query(function (Builder $query): Builder {
                //         return $query->whereHas('proyeks.rilis', function (Builder $query) {
                //             $query->having(DB::raw('SUM(rilis.tambahan_investasi_dalam_rp_juta)'), '>', 0);
                //         });
                //     }),

                // SelectFilter::make('nama_23_sektor')
                //     ->label('Nama 23 Sektor')
                //     ->options(function () {
                //         // Cache or pre-load options if the same data is used across multiple filters
                //         return Proyek::query()
                //             ->select('nama_23_sektor')
                //             ->whereNotNull('nama_23_sektor')
                //             ->distinct()
                //             ->pluck('nama_23_sektor', 'nama_23_sektor');
                //     })
                //     ->query(function (Builder $query, array $data): Builder {
                //         return $query->whereHas('proyeks', function (Builder $query) use ($data) {
                //             $query->where('nama_23_sektor', $data['value']);
                //         });
                //     }),

                SelectFilter::make('status_penanaman_modal')
                    ->label('Status Penanaman Modal')
                    ->options([
                        'PMA' => 'PMA',
                        'PMDN' => 'PMDN',
                    ]),

                SelectFilter::make('uraian_jenis_perusahaan')
                    ->label('Jenis Usaha')
                    ->options(function () {
                        return NIB::query()
                            ->select('uraian_jenis_perusahaan')
                            ->whereNotNull('uraian_jenis_perusahaan')
                            ->distinct()
                            ->pluck('uraian_jenis_perusahaan', 'uraian_jenis_perusahaan');
                    })

            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    protected static string $view = 'filament.pages.si-rusa.data-perusahaan';
}
