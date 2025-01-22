<?php

namespace App\Filament\Clusters\CJIP\Resources;

use App\Filament\Clusters\Cjip;
use App\Filament\Clusters\CJIP\Resources\BiayaAirResource\Pages;
use App\Filament\Clusters\CJIP\Resources\BiayaAirResource\RelationManagers;
use App\Models\Cjip\BiayaAir;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BiayaAirResource extends Resource
{
    protected static ?string $model = BiayaAir::class;

    protected static ?string $navigationGroup = 'CJIP';

    protected static ?string $recordTitleAttribute = 'tahun';

    protected static ?string $navigationLabel = 'Biaya Air';

    protected static ?string $pluralLabel = 'Biaya Air';

    protected static ?string $cluster = Cjip::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('tahun')
                        ->options(function () {
                            $years = range(Carbon::now()->year, Carbon::now()->subYear(5)->year);
                            return array_combine($years, $years);
                        })
                        ->default(Carbon::now()->year),
                    TextInput::make('category'),
                    TextInput::make('first'),
                    TextInput::make('second'),
                    TextInput::make('third'),
                    TextInput::make('four'),
                    BelongsToSelect::make('jenis_user_id')->relationship('kategoriair', 'user_category')->label('kategori User')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kategoriair.user_category')->wrap()->label('Kategori')->searchable(),
                TextColumn::make('category')->wrap()->label('kategori')->searchable(),
                TextColumn::make('first')->wrap()->label('I (1 - 10 m3)')->searchable(),
                TextColumn::make('second')->wrap()->label('II ( 11 - 20 m3)')->searchable(),
                TextColumn::make('third')->wrap()->label('III (21 - 30 m3)')->searchable(),
                TextColumn::make('four')->wrap()->label('IV (> 31 m3)')->searchable(),
                TextColumn::make('tahun')->wrap()->label('Tahun')->searchable(),
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
            'index' => Pages\ListBiayaAirs::route('/'),
            'create' => Pages\CreateBiayaAir::route('/create'),
            'edit' => Pages\EditBiayaAir::route('/{record}/edit'),
        ];
    }
}
