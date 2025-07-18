<?php

namespace App\Filament\Clusters\PermohonanInsentif\Resources;

use App\Filament\Clusters\PermohonanInsentif;
use App\Filament\Clusters\PermohonanInsentif\Resources\TemplateEmailResource\Pages;
use App\Filament\Clusters\PermohonanInsentif\Resources\TemplateEmailResource\RelationManagers;
use App\Models\Sinida\TemplateEmail as SinidaTemplateEmail;
use App\Models\TemplateEmail;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TemplateEmailResource extends Resource
{
    protected static ?string $model = SinidaTemplateEmail::class;

    protected static ?string $navigationIcon = 'heroicon-s-envelope';

    protected static ?string $navigationGroup = 'Settings ----------------------------';

    protected static ?string $navigationLabel = 'Template Email';

    protected static ?int $navigationSort = 1;

    protected static ?string $pluralLabel = 'Template Email';

    protected static ?string $cluster = PermohonanInsentif::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('modul')->columnSpanFull()->required()->default('sinida')->disabled(),
                TextInput::make('status')->required(),
                TextInput::make('subject')->required(),
                MarkdownEditor::make('content')->columnSpanFull()->required()
            ]);
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('modul', 'sinida');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')->searchable(),
                TextColumn::make('subject')->searchable(),
                TextColumn::make('content')->limit('40')
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
            'index' => Pages\ListTemplateEmails::route('/'),
            'create' => Pages\CreateTemplateEmail::route('/create'),
            'edit' => Pages\EditTemplateEmail::route('/{record}/edit'),
        ];
    }
}
