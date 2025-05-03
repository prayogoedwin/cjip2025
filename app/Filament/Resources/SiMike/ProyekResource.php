<?php

namespace App\Filament\Resources\SiMike;

use App\Filament\Resources\SiMike\ProyekResource\Pages;
use App\Filament\Resources\SiMike\ProyekResource\RelationManagers;
use App\Models\Cjip\Sektor;
use App\Models\SiMike\MappingKbli;
use App\Models\SiMike\Proyek;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Summarizers\Count;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use Illuminate\Contracts\Pagination\Paginator;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ProyekResource extends Resource
{
    protected static ?string $model = Proyek::class;
    protected static ?string $navigationGroup = 'Si-Mike';

    protected static ?int $navigationSort = -1;

    protected static ?string $navigationLabel = 'Proyek Investasi';

    protected static ?string $recordTitleAttribute = 'id_proyek';

    protected static ?string $label = 'Proyek Investasi';

    protected static ?string $pluralLabel = 'Proyek Investasi';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nib')
                    ->label('NIB'),

                Forms\Components\Section::make('Investasi')->schema([
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('mesin_peralatan')
                            ->reactive()
                            ->numeric()
                            ->afterStateUpdated(function ($state, callable $set, $get) {

                                $sum = $state + $get('mesin_peralatan_impor') + $get('pembelian_pematangan_tanah') + $get('bangunan_gedung') + $get('modal_kerja') + $get('lain_lain');

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
                        Forms\Components\TextInput::make('mesin_peralatan_impor')
                            ->reactive()
                            ->numeric()
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                $sum = $state + $get('mesin_peralatan') + $get('pembelian_pematangan_tanah') + $get('bangunan_gedung') + $get('modal_kerja') + $get('lain_lain');

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
                                $sum = $state + $get('mesin_peralatan_impor') + $get('mesin_peralatan') + $get('modal_kerja') + $get('bangunan_gedung') + $get('lain_lain');

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
                        Forms\Components\TextInput::make('bangunan_gedung')
                            ->reactive()
                            ->numeric()
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                $sum = $state + $get('mesin_peralatan_impor') + $get('mesin_peralatan') + $get('pembelian_pematangan_tanah') + $get('modal_kerja') + $get('lain_lain');
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
                    ])->columns(4),
                    Forms\Components\TextInput::make('modal_kerja')
                        ->reactive()
                        ->numeric()
                        ->afterStateUpdated(function ($state, callable $set, $get) {
                            $sum = $state + $get('mesin_peralatan_impor') + $get('pembelian_pematangan_tanah') + $get('bangunan_gedung') + $get('mesin_peralatan') + $get('lain_lain');

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
                            $sum = $state + $get('mesin_peralatan_impor') + $get('pembelian_pematangan_tanah') + $get('bangunan_gedung') + $get('modal_kerja') + $get('mesin_peralatan');
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
            ->query(
                Proyek::query()
                    ->where([
                        ['dikecualikan', '=', 0],
                        ['is_mapping', '=', 1],
                    ])
                    ->when(
                        auth()->user()->hasRole('kabkota'),
                        fn($query) =>
                        $query->where('kab_kota_id', auth()->user()->kabkota->id)
                    )
            )
            ->columns([
                Tables\Columns\TextColumn::make('id_proyek')
                    ->label('ID Proyek')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                Tables\Columns\TextColumn::make('nib')
                    ->copyable()
                    ->label('NIB')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_of_tanggal_pengajuan_proyek')
                    ->label('Tanggal Pengajuan Proyek')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_terbit_oss')
                    ->label('Tanggal Terbit OSS')
                    ->wrap()
                    ->date('d M Y')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_perusahaan')
                    ->label('Nama Perusahaan')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kbli')
                    ->label('KBLI')
                    ->searchable(),
                Tables\Columns\TextColumn::make('judul_kbli')
                    ->label('Judul KBLI')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->wrap(),
                Tables\Columns\TextColumn::make('kbli2digit.kbli_2digit')
                    ->label('KBLI 2Digit')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('kbli2digit.nama_kbli_2digit')
                    ->label('Nama KBLI 2Digit')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('kbli2digit.nama_23_sektor')
                    ->label('Nama 23 Sektor')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                Tables\Columns\TextColumn::make('klsektor_pembina')
                    ->label('K/L Sektor Pembina')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->wrap(),
                Tables\Columns\TextColumn::make('sektor')
                    ->label('Kategori')->searchable()->wrap()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('uraian_skala_usaha')
                    ->badge()
                    ->colors([
                        'warning' => 'Usaha Menengah',
                        'success' => 'Usaha Besar',
                        'danger' => 'Usaha Kecil',
                        'primary' => 'Usaha Mikro',
                    ])
                    ->label('Uraian Skala Usaha')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tahun')->sortable(),
                Tables\Columns\TextColumn::make('triwulan')->sortable(),
                Tables\Columns\TextColumn::make('jmlTenagaKerja')
                    ->label('Jumlah Naker')
                    ->getStateUsing(function (Model $record) {
                        return $record->tki + $record->tka;
                    }),
                Tables\Columns\TextColumn::make('jumlah_investasi')
                    ->label('Rencana Nilai Investasi')
                    // ->formatStateUsing(fn(float $state): string => "Rp. " . number_format($state, 0, ',', '.'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('npwp_perusahaan')
                    ->label('NPWP Perusahaan')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nama_user')
                    ->label('Nama User')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('nomor_identitas_user')
                    ->label('Nomor Identitas User')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('email')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('alamat')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('nomor_telp')
                    ->label('Nomor Telp')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('uraian_status_penanaman_modal')
                    ->label('Status Penanaman Modal')
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('alamat_usaha')
                    ->wrap()
                    ->label('Alamat Usaha')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('kelurahan_usaha')
                    ->wrap()
                    ->label('Kelurahan Usaha')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('kecamatan_usaha')
                    ->wrap()
                    ->label('Kecamatan Usaha')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('kab_kota_usaha')
                    ->wrap()
                    ->label('Kabupaten/Kota Usaha')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('luas_tanah')
                    ->wrap()
                    ->label('Luas Tanah')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('satuan_tanah')
                    ->wrap()
                    ->label('Satuan Tanah')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->deselectAllRecordsWhenFiltered(true)
            ->filtersFormColumns(3)
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make('table')
                        ->fromTable()
                        ->withChunkSize(1000)
                        ->askForFilename()
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                        ->withFilename(date('d-M-Y') . ' - Data Simike'),
                ])
                    ->button()
                    ->color('success')
            ])
            ->striped()
            ->filters(
                [
                    Filter::make('tanggal_terbit_oss')
                        ->form([
                            Fieldset::make('Tanggal Terbit Oss')
                                ->schema([
                                    DatePicker::make('created_from')->label('Tanggal Awal')
                                        ->hiddenLabel()
                                        // ->default(Carbon::now()->startOfYear())
                                        ->placeholder('Awal'),
                                    DatePicker::make('created_until')->label('Tanggal Akhir')
                                        ->hiddenLabel()
                                        // ->default(Carbon::now())
                                        ->placeholder('Akhir')
                                ])
                        ])
                        ->query(function (Builder $query, array $data): Builder {
                            return $query
                                ->when(
                                    $data['created_from'],
                                    fn(Builder $query, $date): Builder => $query->whereDate('tanggal_terbit_oss', '>=', $date),
                                )
                                ->when(
                                    $data['created_until'],
                                    fn(Builder $query, $date): Builder => $query->whereDate('tanggal_terbit_oss', '<=', $date),
                                );
                        }),
                    Filter::make('periode_start')
                        ->form([
                            Fieldset::make('Filter per Bulan')
                                ->schema([
                                    Forms\Components\Select::make('bulan')
                                        ->options([
                                            '01' => 'Januari',
                                            '02' => 'Februari',
                                            '03' => 'Maret',
                                            '04' => 'April',
                                            '05' => 'Mei',
                                            '06' => 'Juni',
                                            '07' => 'Juli',
                                            '08' => 'Agustus',
                                            '09' => 'September',
                                            '10' => 'Oktober',
                                            '11' => 'November',
                                            '12' => 'Desember',
                                        ])
                                        ->disableLabel()
                                        ->searchable()
                                        ->placeholder('Pilih Bulan'),
                                ])->columns(1),
                        ])
                        ->query(function (Builder $query, array $data): Builder {
                            return $query->when(
                                $data['bulan'],
                                fn(Builder $query, $bulan) => $query->whereMonth('periode_start', $bulan),
                            );
                        }),

                    Tables\Filters\SelectFilter::make('tahun')
                        ->options(function () {
                            $years = range(Carbon::now()->year, Carbon::now()->subYear(2)->year);
                            return array_combine(array_values($years), array_values($years));
                        })
                        ->default(Carbon::now()->year),
                    Tables\Filters\SelectFilter::make('triwulan')
                        ->options([
                            1 => 'I',
                            2 => 'II',
                            3 => 'III',
                            4 => 'IV',
                        ]),
                    // ->default(function () {
                    //     $bulan_ini = Carbon::now()->month;
                    //     if ($bulan_ini <= 3) {
                    //         return 1;
                    //     } elseif ($bulan_ini >= 3 && $bulan_ini <= 6) {
                    //         return 2;
                    //     } elseif ($bulan_ini >= 6 && $bulan_ini <= 9) {
                    //         return 3;
                    //     } elseif ($bulan_ini >= 9 && $bulan_ini <= 12) {
                    //         return 4;
                    //     }
                    //     return null;
                    // }),
                    Tables\Filters\SelectFilter::make('uraian_skala_usaha')
                        ->label('Skala Usaha')
                        ->options([
                            'Usaha Mikro' => 'Usaha Mikro',
                            'Usaha Kecil' => 'Usaha Kecil',
                        ]),
                    Tables\Filters\SelectFilter::make('kab_kota_id')
                        ->label('Kabupaten/Kota')
                        ->relationship('kabkota', 'nama')
                        ->searchable()
                        ->placeholder('Pilih Kabupaten/Kota')
                        ->visible(function () {
                            if (auth()->user()->hasRole('kabkota')) {
                                return false;
                            }
                            return true;
                        }),
                    SelectFilter::make('kecamatan_usaha')
                        ->label('Kecamatan Usaha')
                        ->searchable()
                        ->multiple()
                        ->options(function () {
                            $kec_usahas = Proyek::where('kab_kota_id', auth()->user()->kabkota->id)
                                ->whereNotNull('kecamatan_usaha')
                                ->pluck('kecamatan_usaha')
                                ->filter()
                                ->toArray();
                            if (!empty($kec_usahas)) {
                                $kec_usaha = array_combine($kec_usahas, $kec_usahas);
                            } else {
                                $kec_usaha = [];
                            }
                            return $kec_usaha;
                        })
                        ->visible(function () {
                            if (auth()->user()->hasRole('kabkota')) {
                                return true;
                            }
                            return false;
                        }),
                    SelectFilter::make('kbli')
                        ->label('KBLI')
                        ->multiple()
                        ->searchable()
                        ->options(function () {
                            $kbliCodes = Proyek::pluck('kbli')->unique()->toArray();
                            $options = [];
                            foreach ($kbliCodes as $kbli) {
                                $options[$kbli] = $kbli;
                            }
                            return $options;
                        })->visible(function () {
                            if (auth()->user()->hasRole('kabkota')) {
                                return true;
                            }
                            return true;
                        }),
                    SelectFilter::make('sektor')
                        ->label('Kategori')
                        ->multiple()
                        ->options(function () {
                            $sektors = Sektor::pluck('sektor')->unique()->toArray();
                            $options = [];
                            foreach ($sektors as $sektor) {
                                $options[$sektor] = $sektor;
                            }
                            return $options;
                        })->visible(function () {
                            if (auth()->user()->hasRole('kabkota')) {
                                return true;
                            }
                            return true;
                        }),
                    SelectFilter::make('nama_23_sektor')
                        ->label('23 Sektor')
                        ->multiple()
                        ->options(function () {
                            $kblis = MappingKbli::pluck('nama_23_sektor')->unique()->toArray();
                            $options = [];
                            foreach ($kblis as $kbli) {
                                $options[$kbli] = $kbli;
                            }
                            return $options;
                        })
                        ->visible(function () {
                            if (auth()->user()->hasRole('kabkota')) {
                                return true;
                            }
                            return true;
                        }),
                ],
                layout: FiltersLayout::AboveContent
            )
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    // protected function paginateTableQuery(Builder $query): Paginator
    // {
    //     return $query->fastPaginate(($this->getTableRecordsPerPage() === 'all') ? $query->count() : $this->getTableRecordsPerPage());
    // }
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProyeks::route('/'),
            'create' => Pages\CreateProyek::route('/create'),
            'edit' => Pages\EditProyek::route('/{record}/edit'),
        ];
    }
}
