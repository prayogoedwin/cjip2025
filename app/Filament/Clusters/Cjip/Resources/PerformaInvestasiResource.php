<?php

namespace App\Filament\Clusters\Cjip\Resources;

use App\Filament\Clusters\Cjip;
use App\Filament\Clusters\Cjip\Resources\PerformaInvestasiResource\Pages;
use App\Filament\Clusters\Cjip\Resources\PerformaInvestasiResource\RelationManagers;
use App\Models\Cjip\PerformaInvestasi;
use Carbon\Carbon;
use Filament\Forms;
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

class PerformaInvestasiResource extends Resource
{
    protected static ?string $model = PerformaInvestasi::class;

    protected static ?string $navigationGroup = 'Cjip';

    protected static ?string $recordTitleAttribute = 'tahun';

    protected static ?string $navigationLabel = 'Performa Investasi';

    protected static ?int $navigationSort = 6;

    protected static ?string $pluralLabel = 'Performa Investasi';

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
                    TextInput::make('target')->label('Target'),
                    TextInput::make('realisasi')->label('Realisasi'),
                ])->columnSpan(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tahun')->searchable()->sortable(),
                TextColumn::make('target')->searchable()->sortable(),
                TextColumn::make('realisasi')->searchable()->sortable(),
            ])->defaultSort('tahun', 'desc')
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
            'index' => Pages\ListPerformaInvestasis::route('/'),
            'create' => Pages\CreatePerformaInvestasi::route('/create'),
            'edit' => Pages\EditPerformaInvestasi::route('/{record}/edit'),
        ];
    }
}
