<?php

namespace App\Filament\Resources\Pengguna;

use App\Filament\Resources\Pengguna\UserResource\Pages;
use App\Filament\Resources\Pengguna\UserResource\Pages\CreateUser;
use App\Filament\Resources\Pengguna\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationGroup = 'Super Admin';

    protected static ?int $navigationSort = -2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Foto Profil')
                    ->icon('heroicon-o-photo')
                    ->collapsed()
                    ->collapsible()
                    ->schema([
                        FileUpload::make('profile_photo_path')
                            ->avatar()
                            ->alignCenter()
                            ->enableOpen()
                            ->enableDownload()
                            ->disk('public')
                            ->directory('User/Photo'),
                    ]),
                Forms\Components\Section::make('Profil')
                    ->icon('heroicon-o-user')
                    ->collapsible()
                    ->schema([
                        Grid::make()->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->label('Nama Lengkap')
                                ->placeholder('Tuliskan Nama Lengkap')
                                ->reactive(),
                            Forms\Components\TextInput::make('nip')
                                ->hint('Jika kosong isikan (-)')
                                ->required()
                                ->placeholder('31123456XXXXXX')
                                ->label('Nik/Nip')
                                ->maxLength(20)
                                ->reactive(),
                            Forms\Components\TextInput::make('jabatan')
                                ->hint('Jika kosong isikan (-)')
                                ->placeholder('Tuliskan Jabatan')
                                ->required()
                                ->reactive(),
                        ])->columns(3),
                        Grid::make()->schema([
                            Forms\Components\TextInput::make('no_hp')
                                ->required()
                                ->placeholder('081234XXXXX')
                                ->label('No. Telp')
                                ->numeric()
                                ->reactive(),
                            Forms\Components\TextInput::make('email')
                                ->placeholder('example@gmail.com')
                                ->required()
                                ->email()
                                ->unique(User::class, 'email', fn($record) => $record),
                        ])->columns(2),
                        Forms\Components\Toggle::make('reset_password')
                            ->columnSpan('full')
                            ->reactive()
                            ->dehydrated(false)
                            ->hiddenOn('create'),
                        TextInput::make('password')
                            ->columnSpan('full')
                            ->visible(fn($livewire, $get) => $livewire instanceof CreateUser || $get('reset_password') == true)
                            ->rules(config('filament-breezy.password_rules', 'max:25'))
                            ->required()
                            ->default('admin123')
                            ->helperText('Default Password : admin123')
                            // ->helperText('maximum 8 characters')
                            ->dehydrateStateUsing(function ($state) {
                                return Hash::make($state);
                            }),
                        Grid::make()->schema([
                            Select::make('role_id')
                                ->multiple()
                                ->relationship('roles', 'name')
                                ->preload(),
                            Grid::make()->schema([
                                Toggle::make('is_kawasan')
                                    ->onIcon('heroicon-o-building-office')
                                    ->label('Jika User Kawasan')
                                    ->reactive(),
                                Toggle::make('is_kabkota')
                                    ->onIcon('heroicon-o-building-library')
                                    ->label('PIC Kabupaten/Kota')
                                    ->reactive(),
                            ])->columns(4),
                            Select::make('user_kawasan_id')
                                ->label('Kawasan Industri')
                                ->relationship('userkawasan', 'nama')
                                ->searchable()
                                ->preload()
                                ->visible(function (\Filament\Forms\Get $get) {
                                    if ($get('is_kawasan')) {
                                        return true;
                                    }
                                    return false;
                                })
                                ->required(function ($get) {
                                    //dd($get);
                                    if ($get('is_kawasan') === '1' or $get('is_kawasan') === 1) {
                                        return true;
                                    }
                                    return false;
                                }),

                            Select::make('kabkota')
                                ->label('Kab/ Kota')
                                ->relationship('kabkota', 'nama')
                                ->preload()
                                ->searchable()
                                ->visible(function (\Filament\Forms\Get $get) {
                                    if ($get('is_kabkota')) {
                                        return true;
                                    }
                                    return false;
                                }),
                        ])->columns(1)
                    ])->columns(['md' => 1]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_photo_path')
                    ->label('Avatar')->grow(false)->circular()->size(50)
                    ->getStateUsing(function (Model $record) {
                        if ($record->profile_photo_path) {
                            $thumb = $record->profile_photo_path;
                            return $thumb;
                        }
                        return asset('https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png');
                    }),
                Tables\Columns\TextColumn::make('name')->searchable()->extraAttributes([
                    'class' => 'mt-2 text-grey-300 dark:text-grey-300 text-md'
                ]),
                Tables\Columns\TextColumn::make('nip')
                    ->label('Nik/Nip')
                    ->searchable()
                    ->extraAttributes([
                        'class' => 'mt-2 text-grey-300 dark:text-grey-300 text-md'
                    ]),
                Tables\Columns\TextColumn::make('email')
                    ->copyable()
                    ->icon('heroicon-m-envelope')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('kabkota.nama')
                    ->searchable()
                    ->toggleable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('userkawasan.nama')
                    ->label('Kawasan Industri')
                    ->searchable()
                    ->toggleable()
                    ->wrap(),
                Tables\Columns\TagsColumn::make('roles.name')->searchable()
                    ->extraAttributes([
                        'class' => 'mt-2 text-grey-300 dark:text-grey-300 text-xs text-justify'
                    ]),
            ])->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('roles_id')->label('Roles')->relationship('roles', 'name'),
                SelectFilter::make('user_kawasan_id')->label('User Kawasan')->relationship('userkawasan', 'nama'),
                SelectFilter::make('kabkota_id')->label('Kabupaten/Kota')->relationship('kabkota', 'nama'),
            ])
            ->actions([
                Impersonate::make(), // <--- 
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
