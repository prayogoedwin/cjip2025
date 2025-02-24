<?php

namespace App\Filament\Clusters\Cjip\Resources;

use App\Filament\Clusters\Cjip;
use App\Filament\Clusters\Cjip\Resources\PermintaanFileKajianResource\Pages;
use App\Filament\Clusters\Cjip\Resources\PermintaanFileKajianResource\RelationManagers;
use App\Models\Cjip\PermintaanFileKajian as CjipPermintaanFileKajian;
use App\Models\Cjip\ProyekInvestasi;
use App\Models\PermintaanFileKajian;
use App\Notifications\PermintaanKajian;
use Carbon\Carbon;
use Dompdf\FrameDecorator\Text;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Notification as Notifications;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermintaanFileKajianResource extends Resource
{
    protected static ?string $model = CjipPermintaanFileKajian::class;

    public $pemohon;

    protected static ?string $recordTitleAttribute = 'nama';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'File Kajian';
    protected static ?string $navigationLabel = 'Permintaan Kajian Proyek';
    protected static ?string $pluralLabel = 'Permintaan Kajian Proyek';
    protected static ?string $cluster = CJIP::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('proyek_id')
                        ->label('Proyek Investasi')
                        ->placeholder('Pilih Proyek Investasi')
                        ->options(ProyekInvestasi::where('status', 1)->pluck('nama', 'id'))
                        ->searchable()
                        ->required(),
                    TextInput::make('name')
                        ->required()
                        ->label('Nama Lengkap')
                        ->placeholder('Masukan Nama Lengkap Anda'),
                    TextInput::make('email')
                        ->required()
                        ->email()
                        ->label('Email')
                        ->placeholder('Masukan Email Anda'),
                    TextInput::make('phone')
                        ->numeric()
                        ->placeholder('Masukan Nomor Telepon Anda')
                        ->label('Nomor Telepon'),
                    TextInput::make('company')
                        ->label('Perusahaan/Institusi')
                        ->placeholder('Masukan Nama Perusahaan/institusi Anda'),
                    // Textarea::make('message')
                    //     ->label('Pesan')
                    //     ->placeholder('Masukan Pesan Anda'),
                    FileUpload::make('file')
                        ->label('File Kajian Proyek')
                        ->disk('public')
                        ->openable()
                        ->downloadable()
                        ->hiddenOn('create')
                        ->acceptedFileTypes(['application/pdf'])
                        ->preserveFilenames()
                        ->directory('File Kajian Proyek')
                        ->required(),
                    Hidden::make('status')
                        ->default(0),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('proyek.nama')->label('Proyek')->wrap(),
                TextColumn::make('name')->label('Nama Lengkap')->wrap()->searchable(),
                TextColumn::make('email')->label('Email')
                    ->tooltip('Klik untuk menyalin email')
                    ->copyable()
                    ->wrap()
                    ->searchable()
                    ->icon('heroicon-s-envelope')
                    ->color('primary'),
                TextColumn::make('phone')->label('Nomor Telepon'),
                TextColumn::make('company')->label('Perusahaan/Institusi')->wrap(),
                TextColumn::make('created_at')->date('d M Y')
                    ->label('Tanggal Pengajuan')
                    ->wrap()
                    ->sortable(),
                TextColumn::make('status')
                    ->alignRight()
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            1 => 'Selesai',
                            0 => 'Menunggu',
                            null => 'Menunggu',
                        };
                    })
                    ->colors([
                        'success' => 1,
                        'warning' => 0,
                    ])
                    ->icons([
                        'heroicon-s-check-circle' => 1,
                        'heroicon-s-document' => 0,
                    ])
            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make()->label('Lihat'),
                ]),
                Action::make('balas')
                    ->button()
                    ->icon('heroicon-s-envelope-open')
                    ->iconPosition('after')
                    ->label('Balas')
                    ->action(function (\App\Models\Cjip\PermintaanFileKajian $record, array $data): void {
                        $record->status = 1;
                        $record->file = $data['file'];
                        $record->save();

                        Notification::make()
                            ->title('Riwayat Data telah direkam')
                            ->success()
                            ->send();

                        $recipient = auth()->user();

                        Notification::make()
                            ->title('Permohonan Data Kajian Proyek')
                            ->body("Permohonan telah selesai, Balasan Sudah dikirim ke pemohon ")
                            ->icon('heroicon-o-document-text')
                            ->iconColor('primary')
                            ->sendToDatabase($recipient);

                        $body = 'Kepada Yth. Bapak/i ' . $record->name
                            . ' kami lampirkan file kajian proyek sesuai dengan permohonan anda.';

                        $pemohon = \App\Models\Cjip\PermintaanFileKajian::find($record->id);

                        if ($pemohon) {
                            try {
                                Notifications::route('mail', $pemohon->email)
                                    ->notify(new PermintaanKajian($body, $pemohon->file));
                                Notification::make()
                                    ->title('Email berhasil dikirim ke Pemohon')
                                    ->success()
                                    ->send();
                            } catch (\Exception $e) {
                                \Filament\Notifications\Notification::make()
                                    ->title('Email tidak terkirim')
                                    ->danger()
                                    ->send();
                            }
                        }
                    })
                    ->form([
                        FileUpload::make('file')
                            ->label('File Kajian Proyek')
                            ->disk('public')
                            ->openable()
                            ->helperText('Silahkan upload file kajian proyek')
                            ->downloadable()
                            ->acceptedFileTypes(['application/pdf'])
                            ->preserveFilenames()
                            ->directory('File Kajian Proyek')
                            ->required(),
                    ]),

            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 0)->count();
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
            'index' => Pages\ListPermintaanFileKajians::route('/'),
            'create' => Pages\CreatePermintaanFileKajian::route('/create'),
            'view' => Pages\ViewPermintaanFileKajian::route('/{record}'),
            'edit' => Pages\EditPermintaanFileKajian::route('/{record}/edit'),
        ];
    }
}
