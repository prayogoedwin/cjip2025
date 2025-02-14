<?php

namespace App\Filament\Clusters\Kemitraan\Resources;

use App\Filament\Clusters\Kemitraan;
use App\Filament\Clusters\Kemitraan\Resources\ProductResource\Pages;
use App\Filament\Clusters\Kemitraan\Resources\ProductResource\RelationManagers;
use App\Models\Kemitraan\Product;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-s-gift-top';

    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $pluralLabel = 'Produk';

    protected static ?int $navigationSort = 2;

    protected static ?string $cluster = Kemitraan::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->label('Nama Produk')
                        ->required()
                        ->placeholder('Masukan Nama Produk')
                        ->reactive()
                        ->afterStateUpdated(fn($set, ?string $state) => $set('slug', Str::slug($state))),

                    TextInput::make('slug')
                        ->label('Slug Produk')
                        ->required(),

                    MarkdownEditor::make('description')
                        ->label('Deskripsi')
                        ->toolbarButtons([
                            'attachFiles',
                            'blockquote',
                            'bold',
                            'bulletList',
                            'codeBlock',
                            'heading',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'table',
                            'underline',
                            'undo',
                            'fullscreen',
                            'justify',
                        ])
                        ->placeholder('Masukan Deskripsi Produk'),

                    FileUpload::make('image_cover')
                        ->label('Sampul Produk')
                        ->image()
                        ->required()
                        ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])
                        ->disk('public')
                        ->directory('kemitraan/product/cover')
                        ->maxSize(2048)
                        ->hint('*file maksimal 2 MB')
                        ->preserveFilenames(),

                    FileUpload::make('image')
                        ->label('Galeri Produk')
                        ->image()
                        ->required()
                        ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])
                        ->disk('public')
                        ->directory('kemitraan/product/gallery')
                        ->maxSize(2048)
                        ->maxFiles(5)
                        ->multiple()
                        ->hint('*maksimal 5 gambar')
                        ->preserveFilenames(),

                    Toggle::make('is_active')
                        ->label('Status')
                        ->default(false)
                        ->onColor('success')
                        ->offColor('danger')
                        ->onIcon('heroicon-s-check-circle')
                        ->offIcon('heroicon-s-x-circle'),
                ]),

            ]);
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_cover')->label('Cover Produk')->width(50),
                TextColumn::make('name')->label('Nama Produk')->searchable()->sortable(),
                TextColumn::make('description')->label('Deskripsi Produk')->searchable()->wrap()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('user.name')->label('Pemilik Produk')->searchable(),
                TextColumn::make('user.userperusahaan.nama_perusahaan')->label('Nama Perusahaan')->searchable(),
                TextColumn::make('user.userperusahaan.alamat_perusahaan')->label('Alamat Perusahaan')->searchable()->wrap()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->label('Tanggal Update')->searchable()->date('d F Y')->wrap()->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->iconButton(),
                Tables\Actions\EditAction::make()->iconButton(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
