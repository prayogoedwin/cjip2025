<?php

namespace App\Filament\Clusters\CJIP\Resources;

use App\Filament\Clusters\CJIP;
use App\Filament\Clusters\CJIP\Resources\KawasanIndustriResource\Pages;
use App\Filament\Clusters\CJIP\Resources\KawasanIndustriResource\RelationManagers;
use App\Models\Cjip\KawasanIndustri;
use Carbon\Carbon;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class KawasanIndustriResource extends Resource
{
    protected static ?string $model = KawasanIndustri::class;

    use Translatable;

    protected static ?string $navigationGroup = 'CJIP';

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $navigationLabel = 'Kawasan Industri';

    protected static ?string $pluralLabel = 'Kawasan Industri';
    protected static ?string $cluster = CJIP::class;

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('nama')->label('Nama Kawasan Industri')->required()->placeholder('Nama Lengkap Kawasan Industri'),
                    Section::make('Profil')->label('Profil')->schema([
                        TiptapEditor::make('perusahaan')
                            ->label('Profil Perusahaan')
                            ->columnSpan('full')
                            ->profile('default')
                            ->disk('public')
                            ->directory('kawasan/content')
                            ->maxContentWidth('5xl'),
                        TiptapEditor::make('kawasan')
                            ->label('Profil Kawasan')
                            ->columnSpan('full')
                            ->profile('default')
                            ->disk('public')
                            ->directory('kawasan/content')
                            ->maxContentWidth('5xl'),
                    ]),

                    FileUpload::make('foto')
                        ->disk('public')
                        ->directory('kawasan/foto')
                        ->image()
                        ->maxSize(2048)
                        ->hint('foto auto cropping rasio 16:9')
                        ->imageCropAspectRatio('16:9')
                        ->helperText('*Isikan Maksimal 5 Foto dan Ukuran File Maksimal 2 Mb.')
                        ->multiple()
                        ->enableOpen()
                        ->enableDownload(),

                    Card::make()->schema([
                        Grid::make()->schema([
                            Forms\Components\TextInput::make('lat')
                                ->label('Latitude')
                                ->hint('*dapat dicopy melalui google maps')
                                ->placeholder('Contoh : -7.1412881385063045')
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
                                ->hint('*dapat dicopy melalui google maps')
                                ->placeholder('Contoh : 110.12790849008296')
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
                    Section::make('Masterplan')->label('Masterplan')->schema([
                        Card::make()->schema([
                            RichEditor::make('masterplan')->label('Masterplan')
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
                            FileUpload::make('image_masterplan')->directory('kawasan/masterplan/' . Auth::user()->name . '/' . Carbon::now()->year),
                        ]),

                    ]),

                    Section::make('Produk')->label('Produk')
                        ->schema([
                            Card::make()->schema([
                                RichEditor::make('produk')->label('Produk')
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
                                FileUpload::make('image_produk')->label('Gambar Produk')->directory('kawasan/produk/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),

                            Card::make()->schema([
                                RichEditor::make('lahan_siap_bangun')->label('Lahan Siap Bangun')
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
                                FileUpload::make('image_lahan_siap_bangun')->label('Gambar Lahan Siap Bangun')->directory('kawasan/lahan/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ])->columns(1),

                            Card::make()->schema([
                                RichEditor::make('bangun_pabrik_siap_pakai')->label('Bangun Pabrik Siap Pakai')
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
                                FileUpload::make('image_pabrik_siap_pakai')->label('Gambar Bangun Pabrik Siap Pakai')->directory('kawasan/pabrik/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),

                            Card::make()->schema([
                                RichEditor::make('produk_lainnya')->label('Produk Lainnya')
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
                                FileUpload::make('image_produk_lainnya')->label('Gambar Produk Lainnya')->directory('kawasan/produk/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ])
                        ]),

                    Section::make('Infrastruktur Industri')->label('Insfrastruktur Industri')
                        ->schema([

                            Card::make()->schema([
                                RichEditor::make('jaringan_energi_listrik')->label('Jaringan Energi Dan Kelistrikan')
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
                                FileUpload::make('image_jaringan_energi_listrik')->label('Gambar Kelistrikan')->directory('kawasan/kelistrikan/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),

                            Card::make()->schema([
                                RichEditor::make('jaringan_telekomunikasi')->label('Jaringan Telekomunikasi')
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
                                FileUpload::make('image_jaringan_telekomunikasi')->label('Gambar Telekomunikasi')->directory('kawasan/telekomunikasi/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),

                            Card::make()->schema([
                                RichEditor::make('jaringan_sda')->label('Jaringan Sumber Daya Air & Jaringan Posokan Air')
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
                                FileUpload::make('image_sda')->label('Gambar Jaringan SDA & JPA')->directory('kawasan/sda/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),

                            Card::make()->schema([
                                RichEditor::make('sanitasi')->label('Sanitasi')
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
                                FileUpload::make('image_sanitasi')->label('Gambar Sanitasi')->directory('kawasan/sanitasi/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),
                            Card::make()->schema([
                                RichEditor::make('jaringan_transportasi')->label('Jaringan Transportasi')
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
                                FileUpload::make('image_transportasi')->label('Gambar Transportasi')->directory('kawasan/transportasi/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ])
                        ]),

                    Section::make('Infrastruktur Penunjang')->label('Infrastruktur Penunjang')
                        ->schema([

                            Card::make()->schema([
                                RichEditor::make('perumahan')->label('Perumahan')
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
                                FileUpload::make('image_perumahan')->label('Gambar Perumahan')->directory('kawasana/perumahan/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),

                            Card::make()->schema([
                                RichEditor::make('pendidikan_pelatihan')->label('Pendidikan dan Pelatihan')
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
                                FileUpload::make('image_pendidikan_pelatihan')->label('Gambar Pendidikan dan Pelatihan')->directory('kawasan/pendidikan/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),

                            Card::make()->schema([
                                RichEditor::make('penelitian_pengembangan')->label('Penelitian dan Pengembangan')
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
                                FileUpload::make('image_penelitian_pengembangan')->label('Gambar Penelitian dan Pengembangan')->directory('kawasan/penelitian/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),

                            Card::make()->schema([
                                RichEditor::make('kesehatan')->label('Kesehatan')
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
                                FileUpload::make('image_kesehatan')->label('Gambar Kesehatan')->directory('kawasan/kesehatan/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),

                            Card::make()->schema([
                                RichEditor::make('pemadam_kebakaran')->label('Pemadaman Kebakaran')
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
                                FileUpload::make('image_pemadam_kebakaran')->label('Gambar Pemadam Kebakaran')->directory('kawasan/kebakaran/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),

                            Card::make()->schema([
                                RichEditor::make('tempat_pembuangan_sampah')->label('Tempat Pembuangan Sampah')
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
                                FileUpload::make('image_sampah')->label('Gambar Tempat Pembuangan Sampah')->directory('kawasan/sampah/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),
                        ]),

                    Section::make('Infrastruktur Dasar')->label('Infrastruktur Dasar')
                        ->schema([
                            Card::make()->schema([
                                RichEditor::make('instalasi_pengelolaan_air_baku')->label('Instalasi Pengelolaan Air Baku')
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
                                FileUpload::make('image_instalasi_pengelolaan_air_baku')->label('Gambar Pengelolaan Air Baku')->directory('kawasan/airbaku/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),

                            Card::make()->schema([
                                RichEditor::make('instalasi_pengelolaan_air_limbah')->label('Instalasi Pengelolaan Air Limbah')
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
                                FileUpload::make('image_instalasi_pengelolaan_air_limbah')->label('Gambar Pengelolaan Air Limbah')->directory('kawasan/airlimbah/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),

                            Card::make()->schema([
                                RichEditor::make('saluran_drainase')->label('Saluran Drainase')
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
                                FileUpload::make('image_saluran_drainase')->label('Gambar Saluran Drainase')->directory('kawasan/drainase/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),

                            Card::make()->schema([
                                RichEditor::make('instalasi_penerangan_jalan')->label('Instalasi Penerangan jalan')
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
                                FileUpload::make('image_instalasi_penerangan_jalan')->label('Gambar Penerangan Jalan')->directory('kawasan/penerangan/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),

                            Card::make()->schema([
                                RichEditor::make('jaringan_jalan')->label('Jaringan Jalan')
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
                                FileUpload::make('image_jaringan_jalan')->label('Gambar Jaringan Jalan')->directory('kawasan/jaringan/' . Auth::user()->name . '/' . Carbon::now()->year),
                            ]),
                        ]),

                    Section::make('Fasilitas Lainnya')->label('Fasilitas Lainnya')->schema([
                        Card::make()->schema([
                            RichEditor::make('fasilitas')->label('Fasilitas Lain')
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
                            FileUpload::make('image_fasilitas_lain')->label('Gambar Fasilitas Lainnya')->directory('kawasan/lainnya/' . Auth::user()->name . '/' . Carbon::now()->year),
                        ]),
                    ]),

                    Repeater::make('tenant')
                        ->schema([
                            Grid::make()->schema([
                                TextInput::make('nama')->label('Tenant'),
                                TextInput::make('sektor')->label('Sektor'),
                                TextInput::make('jenis_usaha')->label('Jenis Usaha'),
                                TextInput::make('negara')->label('Negara')
                            ])->columns(4)
                        ]),

                    Grid::make()->schema([
                        TextInput::make('url_video')->label('URL Video')->prefix('https://'),
                        TextInput::make('url_website')->label('URL Website')->prefix('https://'),

                        // BelongsToSelect::make('user_id')->relationship('createdBy', 'name')->label('User Id'),
                        Hidden::make('user_id')->default(auth()->id()),


                        // Toggle::make('status')->inline()
                        Hidden::make('kawasan_id')->default(auth()->user()->user_kawasan_id),

                    ])->columns(2),
                    BelongsToSelect::make('jenis_kawasan_id')->relationship('jeniskawasan', 'nama')->label('Jenis Kawasan Industri'),
                    Select::make('status')->options([
                        0 => 'UNPUBLISH',
                        null => 'REVIEWING',
                        1 => 'PUBLISHED',
                    ])
                        ->default(null)
                        ->visible(function () {
                            if (auth()->user()->hasRole('admin_ki')) {
                                return false;
                            }
                            return true;
                        }),

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    ImageColumn::make('foto')->label('Foto')->square()->size(80)->grow(false)
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
                    Stack::make([
                        Split::make([
                            TextColumn::make('nama')->wrap()->label('Nama Kawasan Industri')
                                ->searchable()->sortable()
                                ->extraAttributes([
                                    'class' => 'text-gray-500 dark:text-gray-300 text-md font-bold'
                                ]),
                            BadgeColumn::make('status')
                                ->alignRight()
                                // ->enum([
                                //     '1' => 'Published',
                                //     '0' => 'UnPublished',
                                //     null => 'Review',
                                // ])
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
                                ])
                        ]),
                        TextColumn::make('perusahaan')->wrap()->label('Profil Perusahaan')
                            ->html()
                            ->wrap()
                            ->alignJustify()
                            ->size('sm')
                            ->limit(200),
                        // ->extraAttributes([
                        //     'class' => 'text-gray-300 dark:text-gray-200 text-xs text-justify'
                        // ]),
                        TextColumn::make('jeniskawasan.nama')->wrap()->label('Jenis Kawasan Industri')->sortable()
                            ->icon('heroicon-s-information-circle')
                            ->extraAttributes([
                                'class' => 'text-primary-500 dark:text-primary-500 text-xs font-semibold italic'
                            ])->color('primary'),
                        TextColumn::make('updated_at')->date()->wrap()->label('Jenis Kawasan Industri')->sortable()
                            ->icon('heroicon-s-calendar')
                            ->extraAttributes([
                                'class' => 'italic text-xs'
                            ]),
                    ])->space(2)
                ]),
            ])
            ->filters([
                Filter::make('published')->label('Published')
                    ->query(fn(Builder $query): Builder => $query->where('status', 1)),
                Filter::make('unpublished')->label('UnPublished')
                    ->query(fn(Builder $query): Builder => $query->where('status', 0)),
                Filter::make('review')->label('Review')
                    ->query(fn(Builder $query): Builder => $query->where('status', null)),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ])
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
            'index' => Pages\ListKawasanIndustris::route('/'),
            'create' => Pages\CreateKawasanIndustri::route('/create'),
            'view' => Pages\ViewKawasanIndustri::route('/{record}'),
            'edit' => Pages\EditKawasanIndustri::route('/{record}/edit'),
        ];
    }
}
