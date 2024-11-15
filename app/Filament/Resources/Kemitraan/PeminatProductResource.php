<?php

namespace App\Filament\Resources\Kemitraan;

use App\Filament\Resources\Kemitraan\PeminatProductResource\Pages;
use App\Filament\Resources\Kemitraan\PeminatProductResource\RelationManagers;
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
    protected static ?string $navigationGroup = 'Kemitraan';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Peminat Produk';

    protected static ?string $recordTitleAttribute = 'peminat produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_peminat')->disabled(),
                TextInput::make('product_diminati')->disabled(),
                Toggle::make('status')
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('userPeminat.name'),
                TextColumn::make('product.name'),
                TextColumn::make('product.slug'),
                ToggleColumn::make('status'),
                TextInputColumn::make('rencana_nilai_pekerjaan')->rules(['numeric'])
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('detail')
                    ->label('Detail Minat')
                    // ->url(fn(PeminatProduct $record) => route('peminat-product.show', $record->id))
                    ->color('secondary')
                    ->icon('heroicon-o-eye'),
                Action::make('download-form')
                    ->label('Download Form')
                    // ->url(fn(PeminatProduct $record) => route('form-kemitraan', $record->id))
                    ->color('secondary')
                    ->icon('heroicon-o-arrow-down-tray')
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
