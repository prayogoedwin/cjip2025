<?php

namespace App\Filament\Clusters\Cjip\Resources;

use App\Filament\Clusters\Cjip;
use App\Filament\Clusters\Cjip\Resources\BiayaListrikResource\Pages;
use App\Filament\Clusters\Cjip\Resources\BiayaListrikResource\RelationManagers;
use App\Models\Cjip\BiayaListrik;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BiayaListrikResource extends Resource
{
    protected static ?string $model = BiayaListrik::class;

    protected static ?string $navigationGroup = 'Cjip';

    protected static ?string $recordTitleAttribute = 'tanggal';

    protected static ?string $navigationLabel = 'Biaya Listrik';

    protected static ?int $navigationSort = 10;

    protected static ?string $pluralLabel = 'Biaya Listrik';

    protected static ?string $cluster = Cjip::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('kode')->label('Kode'),
                    TextInput::make('kapasitas')->label('Kapasitas'),
                    TextInput::make('tarif')->label('Tarif'),
                    DatePicker::make('tanggal')->label('Tanggal'),
                    Textarea::make('keterangan')->label('Keterangan'),
                    BelongsToSelect::make('jenis_user_id')->relationship('kategori', 'user_category')->label('Jenis Kategori User Listrik')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode')->label('Kode')->wrap()->searchable()->sortable(),
                TextColumn::make('kapasitas')->label('Kapasitas')->wrap()->searchable()->sortable(),
                TextColumn::make('tanggal')->label('Tanggal')->wrap()->searchable()->sortable(),
                TextColumn::make('tarif')->label('Tarif')->wrap()->searchable()->sortable(),
                TextColumn::make('kategori.user_category')->label('Kategori')->wrap()->searchable()->sortable(),
                TextColumn::make('keterangan')->label('Keterangan')->wrap()->searchable()->limit(250)->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('tanggal', 'desc')
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
            'index' => Pages\ListBiayaListriks::route('/'),
            'create' => Pages\CreateBiayaListrik::route('/create'),
            'edit' => Pages\EditBiayaListrik::route('/{record}/edit'),
        ];
    }
}
