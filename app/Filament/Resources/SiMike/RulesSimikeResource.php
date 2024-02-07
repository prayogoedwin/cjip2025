<?php

namespace App\Filament\Resources\SiMike;

use App\Filament\Resources\SiMike\RulesSimikeResource\Pages;
use App\Filament\Resources\SiMike\RulesSimikeResource\RelationManagers;
use App\Models\SiMike\RulesSimike;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
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

class RulesSimikeResource extends Resource
{
    protected static ?string $model = RulesSimike::class;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Si-Mike';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('nama')->required(),
                    Repeater::make('rules')
                        ->schema([
                            TextInput::make('kategori')->required(),
                            TextInput::make('min')->required()->numeric(),
                            TextInput::make('max')->numeric(),
                        ])->columns(3),
                    Toggle::make('is_active')->required()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->searchable(),
                BooleanColumn::make('is_active')->searchable()
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
            'index' => Pages\ListRulesSimikes::route('/'),
            'create' => Pages\CreateRulesSimike::route('/create'),
            'edit' => Pages\EditRulesSimike::route('/{record}/edit'),
        ];
    }
}
