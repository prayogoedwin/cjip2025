<?php

namespace App\Filament\Resources\Cjip;

use App\Filament\Clusters\CJIP;
use App\Filament\Resources\Cjip\PertumbuhanEkonomiResource\Pages;
use App\Filament\Resources\Cjip\PertumbuhanEkonomiResource\RelationManagers;
use App\Models\Cjip\PertumbuhanEkonomi;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PertumbuhanEkonomiResource extends Resource
{
    protected static ?string $model = PertumbuhanEkonomi::class;
    protected static ?string $navigationGroup = 'Cjip';
    protected static ?int $navigationSort = 8;
    protected static ?string $navigationLabel = 'Pertumbuhan Ekonomi';
    protected static ?string $cluster = CJIP::class;
    protected static ?string $recordTitleAttribute = 'tahun';
    protected static ?string $pluralLabel = 'Pertumbuhan Ekonomi';
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
                    TextInput::make('pertumbuhan_jateng')->label('Pertumbuhan Jateng'),
                    TextInput::make('pertumbuhan_nasional')->label('Pertumbuhan Nasional'),
                    Toggle::make('status')->inline()->label('Status')
                ])->columnSpan(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tahun')->label('Tahun')->sortable()->searchable(),
                TextColumn::make('pertumbuhan_jateng')->label('Pertumbuhan Jateng')->sortable()->searchable(),
                TextColumn::make('pertumbuhan_nasional')->label('Pertumbuhan Nasional')->sortable()->searchable(),
                BooleanColumn::make('status')
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle')
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
            'index' => Pages\ListPertumbuhanEkonomis::route('/'),
            'create' => Pages\CreatePertumbuhanEkonomi::route('/create'),
            'edit' => Pages\EditPertumbuhanEkonomi::route('/{record}/edit'),
        ];
    }
}
