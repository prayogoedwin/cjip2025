<?php

namespace App\Filament\Resources\SiRusa;

use App\Filament\Resources\SiRusa\RilisResource\Pages;
use App\Filament\Resources\SiRusa\RilisResource\RelationManagers;
use App\Models\SiRusa\Rilis;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RilisResource extends Resource
{
    protected static ?string $model = Rilis::class;
    protected static ?string $navigationGroup = 'Si-Rusa';

    protected static ?int $navigationSort = -1;

    protected static ?string $navigationLabel = 'Rilis Investasi';

    protected static ?string $recordTitleAttribute = 'nama_perusahaan';

    protected static ?string $label = 'Rilis Investasi';

    protected static ?string $pluralLabel = 'Rilis Investasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Rilis Investasi')->schema([
                    TextInput::make('id_laporan'),
                    TextInput::make('no_izin'),
                    DatePicker::make('tanggal_laporan'),
                    DatePicker::make('tanggal_approve_laporan'),
                ])->columns(4),
                Card::make()->schema([
                    Grid::make()->schema([
                        TextInput::make('nama_perusahaan'),
                        TextInput::make('email'),
                        Textarea::make('alamat'),
                    ])->columns(1),
                    TextInput::make('wilayah'),
                    TextInput::make('provinsi'),
                    TextInput::make('kabkot'),
                    TextInput::make('negara'),
                    TextInput::make('cetak_lokasi'),
                ])->columns(5),
                Card::make()->schema([
                    TextInput::make('periode_tahap'),
                    TextInput::make('sektor_utama'),
                    TextInput::make('status_pm'),
                    TextInput::make('deskripsi_kbli'),
                    // TextInput::make('status'),
                    TextInput::make('jenis_badan_usaha'),
                    Grid::make()->schema([
                        TextInput::make('23_sektor'),
                        TextInput::make('sektor')
                    ])->columns(2)
                ])->columns(5),
                Card::make()->schema([
                    TextInput::make('tambahan_investasi_dalam_rp_juta'),
                    TextInput::make('tambahan_investasi_dalam_us_ribu'),
                    TextInput::make('proyek'),
                    TextInput::make('tki'),
                    TextInput::make('tka'),
                    // TextInput::make('triwulan'),
                    // TextInput::make('tahun'),
                    // TextInput::make('tanggal_awal'),
                    // TextInput::make('tanggal_akhir'),
                ])->columns(5),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_laporan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_pm')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_izin')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi_kbli')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('triwulan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kabkot')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tambahan_investasi_dalam_rp_juta')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tambahan_investasi_dalam_us_ribu')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tki')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tka')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('tahun')
                    ->default(Carbon::now()->year)
                    ->searchable()
                    ->options(function () {
                        $currentYear = Carbon::now()->year;
                        $years = range($currentYear, $currentYear - 5);
                        return array_combine($years, $years);
                    }),
                Tables\Filters\SelectFilter::make('triwulan')
                    ->options([
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                    ])->default(function () {
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
                    }),
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
            'index' => Pages\ListRilis::route('/'),
            'create' => Pages\CreateRilis::route('/create'),
            'edit' => Pages\EditRilis::route('/{record}/edit'),
        ];
    }
}
