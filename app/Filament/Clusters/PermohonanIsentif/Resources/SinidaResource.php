<?php

namespace App\Filament\Clusters\PermohonanIsentif\Resources;

use App\Filament\Clusters\PermohonanInsentif;
use App\Filament\Clusters\PermohonanIsentif;
use App\Filament\Clusters\PermohonanIsentif\Resources\SinidaResource\Pages;
use App\Filament\Clusters\PermohonanIsentif\Resources\SinidaResource\RelationManagers;
use App\Models\Sinida\Pns;
use App\Models\Sinida\Sinida;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class SinidaResource extends Resource
{
    protected static ?string $model = Sinida::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Sinida';

    protected static ?string $pluralLabel = 'Sinida';

    protected static ?string $cluster = PermohonanInsentif::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User')
                    ->collapsed(false)
                    ->hiddenOn(Pages\EditSinida::class)
                    ->schema([
                        TextInput::make('name')->label('Nama Investor'),
                        TextInput::make('email')->label('Email')->email(true)->unique(table: User::class),
                        TextInput::make('jabatan')->label('Jabatan'),
                        TextInput::make('no_hp')->label('No Handphone')->numeric(),
                        TextInput::make('password')->label('Password')->password(),
                    ])
                    ->columns(2),
                Section::make('Pengajuan Form')
                    ->schema([
                        TextInput::make('nama_perusahaan')->label('Nama Perusahaan'),
                        TextInput::make('nama_pimpinan')->label('Nama Pimpinan'),
                        TextInput::make('telepon_perusahaan')->label('Telepon Perusahaan')->numeric(),
                        TextInput::make('telepon_pimpinan')->label('Telepon Pimpinan'),
                        TextInput::make('jenis_usaha')->label('Jenis Usaha'),
                        TextInput::make('nib')->label('nib')->numeric(),
                        Textarea::make('alamat_perusahaan')->label('Alamat Perusahaan'),
                        Textarea::make('alamat_pimpinan')->label('Alamat Pimpinan'),
                        Section::make('Upload Dokumen')->schema([
                            FileUpload::make('file_1')
                                ->acceptedFileTypes(['application/pdf'])
                                ->label('Dokumen Pakta Integritas')
                                ->directory('sinida/pakta_integritas')
                                ->visibility('public')
                                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, callable $get) {
                                    $userName = $get('name');
                                    $finalName = strtolower(str_replace(' ', '_', $userName));
                                    return (string) str($file->getClientOriginalName())->prepend($finalName . uniqid() . '_sinida_pakta_integritas');
                                }),
                            Placeholder::make('Download file pakta integritas')
                                ->content(function ($get) {
                                    $filePath = $get('file_1');
                                    if (!empty($filePath)) {
                                        $fileUrl = asset('storage/' . reset($filePath));
                                        return new HtmlString('<a href="' . $fileUrl . '" target="_blank">Download File Anda</a>');
                                    }
                                }),
                            FileUpload::make('file_2')
                                ->acceptedFileTypes(['application/pdf'])
                                ->label('Dokumen Tidak Menerima Insentif')
                                ->directory('sinida/tidak_menerima_intensif')
                                ->visibility('public')
                                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, callable $get) {
                                    $userName = $get('name');
                                    $finalName = strtolower(str_replace(' ', '_', $userName));
                                    return (string) str($file->getClientOriginalName())->prepend($finalName . uniqid() . '_tidak_menerima_intensif');
                                }),
                            Placeholder::make('Download file tidak menerima insentif')
                                ->content(function ($get) {
                                    $filePath = $get('file_2');
                                    if (!empty($filePath)) {
                                        $fileUrl = asset('storage/' . reset($filePath));
                                        return new HtmlString('<a href="' . $fileUrl . '" target="_blank">Download File Anda</a>');
                                    }
                                }),
                            FileUpload::make('file_ktp')
                                ->acceptedFileTypes(['application/pdf'])
                                ->label('Dokumen KTP')
                                ->directory('sinida/file_ktp')
                                ->visibility('public')
                                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, callable $get) {
                                    $userName = $get('name');
                                    $finalName = strtolower(str_replace(' ', '_', $userName));
                                    return (string) str($file->getClientOriginalName())->prepend($finalName . uniqid() . '_file_ktp');
                                }),
                            Placeholder::make('Download file KTP')
                                ->content(function ($get) {
                                    $filePath = $get('file_ktp');
                                    if (!empty($filePath)) {
                                        $fileUrl = asset('storage/' . reset($filePath));
                                        return new HtmlString('<a href="' . $fileUrl . '" target="_blank">Download File Anda</a>');
                                    }
                                }),
                            FileUpload::make('file_permohonan_direktur')
                                ->acceptedFileTypes(['application/pdf'])
                                ->label('Dokumen Permohonan Direktur ke Kepala DPMPTSP')
                                ->directory('sinida/permohonan_direktur_ke_kepala_dpmptsp')
                                ->visibility('public')
                                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, callable $get) {
                                    $userName = $get('name');
                                    $finalName = strtolower(str_replace(' ', '_', $userName));
                                    return (string) str($file->getClientOriginalName())->prepend($finalName . uniqid() . '_permohonan_direktur_ke_kepala_dpmptsp');
                                }),
                            Placeholder::make('Download file Permohonan Direktur ke Kepala DPMPTSP')
                                ->content(function ($get) {
                                    $filePath = $get('file_permohonan_direktur');
                                    if (!empty($filePath)) {
                                        $fileUrl = asset('storage/' . reset($filePath));
                                        return new HtmlString('<a href="' . $fileUrl . '" target="_blank">Download File Anda</a>');
                                    }
                                }),

                        ]),
                        Section::make('Status')->schema([
                            Select::make('status_id')
                                ->relationship('status_template', 'subject', fn($query) => $query->where('modul', 'sinida'))
                                ->label('Status'),
                            Select::make('disposisi')
                                ->multiple()
                                ->options(Pns::all()->pluck('nama', 'id')),
                        ])->columns(2),
                        Section::make('Notifikasi')->schema([
                            Checkbox::make('send_notification')
                                ->label('Kirim  notifikasi ke perusahaan/investor?'),
                            Checkbox::make('kirim_kepala_dinas')
                                ->label('Kirim ke kepala dinas?'),
                        ])
                    ])
                    ->columns(2),
                Section::make('Isian Surat')->collapsed()
                    ->schema([
                        DatePicker::make('menerima_diterima')->label('Tanggal diterima'),
                        Section::make('Keputusan')->schema([
                            TextInput::make('kesatu_sebesar'),
                            // ->mask(fn(TextInput\Mask $mask) => $mask->money(thousandsSeparator: ',', decimalPlaces: 2, prefix: 'Rp')),
                            TextInput::make('kesatu_insentif'),
                            MarkdownEditor::make('kedua'),
                            MarkdownEditor::make('ketiga'),
                            MarkdownEditor::make('keempat'),
                        ])->columns(2),

                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->wrap()->searchable(),
                TextColumn::make('status_template.subject')->wrap()->searchable()
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
            'index' => Pages\ListSinidas::route('/'),
            'create' => Pages\CreateSinida::route('/create'),
            'edit' => Pages\EditSinida::route('/{record}/edit'),
        ];
    }
}
