<?php

namespace App\Filament\Resources\SiRusa;

use App\Filament\Resources\SiRusa\PengawasanResource\Pages;
use App\Filament\Resources\SiRusa\PengawasanResource\RelationManagers;
use App\Models\Cjip\Sektor;
use App\Models\SiMike\Proyek;
use App\Models\SiRusa\Pengawasan;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengawasanResource extends Resource
{
    protected static ?string $model = Proyek::class;

    protected static ?string $navigationGroup = 'Si-Rusa';

    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'pengawasan';

    protected static ?string $navigationLabel = 'Pengawasan';

    protected static ?string $recordTitleAttribute = 'nama_perusahaan';

    protected static ?string $label = 'Pengawasan';

    protected static ?string $pluralLabel = 'Pengawasan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nib')
                    ->label('NIB'),

                Forms\Components\Section::make('Investasi')->schema([
                    Forms\Components\TextInput::make('mesin_peralatan')
                        ->reactive()
                        ->numeric()
                        ->afterStateUpdated(function ($state, callable $set, $get) {

                            $sum = $state + $get('mesin_peralatan_import') + $get('pembelian_pematangan_tanah') + $get('modal_kerja') + $get('lain_lain');

                            if ($sum <= 1000000000) {
                                $set('flag', 'Micro');
                            } elseif ($sum >= 1000000000 && $sum <= 5000000000) {
                                $set('flag', 'Kecil');
                            } elseif ($sum >= 5000000000 && $sum <= 10000000000) {
                                $set('flag', 'Menengah');
                            } elseif ($sum > 10000000000) {
                                $set('flag', 'Besar');
                            }

                            return $set(
                                'jumlah_investasi',
                                $sum
                            );
                        }),
                    Forms\Components\TextInput::make('mesin_peralatan_import')
                        ->reactive()
                        ->numeric()
                        ->afterStateUpdated(function ($state, callable $set, $get) {
                            $sum = $state + $get('mesin_peralatan') + $get('pembelian_pematangan_tanah') + $get('modal_kerja') + $get('lain_lain');

                            if ($sum <= 1000000000) {
                                $set('flag', 'Micro');
                            } elseif ($sum >= 1000000000 && $sum <= 5000000000) {
                                $set('flag', 'Kecil');
                            } elseif ($sum >= 5000000000 && $sum <= 10000000000) {
                                $set('flag', 'Menengah');
                            } elseif ($sum > 10000000000) {
                                $set('flag', 'Besar');
                            }

                            return $set(
                                'jumlah_investasi',
                                $sum
                            );
                        }),
                    Forms\Components\TextInput::make('pembelian_pematangan_tanah')
                        ->reactive()
                        ->numeric()
                        ->afterStateUpdated(function ($state, callable $set, $get) {
                            $sum = $state + $get('mesin_peralatan_import') + $get('mesin_peralatan') + $get('modal_kerja') + $get('lain_lain');

                            if ($sum <= 1000000000) {
                                $set('flag', 'Micro');
                            } elseif ($sum >= 1000000000 && $sum <= 5000000000) {
                                $set('flag', 'Kecil');
                            } elseif ($sum >= 5000000000 && $sum <= 10000000000) {
                                $set('flag', 'Menengah');
                            } elseif ($sum > 10000000000) {
                                $set('flag', 'Besar');
                            }

                            return $set(
                                'jumlah_investasi',
                                $sum
                            );
                        }),
                    Forms\Components\TextInput::make('modal_kerja')
                        ->reactive()
                        ->numeric()
                        ->afterStateUpdated(function ($state, callable $set, $get) {
                            $sum = $state + $get('mesin_peralatan_import') + $get('pembelian_pematangan_tanah') + $get('mesin_peralatan') + $get('lain_lain');

                            if ($sum <= 1000000000) {
                                $set('flag', 'Micro');
                            } elseif ($sum >= 1000000000 && $sum <= 5000000000) {
                                $set('flag', 'Kecil');
                            } elseif ($sum >= 5000000000 && $sum <= 10000000000) {
                                $set('flag', 'Menengah');
                            } elseif ($sum > 10000000000) {
                                $set('flag', 'Besar');
                            }

                            return $set(
                                'jumlah_investasi',
                                $sum
                            );
                        }),
                    Forms\Components\TextInput::make('lain_lain')
                        ->reactive()
                        ->numeric()
                        ->afterStateUpdated(function ($state, callable $set, $get) {
                            $sum = $state + $get('mesin_peralatan_import') + $get('pembelian_pematangan_tanah') + $get('modal_kerja') + $get('mesin_peralatan');

                            if ($sum <= 1000000000) {
                                $set('flag', 'Micro');
                            } elseif ($sum >= 1000000000 && $sum <= 5000000000) {
                                $set('flag', 'Kecil');
                            } elseif ($sum >= 5000000000 && $sum <= 10000000000) {
                                $set('flag', 'Menengah');
                            } elseif ($sum > 10000000000) {
                                $set('flag', 'Besar');
                            }

                            return $set(
                                'jumlah_investasi',
                                $sum
                            );
                        }),
                    Forms\Components\TextInput::make('jumlah_investasi')
                        ->reactive()

                ])->columns(3),
                Forms\Components\Section::make('Proyek')->schema([
                    Forms\Components\TextInput::make('id_proyek'),
                    Forms\Components\TextInput::make('kbli'),
                    Forms\Components\TextInput::make('judul_kbli'),
                ])->columns(3),

                Forms\Components\Section::make('Uraian Proyek')->schema([
                    Forms\Components\TextInput::make('flag')
                        ->reactive()
                        ->disabled(),
                    Forms\Components\TextInput::make('uraian_resiko_proyek'),
                    Forms\Components\TextInput::make('alamat_usaha'),
                    Forms\Components\TextInput::make('kelurahan_usaha'),
                    Forms\Components\TextInput::make('kecamatan_usaha'),
                    Forms\Components\TextInput::make('kabkota_usaha'),
                    Forms\Components\TextInput::make('provinsi_usaha'),
                    Forms\Components\DateTimePicker::make('tanggal_pengajuan_proyek'),
                    Forms\Components\TextInput::make('tki'),
                    Forms\Components\TextInput::make('tka'),
                    Forms\Components\Select::make('tahun')
                        ->options(function () {
                            $years = range(Carbon::now()->year, Carbon::now()->subYear(5)->year);
                            //dd($years);
                            return $years;
                        })
                        ->default(Carbon::now()->year)
                        ->required()
                        ->searchable(),
                    Forms\Components\Select::make('triwulan')->options([
                        1 => 'I',
                        2 => 'II',
                        3 => 'III',
                        4 => 'IV',
                    ])
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
                        ->required()
                        ->searchable(),
                ])->columns(4),
                Forms\Components\Hidden::make('user_id')->default(auth()->id()),
                Forms\Components\Hidden::make('last_edited_by_id')->default(auth()->id())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Split::make([
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('id_proyek')->searchable()->wrap(),
                        Tables\Columns\TextColumn::make('nama_perusahaan')
                            ->searchable()
                            ->wrap()
                            ->weight('bold')
                            ->grow(),
                        Tables\Columns\TextColumn::make('nibCheck.email')
                            ->label('Email')
                            ->searchable()
                            ->wrap(),
                        Tables\Columns\TextColumn::make('nibCheck.nomor_telp')
                            ->label('No. Telp')
                            ->formatStateUsing(function ($state, Model $record) {
                                if ($state) {
                                    return $state;
                                } else {
                                    return $record->nomor_telp;
                                }
                            })
                            ->searchable()
                            ->wrap()
                            ->weight('bold'),
                    ]),
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('kabkota.nama')
                            ->label('Kabupaten/Kota')
                            ->searchable()->wrap(),
                        Tables\Columns\TextColumn::make('uraian_status_penanaman_modal')
                            ->label('Status PM')
                            ->searchable()->wrap(),
                        Tables\Columns\TextColumn::make('uraian_skala_usaha')
                            ->label('Skala Usaha')
                            ->searchable()->wrap(),
                        Tables\Columns\TextColumn::make('uraian_risiko_proyek')
                            ->label('Resiko Proyek')
                            ->searchable()->wrap(),
                    ]),
                    Tables\Columns\TextColumn::make('total_investasi')
                        ->label('Rencana Investasi')
                        ->money('idr', true)
                        ->sortable(),
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('rilis')
                            ->view('filament.resources.pengawasan.table.rilis')
                            ->searchable()
                            ->wrap()
                            ->sortable(),
                    ]),
                ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('uraian_status_penanaman_modal')
                    ->label('Status PM')
                    ->searchable()
                    ->multiple()
                    ->options([
                        'PMA' => 'PMA',
                        'PMDN' => 'PMDN',
                    ]),
                Tables\Filters\SelectFilter::make('uraian_skala_usaha')
                    ->label('Skala Usaha')
                    ->searchable()
                    ->multiple()
                    ->options([
                        'Usaha Besar' => 'Usaha Besar',
                        'Usaha Menengah' => 'Usaha Menengah',
                        'Usaha Kecil' => 'Usaha Kecil',
                    ]),
                Tables\Filters\SelectFilter::make('uraian_risiko_proyek')
                    ->label('Skala Risiko')
                    ->searchable()
                    ->multiple()
                    ->options([
                        'Tinggi' => 'Tinggi',
                        'Menengah Tinggi' => 'Menengah Tinggi',
                        'Menengah Rendah' => 'Menengah Rendah',
                        'Rendah' => 'Rendah',
                    ]),
                Tables\Filters\SelectFilter::make('kab_kota_id')
                    ->label('Kabupaten/Kota')
                    ->relationship('kabkota', 'nama')
                    ->searchable()
                    ->multiple(),
                SelectFilter::make('sektor')->label('Kategori')
                    ->multiple()
                    ->options(function () {
                        $sektors = Sektor::all()->pluck('sektor')->toArray();
                        $sektor = array_combine($sektors, $sektors);
                        // dd($sektor);
                        return $sektor;
                    }),

            ], layout: \Filament\Tables\Enums\FiltersLayout::AboveContent, )
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('BAP')
                    ->label('BAP')
                    ->url(function (Proyek $record) {

                        //dd($record->id_proyek);
                        \Illuminate\Support\Facades\Session::put('id_proyek', $record->id);

                        return BapResource::getUrl('create', ['id_proyek' => $record->id]);
                    })
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
            'index' => Pages\ListPengawasans::route('/'),
            // 'create' => Pages\CreatePengawasan::route('/create'),
            'edit' => Pages\EditPengawasan::route('/{record}/edit'),
        ];
    }
}
