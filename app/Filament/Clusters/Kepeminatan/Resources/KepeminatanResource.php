<?php

namespace App\Filament\Clusters\Kepeminatan\Resources;

use App\Filament\Clusters\Kepeminatan;
use App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource\Pages;
use App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource\RelationManagers;
use App\Models\Kepeminatan\Kepeminatan as modelKepeminatan;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KepeminatanResource extends Resource
{
    protected static ?string $model = modelKepeminatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Kepeminatan';

    protected static ?string $pluralLabel = 'Kepeminatan';

    protected static ?int $navigationSort = 1;

    protected static ?string $cluster = Kepeminatan::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User')
                    ->hiddenOn(Pages\EditKepeminatan::class)
                    ->collapsed(false)
                    ->schema([
                        TextInput::make('name')->label('Nama Investor')->required(),
                        TextInput::make('email')->label('Email')->email(true)->unique(table: User::class)->required(),
                        // TextInput::make('email')->label('Email')->email(true),
                        TextInput::make('jabatan')->label('Jabatan')->required(),
                        TextInput::make('no_hp')->label('No Handphone')->required(),
                        TextInput::make('password')->label('Password')->password()->required(),
                        TextInput::make('nama_perusahaan')->label('Nama Perusahaan'),
                        TextInput::make('jenis_usaha')->label('Jenis Usaha'),
                        TextInput::make('negara_asal')->label('Negara Asal'),
                        TextInput::make('induk_perusahaan')->label('Induk Perusahaan'),
                        Textarea::make('alamat_perusahaan')->label('Alamat Perusahaan')->maxLength(255),
                    ])
                    ->columns(2),
                Section::make('Kepeminatan')
                    ->schema([
                        TextInput::make('rencana_bidang_usaha')->label('Rencana Usaha'),
                        TextInput::make('prefensi_lokasi')->label('Prefensi Lokasi'),
                        Radio::make('status_investasi')
                            ->label('Status Investasi')
                            ->options([
                                0 => 'NEW (GREENFIELD) / BARU',
                                1 => 'EXPANSION (BROWNFIELD) / EXPANSI',
                            ])
                            ->inline()
                            ->inlineLabel(false),
                        Section::make('Nilai Investasi')->schema([
                            Checkbox::make('nilai_investasi')->label('$'),
                            TextInput::make('nilai_investasi')->disableLabel(),

                            Checkbox::make('nilai_investasi_rupiah')->label('Rp.'),
                            TextInput::make('nilai_investasi_rupiah')->disableLabel()
                        ])->columns(2),
                        Section::make('Pekerja')->schema([
                            Section::make('Local Worker / TKI')->schema([
                                Checkbox::make('local_plan')->label('Plan / Rencana'),
                                TextInput::make('local_worker_plan')->disableLabel(),

                                Checkbox::make('local_exis')->label('Existing / Existing'),
                                TextInput::make('local_worker_exis')->disableLabel()
                            ])->columns(2),
                            Section::make('Foreign Worker / TKI')->schema([
                                Checkbox::make('foreign_plan')->label('Plan / Rencana'),
                                TextInput::make('foreign_worker_plan')->disableLabel(),

                                Checkbox::make('foreign_exis')->label('Existing / Existing'),
                                TextInput::make('foreign_worker_exis')->disableLabel()
                            ])->columns(2)

                        ])->columns(2),

                        Textarea::make('deskripsi_proyek')->label('Deskripsi Proyek'),
                        DateTimePicker::make('jadwal_proyek')->label('Jadwal Proyek'),
                        Select::make('status_id')
                            ->relationship('status_template', 'subject', fn($query) => $query->where('modul', 'kepeminatan'))
                            ->label('Status')
                            ->columnSpan('full'),
                        Checkbox::make('send_notification')
                            ->label('Kirim  notifikasi ke perusahaan/investor?'),
                    ])
                    ->columns(2)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable()->label('Nama Investor'),
                TextColumn::make('user.jabatan')
                    ->toggleable()
                    ->label('Jabatan')
                    ->searchable()->label('jabatan'),
                TextColumn::make('user.email')
                    ->searchable()
                    ->label('Email')
                    ->toggleable(),
                TextColumn::make('user.userperusahaan.nama_perusahaan')
                    ->searchable()
                    ->wrap()
                    ->label('Nama Perusahaan')
                    ->toggleable(),
                TextColumn::make('user.userperusahaan.alamat_perusahaan')
                    ->searchable()
                    ->wrap()
                    ->label('Alamat Perusahaan')
                    ->toggleable(),
                TextColumn::make('rencana_bidang_usaha')->label('Bidang Usaha')
                    ->wrap()
                    ->searchable(),
                BadgeColumn::make('status_investasi')
                    ->label('Status Investasi')
                    // ->enum([
                    //     '1' => 'New',
                    //     '0' => 'Ekspansi',
                    // ])
                    ->color(static function ($state): string {
                        if ($state === 1) {
                            return 'success';
                        }
                        return 'primary';
                    }),
                TextColumn::make('prefensi_lokasi')
                    ->label('Prefensi Lokasi')
                    ->wrap(),
                TextColumn::make('proyek.nama')
                    ->label('Nama Proyek')
                    ->wrap(),
                TextColumn::make('deskripsi_proyek')
                    ->wrap()
                    ->label('Deskripsi Proyek')
                    ->toggleable(),
                TextColumn::make('sektor')->wrap()
                    ->label('Sektor')
                    ->toggleable(),
                TextColumn::make('nilai_investasi')
                    ->label('Nilai Investasi Dolar')
                    ->money('usd')
                    ->extraAttributes([
                        'class' => 'font-bold',
                    ]),
                TextColumn::make('nilai_investasi_rupiah')
                    ->label('Nilai Investasi Rupiah')
                    ->money('idr')
                    ->extraAttributes([
                        'class' => 'font-bold',
                    ]),
                TextColumn::make('jadwal_proyek')->date('d M Y')->label('Jadwal Proyek')->toggleable(),
                TextColumn::make('status_template.subject')
                    ->wrap()
                    ->searchable()
                    ->toggleable()
                    ->color('primary'),
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
            'index' => Pages\ListKepeminatans::route('/'),
            'create' => Pages\CreateKepeminatan::route('/create'),
            'edit' => Pages\EditKepeminatan::route('/{record}/edit'),
        ];
    }
}
