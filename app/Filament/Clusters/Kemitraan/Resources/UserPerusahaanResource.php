<?php

namespace App\Filament\Clusters\Kemitraan\Resources;

use App\Filament\Clusters\Kemitraan;
use App\Filament\Clusters\Kemitraan\Resources\UserPerusahaanResource\Pages;
use App\Filament\Clusters\Kemitraan\Resources\UserPerusahaanResource\RelationManagers;
use App\Filament\Clusters\Kemitraan\Resources\UserPerusahaanResource\RelationManagers\PerusahaanRelationManager;
use App\Models\Kepeminatan\Perusahaan;
use App\Models\UserPerusahaan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Infolists;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use Illuminate\Contracts\Pagination\Paginator;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserPerusahaanResource extends Resource
{
    protected static ?string $model = Perusahaan::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'User Perusahaan';

    protected static ?string $pluralLabel = 'User Perusahaan';

    protected static ?int $navigationSort = 3;

    protected static ?string $cluster = Kemitraan::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('user.profile_photo_path')
                    ->circular()
                    ->label('Avatar')
                    ->getStateUsing(function (Model $record) {
                        if ($record->user->profile_photo_path) {
                            $thumb = $record->user->profile_photo_path;
                            return $thumb;
                        }
                        return asset('https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png');
                    }),
                TextColumn::make('user.name')
                    ->wrap()
                    ->label('Pelaku Usaha')
                    ->searchable(),
                TextColumn::make('nama_perusahaan')
                    ->wrap()
                    ->color('primary')
                    ->label('Nama Perusahaan')
                    ->searchable(),
                TextColumn::make('user.email')
                    ->label('Email')
                    ->copyable()
                    ->tooltip('klik untuk menyalin email')
                    ->icon('heroicon-s-envelope')
                    ->searchable(),
                TextColumn::make('user.no_hp')
                    ->label('No. Telepon')
                    ->icon('heroicon-m-phone')
                    ->searchable(),
                TextColumn::make('user.jabatan')
                    ->label('Jabatan')
                    ->wrap()
                    ->searchable(),

                TextColumn::make('jenis_usaha')
                    ->label('Jenis Usaha')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->wrap()
                    ->searchable(),
                TextColumn::make('alamat_perusahaan')
                    ->label('Alamat Perusahaan')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->wrap()
                    ->searchable(),
                TextColumn::make('nib')
                    ->label('NIB')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->wrap()
                    ->searchable(),
                TextColumn::make('negara_asal')
                    ->label('Negara Asal')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->wrap()
                    ->searchable(),
                TextColumn::make('induk_perusahaan')
                    ->label('Induk Perusahaan')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->wrap()
                    ->searchable(),
                TextColumn::make('telepon_perusahaan')
                    ->label('Telepon Perusahaan')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->wrap()
                    ->searchable(),
                TextColumn::make('nama_pimpinan')
                    ->label('Nama Pimpinan')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->wrap()
                    ->searchable(),
                TextColumn::make('telepon_pimpinan')
                    ->label('Telepon Pimpinan')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->wrap()
                    ->searchable(),
                TextColumn::make('alamat_pimpinan')
                    ->label('Alamat Pimpinan')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->wrap()
                    ->searchable(),

            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make('table')
                        ->fromTable()
                        ->withChunkSize(1000)
                        ->askForFilename()
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX),
                ])
                    ->button()
                    ->color('success')
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ])
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Foto Profil')
                    ->icon('heroicon-o-photo')
                    ->collapsible()
                    ->schema([
                        Infolists\Components\ImageEntry::make('user.profile_photo_path')->hiddenLabel()
                            ->circular()->grow()
                            ->alignCenter()
                            ->getStateUsing(function (Model $record) {
                                if ($record->user->profile_photo_path) {
                                    $thumb = $record->user->profile_photo_path;
                                    return $thumb;
                                }
                                return asset('https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png');
                            }),
                    ]),
                Section::make('Informasi Pelaku Usaha')
                    ->icon('heroicon-o-user')
                    ->collapsible()
                    ->schema([
                        Grid::make()->schema([
                            Infolists\Components\TextEntry::make('user.name')->label('Pelaku Usaha :')->inlineLabel(),
                            Infolists\Components\TextEntry::make('user.email')->label('Email :')->inlineLabel(),
                            Infolists\Components\TextEntry::make('user.no_hp')->label('No. Telepon :')->inlineLabel(),
                            Infolists\Components\TextEntry::make('user.jabatan')->label('Jabatan :')->inlineLabel(),
                        ]),
                    ]),
                Section::make('Informasi Perusahaan')
                    ->icon('heroicon-o-building-office-2')
                    ->schema([
                        Infolists\Components\TextEntry::make('nama_perusahaan')->label('Nama Perusahaan :')->inlineLabel(),
                        Infolists\Components\TextEntry::make('jenis_usaha')->label('Jenis Usaha :')->inlineLabel(),
                        Infolists\Components\TextEntry::make('alamat_perusahaan')->label('Alamat Perusahaan :')->inlineLabel(),
                        Infolists\Components\TextEntry::make('nib')->label('NIB :')->inlineLabel(),
                        Infolists\Components\TextEntry::make('negara_asal')->label('Asal Negara :')->inlineLabel(),
                        Infolists\Components\TextEntry::make('induk_perusahaan')->label('Induk Perusahaan :')->inlineLabel(),
                        Infolists\Components\TextEntry::make('telepon_perusahaan')->label('Telepon Perusahaan :')->inlineLabel(),
                        Infolists\Components\TextEntry::make('nama_pimpinan')->label('Nama Pimpinan :')->inlineLabel(),
                        Infolists\Components\TextEntry::make('telepon_pimpinan')->label('Telepon Pimpinan :')->inlineLabel(),
                        Infolists\Components\TextEntry::make('alamat_pimpinan')->label('Alamat Pimpinan :')->inlineLabel(),
                    ])->columns(2)
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PerusahaanRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserPerusahaans::route('/'),
            'create' => Pages\CreateUserPerusahaan::route('/create'),
            'view' => Pages\ViewUserPerusahaan::route('/{record}'),
            'edit' => Pages\EditUserPerusahaan::route('/{record}/edit'),
        ];
    }
}
