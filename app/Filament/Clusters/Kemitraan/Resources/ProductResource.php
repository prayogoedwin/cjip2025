<?php

namespace App\Filament\Clusters\Kemitraan\Resources;

use App\Filament\Clusters\Kemitraan;
use App\Filament\Clusters\Kemitraan\Resources\ProductResource\Pages;
use App\Filament\Clusters\Kemitraan\Resources\ProductResource\RelationManagers;
use App\Models\Kemitraan\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                //
            ]);
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
            ])->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
