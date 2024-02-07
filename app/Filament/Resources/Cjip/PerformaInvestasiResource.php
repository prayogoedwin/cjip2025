<?php

namespace App\Filament\Resources\Cjip;

use App\Filament\Resources\Cjip\PerformaInvestasiResource\Pages;
use App\Filament\Resources\Cjip\PerformaInvestasiResource\RelationManagers;
use App\Models\Cjip\PerformaInvestasi;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Section;
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

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationLabel = 'Performa Investasi';

    protected static ?string $recordTitleAttribute = 'tahun';

    protected static ?string $pluralLabel = 'Performa Investasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
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
            'index' => Pages\ListPerformaInvestasis::route('/'),
            'create' => Pages\CreatePerformaInvestasi::route('/create'),
            'edit' => Pages\EditPerformaInvestasi::route('/{record}/edit'),
        ];
    }
}
