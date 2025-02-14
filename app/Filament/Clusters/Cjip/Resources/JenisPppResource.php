<?php

namespace App\Filament\Clusters\Cjip\Resources;

use App\Filament\Clusters\Cjip;
use App\Filament\Clusters\Cjip\Resources\JenisPppResource\Pages;
use App\Filament\Clusters\Cjip\Resources\JenisPppResource\RelationManagers;
use App\Models\Cjip\JenisPpp;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JenisPppResource extends Resource
{
    protected static ?string $model = JenisPpp::class;

    protected static ?string $navigationGroup = 'Setting';

    protected static ?string $navigationLabel = 'Jenis PPP';

    protected static ?int $navigationSort = 3;

    protected static ?string $pluralLabel = 'Jenis PPP';

    protected static ?string $cluster = Cjip::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->label('Jenis')->required(),
                TextInput::make('kode')->numeric()->label('Kode')->required(),
                TextInput::make('kode_data')->numeric()->label('Kode Data')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->label('Jenis'),
                TextColumn::make('kode')->label('Kode Jenis'),
                TextColumn::make('kode_data')->label('Kode Data'),
            ])
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
            'index' => Pages\ListJenisPpps::route('/'),
            'create' => Pages\CreateJenisPpp::route('/create'),
            'edit' => Pages\EditJenisPpp::route('/{record}/edit'),
        ];
    }
}
