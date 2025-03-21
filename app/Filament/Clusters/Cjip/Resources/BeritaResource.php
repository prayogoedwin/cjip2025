<?php

namespace App\Filament\Clusters\Cjip\Resources;

use App\Filament\Clusters\Cjip;
use App\Filament\Clusters\Cjip\Resources\BeritaResource\Pages;
use App\Filament\Clusters\Cjip\Resources\BeritaResource\RelationManagers;
use App\Models\Cjip\Berita;
use App\Models\Cjip\Category;
use Carbon\Carbon;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class BeritaResource extends Resource
{
    use Translatable;
    protected static ?string $model = Berita::class;

    protected static ?string $navigationGroup = 'Cjip';
    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $recordTitleAttribute = 'title';

    protected static ?int $navigationSort = 4;
    protected static ?string $pluralLabel = 'Berita';
    protected static ?string $cluster = Cjip::class;

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
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
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
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

                Section::make()->schema([
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
                                // ->image()
                                ->disk('public')
                                ->directory('berita/' . Carbon::now()->year)
                                ->helperText('*Isikan Maksimal 5 Foto dan Ukuran File Maksimal 2 Mb.')
                                ->hint('foto auto cropping rasio 16:9')
                                ->imageCropAspectRatio('16:9')
                                ->multiple()
                                ->required()
                                ->maxSize(2048)
                                ->openable()
                                ->downloadable()
                        ])->columns(1),
                ])->columnSpan(1)

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    Grid::make()->schema([
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
                            ->extraAttributes([
                                'class' => 'mt-2 text-gray-500 dark:text-gray-300 text-md font-bold'
                            ]),
                        TextColumn::make('body')
                            ->searchable()
                            ->words(25)
                            // ->html()
                            ->formatStateUsing(fn(string $state) => strip_tags($state))
                            ->extraAttributes([
                                'class' => 'mt-2 text-gray-500 dark:text-gray-300 text-xs text-justify'
                            ]),
                        Split::make([
                            Stack::make([
                                TextColumn::make('created_at')->date()->color('primary')
                                    ->extraAttributes([
                                        'class' => 'mt-2 text-primary-500 dark:text-primary-500 text-xs'
                                    ]),
                                TextColumn::make('kabkota.nama')->extraAttributes([
                                    'class' => 'mt-2 text-primary-500 dark:text-primary-500 text-xs italic'
                                ])
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
                        ])
                    ]),
                ])
            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'view' => Pages\ViewBerita::route('/{record}'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
