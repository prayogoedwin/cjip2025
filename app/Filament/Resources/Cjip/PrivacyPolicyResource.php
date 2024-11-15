<?php

namespace App\Filament\Resources\Cjip;

use App\Filament\Clusters\CJIP;
use App\Filament\Resources\Cjip\PrivacyPolicyResource\Pages;
use App\Filament\Resources\Cjip\PrivacyPolicyResource\RelationManagers;
use App\Models\Cjip\PrivacyPolicy;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Columns\TextColumn;

class PrivacyPolicyResource extends Resource
{
    use Translatable;
    protected static ?string $model = PrivacyPolicy::class;
    protected static ?string $navigationLabel = 'Privacy Policy';

    protected static ?string $navigationGroup = 'Cjip';

    protected static ?string $cluster = CJIP::class;

    protected static ?int $navigationSort = 13;

    protected static ?string $recordTitleAttribute = 'category';

    protected static ?string $pluralLabel = 'Privacy Policy';
    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('category')->label('Category'),
                    Textarea::make('policy')->label('Policy'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category')->wrap()->searchable()->sortable(),
                TextColumn::make('policy')->wrap()->searchable()->limit(100)->sortable(),
            ])->defaultSort('policy', 'desc')
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
            'index' => Pages\ListPrivacyPolicies::route('/'),
            'create' => Pages\CreatePrivacyPolicy::route('/create'),
            'edit' => Pages\EditPrivacyPolicy::route('/{record}/edit'),
        ];
    }
}
