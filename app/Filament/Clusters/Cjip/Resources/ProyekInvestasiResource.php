<?php

namespace App\Filament\Clusters\Cjip\Resources;

use App\Filament\Clusters\Cjip;
use App\Filament\Clusters\Cjip\Resources\ProyekInvestasiResource\Pages;
use App\Filament\Clusters\Cjip\Resources\ProyekInvestasiResource\RelationManagers;
use App\Models\Cjip\ProyekInvestasi;
use Carbon\Carbon;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid as ComponentsGrid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ProyekInvestasiResource extends Resource
{
    use Translatable;
    protected static ?string $model = ProyekInvestasi::class;

    protected static ?string $navigationGroup = 'Cjip';

    protected static ?string $recordTitleAttribute = 'nama';

    // protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Proyek Investasi';

    protected static ?string $pluralLabel = 'Proyek Investasi';
    protected static ?string $cluster = Cjip::class;

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ComponentsGrid::make()->schema([
                    Tabs::make('Proyek')
                        ->tabs([
                            Tabs\Tab::make('Latar Belakang')
                                ->schema([
                                    TextInput::make('nama')->label('Nama Proyek')->required(),
                                    TiptapEditor::make('latar_belakang')->label('Latar Belakang')
                                        ->columnSpan('full')
                                        ->profile('default')
                                        ->disk('public')
                                        ->directory('proyek/content')
                                        ->maxContentWidth('5xl'),
                                    RichEditor::make('eksisting')
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
                                ]),
                            Tabs\Tab::make('Lokasi')
                                ->schema([
                                    TextInput::make('luas_lahan')->label('Luas Lahan'),
                                    RichEditor::make('desc_luas_lahan')->label('Deskripsi Luas Lahan')
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

                                    ComponentsGrid::make()->schema([
                                        Forms\Components\TextInput::make('lat')
                                            ->label('Latitude')
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                                $set('location', [
                                                    'lat' => floatVal($state),
                                                    'lng' => floatVal($get('lng')),
                                                ]);
                                            })
                                            ->lazy(),
                                        Forms\Components\TextInput::make('lng')
                                            ->label('Longitude')
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                                $set('location', [
                                                    'lat' => floatval($get('lat')),
                                                    'lng' => floatVal($state),
                                                ]);
                                            })->lazy(),
                                    ])->columns(2),

                                    Map::make('location')
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                            $set('lat', $state['lat']);
                                            $set('lng', $state['lng']);
                                        })
                                        ->mapControls([
                                            'mapTypeControl' => true,
                                            'scaleControl' => true,
                                            'streetViewControl' => true,
                                            'rotateControl' => true,
                                            'fullscreenControl' => true,
                                            'searchBoxControl' => false,
                                            // creates geocomplete field inside map
                                            'zoomControl' => true,
                                        ])
                                        ->height(fn() => '450px')
                                        ->defaultZoom(15) // default zoom level when opening form
                                        ->autocomplete('full_address')
                                        ->autocompleteReverse(true)
                                        ->reverseGeocode([
                                            'street' => '%n %S',
                                            'city' => '%L',
                                            'state' => '%A1',
                                            'zip' => '%z',
                                        ]) // reverse geocode marker location to form fields, see notes below
                                        ->debug() // prints reverse geocode format strings to the debug console
                                        ->defaultLocation([-6.995016, 110.418427]) // default for new forms
                                        ->draggable() // allow dragging to move marker
                                        ->clickable(true) // allow clicking to move marker
                                        ->geolocate()
                                        ->geolocateLabel('Get Location'),


                                ]),
                            Tabs\Tab::make('Detail')
                                ->schema([
                                    RichEditor::make('sumber_air')->label('Sumber Air')
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
                                    RichEditor::make('kelistrikan')->label('Kelistrikan')
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
                                    RichEditor::make('telekomunikasi')->label('Telekomunikasi')
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
                                    RichEditor::make('status_kepemilikan')->label('Status Kepemilikan')
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
                                    RichEditor::make('lingkup_pekerjaan')->label('Lingkup Pekerjaan')
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
                                    RichEditor::make('ketersediaan_pasar')->label('Ketersediaan Pasar')
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
                                    RichEditor::make('ketersediaan_sd')->label('Ketersediaan Sumber Daya')
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
                                    RichEditor::make('desain_layout_proyek')->label('Desain Layout Proyek')
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
                                ]),
                            Tabs\Tab::make('Investasi')
                                ->schema([
                                    RichEditor::make('rincian_investasi')->label('Rincian Investasi')
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
                                    RichEditor::make('skema_investasi')->label('Skema Investasi')
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
                                    TextInput::make('nilai_investasi')->label('Nilai Investasi'),
                                    TextInput::make('npv')->label('NPV'),
                                    TextInput::make('irr')->label('IRR'),
                                    TextInput::make('bc_ratio')->label('Bc Ratio'),
                                    TextInput::make('playback_period')->label('Payback Period'),
                                ]),
                            Tabs\Tab::make('Kontak')
                                ->schema([
                                    ComponentsGrid::make()->schema([
                                        TextInput::make('cp_nama')->label('CP Nama'),
                                        TextInput::make('cp_email')->label('CP Email')->email(),
                                        TextInput::make('cp_hp')->label('CP No. Hp')->tel()->maxLength(13)
                                    ])->columns(3),
                                    Textarea::make('cp_alamat')->label('CP Alamat'),
                                ]),
                            Tabs\Tab::make('File')
                                ->schema([
                                    FileUpload::make('foto')
                                        ->disk('public')
                                        ->directory('proyek/foto')
                                        ->image()
                                        ->maxSize(2048)
                                        ->hint('foto auto cropping rasio 16:9')
                                        ->imageCropAspectRatio('16:9')
                                        ->helperText('*Isikan Maksimal 5 Foto dan Ukuran File Maksimal 2 Mb.')
                                        ->multiple()
                                        ->enableOpen()
                                        ->enableDownload(),
                                    FileUpload::make('file_kajian')->label('File Kajian')->hint('.pdf')->directory('file kajian/' . Auth::user()->name . '/' . Carbon::now()->year)->acceptedFileTypes(['application/pdf']),
                                    FileUpload::make('file_keuangan')->label('File Keuangan')->hint('.xls')->directory('file keuangan/' . Auth::user()->name . '/' . Carbon::now()->year),
                                ]),
                            Tabs\Tab::make('Select')
                                ->schema([
                                    Hidden::make('user_id')->default(auth()->id()),
                                    Forms\Components\Select::make('kab_kota_id')->label('Kabupaten/Kota')->default(function () {
                                        if (auth()->user()->hasRole('admin_cjip')) {
                                            return auth()->user()->kabkota->id;
                                        }
                                        return null;
                                    })->relationship('kabKota', 'nama')->searchable(),
                                    Forms\Components\Select::make('market_id')->label('Market')->relationship('market', 'nama'),
                                    Forms\Components\Select::make('sektor_id')->label('Sektor')->relationship('sektor', 'nama'),
                                    // 
                                    Select::make('status')->options([
                                        0 => 'UNPUBLISH',
                                        null => 'REVIEWING',
                                        1 => 'PUBLISHED',
                                    ])
                                        ->default(null)
                                        ->visible(function () {
                                            if (auth()->user()->hasRole('admin_cjip')) {
                                                return false;
                                            }
                                            return true;
                                        }),
                                ])
                        ])->activeTab(1),
                ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                Split::make([
                    Grid::make()->schema([
                        ImageColumn::make('foto')
                            ->getStateUsing(function (Model $record) {
                                if ($record->foto) {
                                    $thumb = $record->foto;
                                    return $thumb[0];
                                }
                                return asset('images/no_image.jpg');
                            })
                            ->height('150px')
                            ->width('250px')
                            ->extraImgAttributes([
                                'class' => 'object-cover h-cover rounded-xl w-full',
                            ]),
                    ])->columns(1)->grow(false),
                    Stack::make([
                        Split::make([
                            TextColumn::make('nama')->wrap()->sortable()
                                ->searchable()
                                ->grow(false)
                                ->extraAttributes([
                                    'class' => 'mt-2 text-gray-500 dark:text-gray-300 text-md font-bold'
                                ]),
                            TextColumn::make('status')
                                ->alignRight()
                                ->badge()
                                ->formatStateUsing(function ($state) {
                                    return match ($state) {
                                        1 => 'Published',
                                        0 => 'UnPublished',
                                        null => 'Review',
                                        default => 'Unknown',
                                    };
                                })
                                ->colors([
                                    'success' => 1,
                                    'danger' => 0,
                                    'warning' => null,
                                ])
                                ->icons([
                                    'heroicon-s-check-circle' => 1,
                                    'heroicon-s-x-circle' => 0,
                                    'heroicon-s-document' => null,
                                ])
                                ->extraAttributes([
                                    'class' => 'mt-2 text-sm text-justify'
                                ]),
                        ]),
                        TextColumn::make('latar_belakang')
                            ->sortable()
                            ->html()
                            ->limit(100)
                            ->extraAttributes([
                                'class' => 'mt-2 text-gray-500 dark:text-gray-300 text-xs text-justify'
                            ]),
                        TextColumn::make('nilai_investasi')->wrap()->sortable()->searchable()->color('primary')
                            ->icon('heroicon-s-banknotes')->iconPosition('before')
                            ->extraAttributes([
                                'class' => 'mt-2 text-primary-500 dark:text-primary-500 text-xs text-justify'
                            ]),

                        Split::make([
                            TextColumn::make('kabKota.nama')->sortable()->searchable()
                                ->alignLeft()
                                ->icon('heroicon-s-building-library')->iconPosition('before')
                                ->grow()
                                ->extraAttributes([
                                    'class' => 'text-gray-500 dark:text-gray-300 text-xs'
                                ]),
                            TextColumn::make('updated_at')->wrap()->icon('heroicon-s-calendar')->iconPosition('before')
                                ->date()
                                ->alignRight()
                                ->label('Updated At')
                                ->sortable()
                                ->extraAttributes([
                                    'class' => 'text-gray-500 dark:text-gray-300 text-xs italic mt-1'
                                ]),
                        ]),
                        Split::make([
                            TextColumn::make('market.nama')
                                ->alignLeft()
                                ->icon('heroicon-s-shopping-cart')->iconPosition('before')
                                ->sortable()->searchable()
                                ->extraAttributes([
                                    'class' => 'text-gray-500 dark:text-gray-300 text-xs italic'
                                ]),
                            ToggleColumn::make(name: 'is_cjibf')
                                ->onIcon('heroicon-s-check-circle')
                                ->offIcon('heroicon-s-x-circle')
                                ->onColor('success')
                                ->label('CJIBF')
                                ->alignRight()
                                ->offColor('danger')
                                ->extraAttributes([
                                    'class' => 'dark:text-gray-300'
                                ])->visible(function () {
                                    if (auth()->user()->hasRole('admin_cjip')) {
                                        return false;
                                    }
                                    return true;
                                }),
                        ])

                    ]),

                ]),
                Panel::make([
                    Stack::make([
                        TextColumn::make('cp_nama')->wrap()->icon('heroicon-s-user')->limit(60)->iconPosition('before'),
                        TextColumn::make('cp_email')->wrap()->icon('heroicon-s-envelope')->iconPosition('before'),
                        TextColumn::make('cp_alamat')->wrap()->icon('heroicon-s-map-pin')->limit(200)->iconPosition('before'),
                        TextColumn::make('cp_hp')->wrap()->icon('heroicon-s-phone')->iconPosition('before'),
                    ])->space(2)
                        ->extraAttributes([
                            'class' => 'text-gray-500 dark:text-gray-300 text-xs text-left italic'
                        ]),
                ])->collapsible()
            ])
            ->filters([
                Filter::make('published')->label('Published')
                    ->query(fn(Builder $query): Builder => $query->where('status', 1)),
                Filter::make('unpublished')->label('UnPublished')
                    ->query(fn(Builder $query): Builder => $query->where('status', 0)),
                Filter::make('review')->label('Review')
                    ->query(fn(Builder $query): Builder => $query->where('status', null)),
                SelectFilter::make('kabkota')
                    ->label('Kabupaten/Kota')
                    ->searchable()
                    ->relationship('kabkota', 'nama')
                    ->visible(function () {
                        if (auth()->user()->hasRole('admin_cjip')) {
                            return false;
                        }
                        return true;
                    }),
                SelectFilter::make('market_id')
                    ->label('Market')
                    ->relationship('market', 'nama'),
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
            'index' => Pages\ListProyekInvestasis::route('/'),
            'create' => Pages\CreateProyekInvestasi::route('/create'),
            'edit' => Pages\EditProyekInvestasi::route('/{record}/edit'),
        ];
    }
}
