<?php

namespace App\Filament\Clusters\Kemitraan\Resources;

use App\Filament\Clusters\Kemitraan;
use App\Filament\Clusters\Kemitraan\Resources\PeminatProductResource\Pages;
use App\Filament\Clusters\Kemitraan\Resources\PeminatProductResource\RelationManagers;
use App\Models\Kemitraan\PeminatProduct;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;

use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeminatProductResource extends Resource
{
    protected static ?string $model = PeminatProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Peminat Produk';

    protected static ?string $pluralLabel = 'Peminat Produk';

    protected static ?int $navigationSort = 1;

    protected static ?string $cluster = Kemitraan::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_peminat')->disabled(),
                TextInput::make('product_diminati')->disabled(),
                Toggle::make('status')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('userPeminat.name')->label('Nama Peminat Produk')->searchable(),
                TextColumn::make('product.user.name')->label('Nama Pemilik Produk')->searchable(),
                TextColumn::make('product.name')->label('Nama Produk')->searchable(),
                // TextColumn::make('product.slug'),
                ToggleColumn::make('status')->label('Verifikasi'),
                TextInputColumn::make('rencana_nilai_pekerjaan')->rules(['numeric'])
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('detail')
                    ->label('Detail Minat')
                    // ->url(fn(PeminatProduct $record) => route('peminat-product.show', $record->id))
                    ->color('primary')
                    ->icon('heroicon-s-eye'),
                Action::make('download-form')
                    ->label('Download Form')
                    // ->url(fn(PeminatProduct $record) => route('form-kemitraan', $record->id))
                    ->color('primary')
                    ->icon('heroicon-s-arrow-down-tray')
                    ->openUrlInNewTab()
                    ->visible(fn(PeminatProduct $record) => $record->status == 1),
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
            'index' => Pages\ListPeminatProducts::route('/'),
            'create' => Pages\CreatePeminatProduct::route('/create'),
            'edit' => Pages\EditPeminatProduct::route('/{record}/edit'),
        ];
    }
}
