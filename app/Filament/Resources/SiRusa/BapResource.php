<?php

namespace App\Filament\Resources\SiRusa;

use App\Filament\Resources\SiRusa\BapResource\Pages;
use App\Filament\Resources\SiRusa\BapResource\RelationManagers;
use App\Models\SiMike\Proyek;
use App\Models\SiRusa\Bap;
use Carbon\Carbon;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;

class BapResource extends Resource
{
    protected static ?string $model = Bap::class;

    protected static ?string $navigationGroup = 'Si-Rusa';

    protected static ?int $navigationSort = 3;

    protected static ?string $slug = 'bap';

    protected static ?string $navigationLabel = 'BAP';

    protected static ?string $label = 'BAP';

    protected static ?string $pluralLabel = 'BAP';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make()->schema([
                    Step::make('Perizinan')
                        ->description('Pengawasan Perizinan')
                        ->schema([
                            Select::make('proyek_id')
                                ->label('Perusahaan')
                                ->searchable()
                                ->default(function () {
                                    if (request()->query('id_proyek')) {
                                        return (string) request()->query('id_proyek');
                                    }

                                    return null;

                                })

                                ->columnSpanFull()
                                ->getSearchResultsUsing(fn(string $search) => Proyek::where('nama_perusahaan', 'like', "%{$search}%")
                                    ->limit(50)
                                    ->get()
                                    ->pluck('proyek_kbli', 'id'))
                                ->getOptionLabelUsing(fn($value): ?string => Proyek::find($value)?->proyek_kbli)
                                ->reactive()
                                ->afterStateUpdated(function (Set $set, $state) {
                                    //dd($state);
                        
                                    $perusahaan = Proyek::where('id', $state)->first();
                                    if ($perusahaan->nibCheck) {
                                        $set('tanggal_nib', $perusahaan->nibCheck->tanggal_terbit_oss);
                                        $set('nama_perusahaan', $perusahaan->nibCheck->nama_perusahaan);
                                    }
                                    $set('nib', $perusahaan->nib);
                                    $set('rencana_investasi', $perusahaan->total_investasi);
                                    $set('alamat', $perusahaan->alamat_usaha);

                                }),
                            Forms\Components\Grid::make()->schema([
                                TextInput::make('nib')
                                    ->default(function () {
                                        if (request()->query('id_proyek')) {
                                            return Proyek::where('id', request()->query('id_proyek'))->first()->nib;
                                        }
                                    })
                                    ->disabled(),
                                Forms\Components\DatePicker::make('tanggal_nib')
                                    ->default(function () {
                                        if (request()->query('id_proyek')) {
                                            return Proyek::where('id', request()->query('id_proyek'))->first()->nibCheck->day_of_tanggal_terbit_oss;
                                        }
                                    }),
                                Toggle::make('is_punya_ss')
                                    ->label('Apakah memiliki SS atau Izin?')
                                    ->reactive()
                                    ->default(false),
                                Forms\Components\Select::make('status_riil')
                                    ->label('Status Riil di Lapangan')
                                    ->reactive()
                                    ->searchable()
                                    ->options(['Konstruksi' => 'Konstruksi', 'Operational' => 'Operational']),
                                Forms\Components\DatePicker::make('tanggal_konstruksi_selesai')
                                    ->visible(function (\Filament\Forms\Get $get) {
                                        //dd($get('jenis_anggaran'));
                                        if ($get('status_riil') === 'Konstruksi') {
                                            return true;
                                        }
                                        return false;
                                    }),
                                Forms\Components\DatePicker::make('tanggal_mulai_operasi')
                                    ->visible(function (\Filament\Forms\Get $get) {
                                        //dd($get('jenis_anggaran'));
                                        if ($get('status_riil') === 'Operational') {
                                            return true;
                                        }
                                        return false;
                                    }),
                            ])->columns(2),

                            TableRepeater::make('detail_ss')
                                ->label('SS atau Izin')
                                // ->headers(['Nama SS atau izin', 'Nomor SS atau Izin', 'Tanggal'])
                                // ->breakPoint('sm')
                                ->schema([
                                    TextInput::make('nama')
                                        ->label('Jenis SS atau Izin'),
                                    TextInput::make('ss')
                                        ->label('Nomor SS atau Izin'),
                                    Forms\Components\DatePicker::make('tanggal_ss')
                                        ->label('Tanggal SS atau Izin'),
                                ])
                                ->defaultItems(1)
                                ->createItemButtonLabel('Add SS atau Izin')
                                ->columns(2)
                                ->collapsible()
                                ->visible(function (\Filament\Forms\Get $get) {
                                    //dd($get('jenis_anggaran'));
                                    if ($get('is_punya_ss') === true) {
                                        return true;
                                    }
                                    return false;
                                }),

                        ]),
                    Step::make('Investasi')
                        ->description('Pengawasan Investasi')
                        ->schema([
                            Forms\Components\Grid::make()->schema([
                                TextInput::make('rencana_investasi')
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->numeric()
                                    ->disabled(),
                                TextInput::make('realisasi_investasi')
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->numeric(),
                                TableRepeater::make('sumber_listriks')
                                    ->required()
                                    // ->headers(['Sumber', 'Kapasitas (Kva)'])
                                    ->schema([
                                        Forms\Components\Select::make('sumber')
                                            ->searchable()
                                            ->disableLabel()
                                            ->options(['PLN' => 'PLN', 'Genset' => 'Genset', 'Lainnya' => 'Lainnya']),
                                        TextInput::make('kapasitas_listrik')
                                            ->suffix(' Kva')
                                            ->disableLabel(),
                                    ])
                                    ->defaultItems(1)
                                    ->createItemButtonLabel('Tambah Listrik')
                                    ->columns(2)
                                    ->collapsible()
                                    ->columnSpanFull(),
                                Forms\Components\Grid::make()->schema([
                                    TextInput::make('luas_tanah'),
                                    Forms\Components\TextInput::make('luas_bangunan'),
                                    Forms\Components\TextInput::make('status_tanah'),
                                ])->columns(3)
                            ])->columns(2),
                            Toggle::make('kesusaian_investasi')
                                ->reactive()
                                ->label('Apakah Investasi Sesuai?'),
                            TextInput::make('keterangan_investasi_tidak_sesuai')
                                ->visible(function (\Filament\Forms\Get $get) {
                                    //dd($get('jenis_anggaran'));
                                    if ($get('kesusaian_investasi') === false) {
                                        return true;
                                    }
                                    return false;
                                }),
                            Section::make('LKPM')
                                ->description('Pelaporan LKPM')
                                ->schema([
                                    Toggle::make('is_lapor_lkpm')
                                        ->label('Apakah Sudah Lapor LKPM?'),
                                    TextInput::make('status_lkpm'),
                                    TextInput::make('kendala_lkpm'),
                                    TableRepeater::make('potensi_investasi')
                                        ->label('Potensi Investasi')
                                        // ->headers(['Jenis', 'Jumlah'])
                                        ->schema([
                                            TextInput::make('jenis_potensi_investasi')
                                                ->disableLabel(),
                                            TextInput::make('jumlah_potensi_investasi')
                                                ->disableLabel()
                                                ->mask(RawJs::make('$money($input)'))
                                                ->stripCharacters(',')
                                                ->numeric()
                                        ])
                                        ->defaultItems(1)
                                        ->createItemButtonLabel('Tambah Potensi Investasi')
                                        ->columns(2),
                                    TableRepeater::make('tk')
                                        ->label('Tenaga Kerja')
                                        // ->headers(['L/P', 'Jumlah'])
                                        ->schema([
                                            Forms\Components\Select::make('jenis_tk')
                                                ->options(['L' => 'L', 'P' => 'P'])
                                                ->disableLabel(),
                                            TextInput::make('jumlah_tk')
                                                ->disableLabel()
                                                ->numeric()
                                        ])
                                        ->defaultItems(1)
                                        ->createItemButtonLabel('Tambah Tenaga Kerja')
                                        ->columns(2),
                                    TextInput::make('tka')->label('Jumlah TKA'),
                                    TextInput::make('jam_kerja'),
                                ])
                        ]),
                    Step::make('Kapasitas')
                        ->description('Pengawasan Kapasitas')
                        ->schema([
                            TableRepeater::make('jenis_kapasitas_produksi')
                                ->label('Jenis/ Kapasitas Produksi')
                                // ->headers(['Jenis', 'Rencana Kapasitas', 'Realisasi Kapasitas', 'Satuan'])
                                ->schema([
                                    TextInput::make('jenis_kapasitas')
                                        ->disableLabel(),
                                    TextInput::make('rencana_kapasitas_produksi')
                                        ->disableLabel(),
                                    TextInput::make('realisasi_kapasitas_produksi')
                                        ->disableLabel(),
                                    TextInput::make('satuan_kapasitas_produksi')
                                        ->disableLabel(),
                                ])
                                ->defaultItems(1)
                                ->createItemButtonLabel('Tambah Jenis/Kapasitas')
                                ->columns(4),
                            Forms\Components\Textarea::make('alur_produksi')
                        ]),
                    Step::make('Fasilitas')
                        ->description('Pengawasan Fasilitas Penanaman Modal')
                        ->schema([
                            Toggle::make('is_mengajukan_fasilitas')
                                ->reactive()
                                ->label('Apakah mengajukan Fasilitas Penanaman Modal?'),
                            Forms\Components\Select::make('jenis_fasilitas')
                                ->options([
                                    'Tax Allowance' => 'Tax Allowance',
                                    'Tax Holiday' => 'Tax Holiday',
                                    'Pembebasan Impor Bahan Baku' => 'Pembebasan Impor Bahan Baku',
                                    'Pembebasan Impor Mesin' => 'Pembebasan Impor Mesin',
                                ])
                                ->multiple()
                                ->visible(function (\Filament\Forms\Get $get) {
                                    //dd($get('jenis_anggaran'));
                                    if ($get('is_mengajukan_fasilitas') === true) {
                                        return true;
                                    }
                                    return false;
                                }),
                        ]),
                    Step::make('Kewajiban')
                        ->description('Pengawasan Kewajiban bagi Pelaku Usaha')
                        ->schema([
                            Section::make('Kemitraan')->schema([
                                Toggle::make('is_bermitra')
                                    ->helperText('cek KBLI terlebih dahulu, wajib bermitra atau tidak')
                                    ->label('Apakah proyek ini wajib bermitra dengan UMK?')
                                    ->reactive(),
                                TableRepeater::make('kemitraan')
                                    ->label('Kemitraan')
                                    // ->headers(['Jenis Kemitraan', 'Partner UMK'])
                                    // ->hideLabels()
                                    // ->breakPoint('sm')
                                    ->schema([
                                        TextInput::make('jenis_kemitraan'),
                                        TextInput::make('partner_kemitraan'),

                                    ])
                                    ->defaultItems(1)
                                    ->createItemButtonLabel('Tambah Mitra')
                                    ->columns(2)
                                    ->collapsible()
                                    ->visible(function (\Filament\Forms\Get $get) {
                                        //dd($get('jenis_anggaran'));
                                        if ($get('is_bermitra') === true) {
                                            return true;
                                        }
                                        return false;
                                    }),
                            ])->collapsible(),
                            Section::make('BPJS Ketenagakerjaan')->schema([
                                Toggle::make('is_bpjs')
                                    ->label('Apakah sudah memiliki BPJS Ketenagakerjaan?')
                                    ->reactive(),
                                TextInput::make('no_bpjs_ketenagakerjaan')
                                    ->visible(function (\Filament\Forms\Get $get) {
                                        //dd($get('jenis_anggaran'));
                                        if ($get('is_bpjs') === true) {
                                            return true;
                                        }
                                        return false;
                                    }),

                            ])
                                ->collapsible(),
                            Section::make('CSR')->schema([
                                Toggle::make('is_csr')
                                    ->label('Apakah memiliki Program CSR?')
                                    ->reactive(),
                                TextInput::make('alokasi_dana_csr')
                                    ->label('Alokasi dana CSR')
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->numeric()
                                    ->visible(function (\Filament\Forms\Get $get) {
                                        //dd($get('jenis_anggaran'));
                                        if ($get('is_csr') === true) {
                                            return true;
                                        }
                                        return false;
                                    }),
                                TextInput::make('objek_csr')
                                    ->label('Objek CSR')
                                    ->visible(function (\Filament\Forms\Get $get) {
                                        //dd($get('jenis_anggaran'));
                                        if ($get('is_csr') === true) {
                                            return true;
                                        }
                                        return false;
                                    }),
                                TextInput::make('program_csr')
                                    ->label('Program CSR')
                                    ->visible(function (\Filament\Forms\Get $get) {
                                        //dd($get('jenis_anggaran'));
                                        if ($get('is_csr') === true) {
                                            return true;
                                        }
                                        return false;
                                    }),
                            ])
                                ->collapsible(),
                            Section::make('Pengelolaan Lingkungan')->schema([
                                Forms\Components\Select::make('dokumen_lingkungan')
                                    ->searchable()
                                    ->options(['Amdal', 'UKL UPL', 'SPPL']),
                                Forms\Components\Select::make('mateial_lingkungan')
                                    ->label('Jenis Limbah')
                                    ->searchable()
                                    ->options(['Padat' => '', 'Cair' => 'Padat', 'Gas' => 'Cair']),
                                TextInput::make('ipal')
                                    ->label('IPAL berupa?')
                                    ->helperText('cek di dokumen Lingkungan'),
                                TextInput::make('jumlah_unit')->numeric(),
                                Forms\Components\Select::make('fungsi_unit')
                                    ->label('Berfungsi atau tidak')
                                    ->searchable()
                                    ->options(['Berfungsi', 'Tidak']),

                            ])
                                ->columns(2)
                                ->collapsible(),
                            Section::make('Pelatihan TKI')->schema([
                                TextInput::make('jenis_pelatihan'),
                                TextInput::make('jumlah_pelatihan')->numeric(),
                            ])
                                ->collapsible(),

                        ]),
                    Step::make('Rekomendasi & Tindak Lanjut')
                        ->description('Rekomendasi & Tindak Lanjut')
                        ->schema([
                            TableRepeater::make('masalah')
                                // ->headers(['Uraian Masalah'])
                                ->schema([
                                    Forms\Components\Textarea::make('uraian_masalah')
                                        ->maxLength(255)
                                        ->disableLabel(),
                                ])
                                ->defaultItems(1)
                                ->createItemButtonLabel('Tambah')
                                ->columns(2)
                                ->collapsible(),
                            TableRepeater::make('rekomendasi')
                                // ->headers(['Uraian Rekomendasi'])
                                ->schema([
                                    Forms\Components\Textarea::make('uraian_rekomendasi')
                                        ->maxLength(255)
                                        ->disableLabel(),
                                ])
                                ->defaultItems(1)
                                ->createItemButtonLabel('Tambah Rekomendasi')
                                ->columns(2)
                                ->collapsible(),
                            TableRepeater::make('tindak_lanjut')
                                // ->headers(['Uraian Tindak Lanjut'])
                                ->schema([
                                    Forms\Components\Textarea::make('uraian_tindak_lanjut')
                                        ->maxLength(255)
                                        ->disableLabel(),
                                ])
                                ->defaultItems(1)
                                ->createItemButtonLabel('Tambah Tindak Lanjut')
                                ->columns(2)
                                ->collapsible(),
                        ]),
                    Step::make('Kontak')
                        ->description('Foto, Kontak')
                        ->schema([
                            Forms\Components\FileUpload::make('foto_proyek')
                                ->directory('Si Rusa/Pengawasan/' . Carbon::now()->year)
                                ->image()
                                ->autofocus()
                                ->maxSize(51200)
                                ->multiple(),
                            Section::make('Kontak Perusahaan')->schema([
                                TextInput::make('nama'),
                                TextInput::make('jabatan'),
                                TextInput::make('no_hp')
                                    ->mask('000-000-000-000'),

                            ])
                                ->collapsible(),
                        ])

                    ,
                    Step::make('Summary')
                        ->description('Summary')
                        ->schema([
                            TiptapEditor::make('summary')
                        ])->visibleOn(['edit', 'view']),
                ])
                    ->columnSpanFull()
                    ->skippable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal_bap')->date('d M Y')->label('Tanggal BAP'),
                Tables\Columns\TextColumn::make('proyek.id_proyek')->label('ID Proyek'),
                Tables\Columns\TextColumn::make('proyek.nib')->label('NIB'),
                Tables\Columns\TextColumn::make('proyek.kbli')->label('KBLI'),
                Tables\Columns\TextColumn::make('proyek.nama_perusahaan')->label('Nama Perusahaan')->wrap(),
                Tables\Columns\TextColumn::make('proyek.kabkota.nama')->searchable()->label('Kabupaten/Kota'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListBaps::route('/'),
            'create' => Pages\CreateBap::route('/create'),
            'edit' => Pages\EditBap::route('/{record}/edit'),
        ];
    }
}
