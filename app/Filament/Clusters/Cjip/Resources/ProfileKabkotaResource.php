<?php

namespace App\Filament\Clusters\Cjip\Resources;

use App\Filament\Clusters\Cjip;
use App\Filament\Clusters\Cjip\Resources\ProfileKabkotaResource\Pages;
use App\Filament\Clusters\Cjip\Resources\ProfileKabkotaResource\RelationManagers;
use App\Models\Cjip\ProfileKabkota;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ProfileKabkotaResource extends Resource
{
    use Translatable;
    protected static ?string $model = ProfileKabkota::class;

    protected static ?string $navigationGroup = 'Cjip';

    protected static ?string $navigationLabel = 'Profil Kabupaten/Kota';

    protected static ?int $navigationSort = 3;

    protected static ?string $pluralLabel = 'Profil Kabupaten/Kota';

    protected static ?string $cluster = Cjip::class;

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('profil')->label('Nama Kabupaten/Kota'),
                    RichEditor::make('desc_profil')->label('Deskripsi Profil')
                        ->toolbarButtons([
                            'attachFiles',
                            'blockquote',
                            'bold',
                            'bulletList',
                            'codeBlock',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'undo',
                        ]),
                    FileUpload::make('foto')->disk('public')->directory('profil/foto')
                        ->enableOpen()
                        ->enableDownload(),
                    FileUpload::make('icon')->disk('public')->directory('profil/icon')
                        ->enableOpen()
                        ->enableDownload(),

                    Grid::make([
                        'sm' => 2,
                        'md' => 3,
                        'xl' => 5,
                    ])
                        ->schema([
                            // ...
                            TextInput::make('luas')->label('Luas Kabupaten/Kota'),
                            TextInput::make('jarak_ke_smg')->label('Jarak Ke Semarang')->suffix('KM'),
                            TextInput::make('pert_ekonomi')->label('Pert Ekonomi'),
                            TextInput::make('inflasi')->label('Inflasi')->suffix('%'),
                            TextInput::make('populasi')->label('Populasi')->suffix('jiwa'),
                            TextInput::make('angka_kerja')->label('Angka Kerja')->suffix('jiwa'),
                            TextInput::make('umr')->label('UMR'),
                            TextInput::make('komp_usia')->label('Komp Usia'),
                            Select::make('tahun')
                                ->options(function () {
                                    $years = range(Carbon::now()->year, Carbon::now()->subYear(5)->year);
                                    return array_combine($years, $years);
                                })
                                ->default(Carbon::now()->year),
                            Toggle::make('status')
                                ->onIcon('heroicon-s-check')
                                ->offIcon('heroicon-s-x-circle')->inlineLabel(),
                        ]),
                    TextInput::make('rtrw')->label('RTRW'),
                    TextInput::make('grdp')->label('GRDP'),


                    Forms\Components\BelongsToSelect::make('kab_kota_id')
                        ->searchable()
                        ->relationship('kabkota', 'nama')

                        ->hidden(function () {
                            if (Auth::user()->hasRole('kabkota')) {
                                return true;
                            }
                            return false;
                        }),
                    Tabs::make('Heading')
                        ->tabs([
                            Tabs\Tab::make('Infrastruktur')
                                ->icon('heroicon-o-chevron-right')
                                ->schema([
                                    Repeater::make('infrastruktur')->label('infrastruktur')->schema([
                                        TextInput::make('infrastruktur')
                                    ]),
                                ]),
                            Tabs\Tab::make('Proyek Kerja Sama')
                                ->icon('heroicon-o-chevron-right')
                                ->schema([
                                    Repeater::make('proyek_kerja_sama')->label('Proyek Kerja Sama')->schema([
                                        Grid::make()->schema([
                                            TextInput::make('nama')->label('Nama Proyek'),
                                            TextInput::make('skema')->label('Skema Investasi'),
                                            TextInput::make('nilai')->label('Nilai Investasi'),
                                        ])->columns(3)
                                    ]),
                                ]),
                            Tabs\Tab::make('Proyek Investasi')
                                ->icon('heroicon-o-chevron-right') // Optional icon
                                ->schema([
                                    Repeater::make('proyek_investasi')->label('Proyek Investasi')->schema([
                                        Grid::make()->schema([
                                            TextInput::make('nama')->label('Nama Proyek'),
                                            TextInput::make('skema')->label('Nama Perusahaan'),
                                            TextInput::make('nilai')->label('Nilai Investasi'),
                                        ])->columns(3)
                                    ]),
                                ]),
                        ])
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')->label('Foto'),
                TextColumn::make('profil')->label('Nama Kabupaten/Kota')
                    ->wrap()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('desc_profil')->label('Deskripsi Kabupaten/Kota')
                    ->wrap()
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->limit(250),
                TextColumn::make('umr')->label('UMR')
                    ->wrap()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('populasi')->label('Populasi Jiwa')
                    ->wrap()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('inflasi')->label('Inflasi')->wrap()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('angka_kerja')->label('Angka Kerja')
                    ->wrap()
                    ->searchable()
                    ->sortable(),
                BooleanColumn::make('status')
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                SelectFilter::make('kab_kota_id')->relationship('kabkota', 'nama')->searchable()->label('Kabupaten/Kota')
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
            'index' => Pages\ListProfileKabkotas::route('/'),
            'create' => Pages\CreateProfileKabkota::route('/create'),
            'edit' => Pages\EditProfileKabkota::route('/{record}/edit'),
        ];
    }
}
