<?php

namespace App\Filament\Resources\SiRusa;

use App\Filament\Resources\SiRusa\NibResource\Pages;
use App\Filament\Resources\SiRusa\NibResource\RelationManagers;
use App\Models\SiRusa\Nib;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NibResource extends Resource
{
    protected static ?string $model = Nib::class;

    protected static ?string $navigationGroup = 'Si-Rusa';

    protected static ?int $navigationSort = -1;

    protected static ?string $navigationLabel = 'Perusahaan';

    protected static ?string $recordTitleAttribute = 'nama_perusahaan';

    protected static ?string $label = 'Daftar Perusahaan';

    protected static ?string $pluralLabel = 'Daftar Perusahaan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nib'),
                Forms\Components\TextInput::make('nama_perusahaan'),
                Forms\Components\TextInput::make('day_of_tanggal_terbit_oss'),
                Forms\Components\TextInput::make('status_penanaman_modal'),
                Forms\Components\TextInput::make('uraian_jenis_perusahaan'),
                Forms\Components\TextInput::make('flag_umk'),
                Forms\Components\TextInput::make('kab_kota'),
                Forms\Components\TextInput::make('alamat_perusahaan'),
                Forms\Components\TextInput::make('email'),
                Forms\Components\TextInput::make('nomor_telp'),
                Forms\Components\Checkbox::make('is_jateng'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nib')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->wrap(),
                Tables\Columns\TextColumn::make('nama_perusahaan')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->wrap(),
                Tables\Columns\TextColumn::make('day_of_tanggal_terbit_oss')
                    ->label('Tanggal Terbit OSS')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->date(),
                Tables\Columns\TextColumn::make('status_penanaman_modal')
                    ->label('Status PM')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->sortable(),
                Tables\Columns\TextColumn::make('proyeks_count')->counts('proyeks')
                    ->label('Jumlah Proyek')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('proyeks_sum_tki')->sum('proyeks', 'tki')
                    ->label('Jumlah TKI')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('uraian_jenis_perusahaan')
                    ->label('Uraian Jenis Perusahaan')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('nomor_telp')
                    ->label('No. Telp')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('alamat_perusahaan')
                    ->label('Alamat Perusahaan')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('kab_kota')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable()
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        Grid::make()->schema([
                            Forms\Components\DatePicker::make('terbit_from')->label('Tanggal Awal')->placeholder('Awal'),
                            Forms\Components\DatePicker::make('terbit_until')->label('Tanggal Akhir')->placeholder('Akhir'),
                        ])->columns(2),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['terbit_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('day_of_tanggal_terbit_oss', '>=', $date),
                            )
                            ->when(
                                $data['terbit_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('day_of_tanggal_terbit_oss', '<=', $date),
                            );
                    }),
                Tables\Filters\SelectFilter::make('status_penanaman_modal')
                    ->label('Status Penanaman Modal')
                    ->searchable()
                    ->options([
                        'PMA' => 'PMA',
                        'PMDN' => 'PMDN',
                    ]),
                SelectFilter::make('uraian_jenis_perusahaan')
                    ->label('Uraian Jenis Perusahaan')
                    ->multiple()
                    ->options(function () {
                        $uraian_jenis_perusahaan = Nib::all()->pluck('uraian_jenis_perusahaan')->toArray();
                        $uraian_jenis_perusahaan = array_combine($uraian_jenis_perusahaan, $uraian_jenis_perusahaan);
                        return $uraian_jenis_perusahaan;
                    }),
                Tables\Filters\SelectFilter::make('kab_kota')->label('Kabupaten/Kota')
                    ->options(function () {
                        $nib = Nib::all()->pluck('kab_kota')->toArray();
                        $nib = array_combine($nib, $nib);
                        return $nib;
                    })
                    ->searchable()
                    ->multiple()
                    ->visible(function () {
                        if (auth()->user()->hasRole('kabkota')) {
                            return false;
                        }
                        return true;
                    }),
            ], layout: \Filament\Tables\Enums\FiltersLayout::AboveContent, )
            ->filtersFormColumns(4)
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make('table')
                        ->fromTable()
                        ->withFilename(date('d-M-Y') . ' - Data Perusahaan')
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX),
                ])
                    ->button()
                    ->color('success')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNibs::route('/'),
            'create' => Pages\CreateNib::route('/create'),
            'edit' => Pages\EditNib::route('/{record}/edit'),
        ];
    }
}
