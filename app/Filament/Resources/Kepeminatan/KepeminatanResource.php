<?php

namespace App\Filament\Resources\Kepeminatan;

use App\Filament\Resources\Kepeminatan\KepeminatanResource\Pages;
use App\Filament\Resources\Kepeminatan\KepeminatanResource\RelationManagers;
use App\Models\Kepeminatan\Kepeminatan;
use App\Models\User;
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
use Filament\Tables\Columns\TextColumn;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KepeminatanResource extends Resource
{
    protected static ?string $model = Kepeminatan::class;

    protected static ?string $navigationGroup = 'Kepeminatan';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Kepeminatan';

    protected static ?string $recordTitleAttribute = 'kepeminatan';
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
                            Checkbox::make('nilai_investasi_dollar')->label('$'),
                            TextInput::make('input_investasi_dollar')->label(false)->default('35,000,000'),

                            Checkbox::make('nilai_investasi_rupiah')->label('Rp.'),
                            TextInput::make('input_investasi_rupiah')->label(false)
                        ])->columns(2),
                        Section::make('Pekerja')->schema([
                            Section::make('Local Worker / TKI')->schema([
                                Checkbox::make('local_plan')->label('Plan / Rencana'),
                                TextInput::make('local_worker_plan')->label(false),

                                Checkbox::make('local_exis')->label('Existing / Existing'),
                                TextInput::make('local_worker_exis')->label(false)
                            ])->columns(2),
                            Section::make('Foreign Worker / TKI')->schema([
                                Checkbox::make('foreign_plan')->label('Plan / Rencana'),
                                TextInput::make('foreign_worker_plan')->label(false),

                                Checkbox::make('foreign_exis')->label('Existing / Existing'),
                                TextInput::make('foreign_worker_exis')->label(false)
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
                TextColumn::make('user.name')->searchable()->label('Nama Investor'),
                TextColumn::make('rencana_bidang_usaha')->label('Bidang Usaha')->searchable(),
                TextColumn::make('status_investasi')->label('Status')
                    ->getStateUsing(function ($record) {
                        return $record->status_investasi == 1 ? 'New' : 'Ekspansi';
                    })->sortable()->searchable(),
                TextColumn::make('prefensi_lokasi')->label('Prefensi Lokasi'),
                TextColumn::make('proyek.nama')->label('Proyek'),
                TextColumn::make('deskripsi_proyek')->wrap()->label('Deskripsi Proyek')->toggleable(),
                TextColumn::make('sektor')->wrap()->label('Sektor')->toggleable(),
                TextColumn::make('nilai_investasi_rupiah')->label('Nilai Investasi'),
                TextColumn::make('jadwal_proyek')->date('d M Y')->label('Jadwal Proyek')->toggleable(),
                TextColumn::make('status_template.subject')->wrap()->searchable()->extraAttributes(['style' => 'color: blue;']),

            ])
            ->filters([
                //
            ])->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make('table')
                        ->fromTable()
                        ->withFilename(date('d-M-Y') . ' - Data Kepeminatan')
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX),
                ])
                    ->button()
                    ->color('success')
            ])
            ->actions([
                Action::make('print')
                    ->icon('heroicon-o-printer')
                    // ->url(fn(Kepeminatan $record): string => route('download-loi', $record->id))
                    ->openUrlInNewTab(),
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
