<?php

namespace App\Filament\Resources\Cjip;

use App\Filament\Clusters\CJIP;
use App\Filament\Resources\Cjip\BeritaResource\Pages;
use App\Filament\Resources\Cjip\BeritaResource\RelationManagers;
use App\Models\Cjip\Berita;
use App\Models\Cjip\Category;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\Layout\Grid as LayoutGrid;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Model;

class BeritaResource extends Resource
{
    use Translatable;
    protected static ?string $model = Berita::class;

    protected static ?string $navigationGroup = 'Cjip';

    protected static ?string $navigationLabel = 'Berita';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $pluralLabel = 'Berita';

    protected static ?string $cluster = CJIP::class;

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Hidden::make('author_id')->default(auth()->id()),
                    Hidden::make('kab_kota_id')->default(function () {
                        if (auth()->user()->hasRole('admin_cjip')) {
                            return auth()->user()->kabkota->id;
                        }
                        return null;
                    }),

                    Section::make('Content')->schema([
                        TextInput::make('title')
                            ->reactive()
                            ->required()
                            ->afterStateUpdated(function (\Filament\Forms\Set $set, $state) {
                                $set('slug', Str::slug($state));
                            }),
                        TiptapEditor::make('body')->label('Body')
                            ->columnSpan('full')
                            ->profile('default')
                            ->disk('public')
                            ->directory('berita/content')
                            ->extraInputAttributes(['style' => 'min-height: 12rem;'])
                            ->maxContentWidth('3xl'),
                        Textarea::make('excerpt')->hint('Small Description Of This Post'),
                    ])->columns(1),
                    Section::make('Seo Content')
                        ->schema([
                            Textarea::make('meta_description')->label('Meta Description'),
                            Textarea::make('meta_keyword')->label('Meta Keywords'),

                            TextInput::make('seo_title')->label('Seo Title'),
                        ])->columns(1)

                ])->columnSpan(2),

                Grid::make()->schema([
                    Section::make('Detail Post')
                        ->schema([
                            TextInput::make('slug')->label('Slug'),
                            Select::make('status')->options([
                                0 => 'DRAFT',
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
                            Select::make('category_id')
                                ->label('Categori')
                                ->options(Category::all()->pluck('name', 'id'))
                                ->searchable(),
                            Toggle::make('featured')->inline(),
                        ])->columns(1),

                    Section::make('Post Images')
                        ->schema([
                            FileUpload::make('image')
                                ->label('Image')
                                ->disk('public')
                                ->directory('berita/' . Carbon::now()->year)
                                ->image()
                                ->helperText('*Isikan Maksimal 5 Foto dan Ukuran File Maksimal 2 Mb.')
                                ->hint('foto auto cropping rasio 16:9')
                                ->multiple()
                                ->required()
                                ->maxSize(2048)
                                ->enableOpen()
                                ->enableReordering()
                                ->enableDownload()
                                ->imageCropAspectRatio('16:9')
                        ])->columns(1),
                ])->columnSpan(1)

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    LayoutGrid::make()->schema([
                        Tables\Columns\ImageColumn::make('image')
                            ->square()
                            ->getStateUsing(function (Model $record) {
                                if ($record->image) {
                                    $thumb = $record->image;
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
                        TextColumn::make('title')
                            ->searchable()
                            ->sortable()
                            ->extraAttributes([
                                'class' => 'mt-2 text-gray-500 dark:text-gray-300 text-md font-bold'
                            ]),
                        TextColumn::make('body')
                            ->searchable()
                            ->words(100)
                            // ->html()
                            ->formatStateUsing(fn(string $state) => strip_tags($state))
                            ->extraAttributes([
                                'class' => 'mt-2 text-gray-500 dark:text-gray-300 text-xs text-justify'
                            ]),
                        Split::make([
                            Stack::make([
                                TextColumn::make('created_at')->date()->color('primary')->sortable()
                                    ->extraAttributes([
                                        'class' => 'mt-2 text-primary-500 dark:text-primary-500 text-xs'
                                    ]),
                                TextColumn::make('kabkota.nama')->extraAttributes([
                                    'class' => 'mt-2 text-primary-500 dark:text-primary-500 text-xs italic'
                                ])
                            ]),
                            BadgeColumn::make('status')
                                ->formatStateUsing(fn(string $state): string => __("status.{$state}"))

                                ->colors([
                                    'secondary' => static fn($state): bool => $state === 0,
                                    'warning' => static fn($state): bool => $state === null,
                                    'success' => static fn($state): bool => $state === 1,
                                ])->alignRight()
                                ->extraAttributes([
                                    'class' => 'mt-2 text-gray-500 dark:text-gray-300 text-xs'
                                ]),
                        ])
                    ]),
                ])
            ])->defaultSort('updated_at', 'desc')
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
