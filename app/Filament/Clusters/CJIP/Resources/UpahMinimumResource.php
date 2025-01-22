<?php

namespace App\Filament\Clusters\CJIP\Resources;

use App\Filament\Clusters\Cjip;
use App\Filament\Clusters\CJIP\Resources\UpahMinimumResource\Pages;
use App\Filament\Clusters\CJIP\Resources\UpahMinimumResource\RelationManagers;
use App\Models\Cjip\UpahMinimum;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UpahMinimumResource extends Resource
{
    protected static ?string $model = UpahMinimum::class;

    protected static ?string $navigationGroup = 'CJIP';

    protected static ?string $recordTitleAttribute = 'tahun';

    protected static ?string $navigationLabel = 'Upah Minimum';

    protected static ?string $pluralLabel = 'Upah Minimum';

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
                    TextInput::make('nilai_umr')->label('Nilai UMK'),
                    Textarea::make('sumber_data'),
                    BelongsToSelect::make('kab_kota_id')->relationship('kabkota', 'nama')->searchable()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tahun')->wrap()->label('Tahun')->searchable()->sortable(),
                TextColumn::make('nilai_umr')->label('Nilai UMK')->sortable(),
                TextColumn::make('sumber_data')->wrap()->label('Sumber Data')->searchable()->sortable(),
                TextColumn::make('kabkota.nama')->wrap()->label('Kabupaten/Kota')->searchable()->sortable(),
                TextColumn::make('created_at')->wrap()->label('Created')->searchable()->sortable()->date(),
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
            'index' => Pages\ListUpahMinimums::route('/'),
            'create' => Pages\CreateUpahMinimum::route('/create'),
            'edit' => Pages\EditUpahMinimum::route('/{record}/edit'),
        ];
    }
}
