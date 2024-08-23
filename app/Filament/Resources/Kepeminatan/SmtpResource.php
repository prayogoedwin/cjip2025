<?php

namespace App\Filament\Resources\Kepeminatan;

use App\Filament\Resources\Kepeminatan\SmtpResource\Pages;
use App\Filament\Resources\Kepeminatan\SmtpResource\RelationManagers;
use App\Models\Kepeminatan\Smtp;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SmtpResource extends Resource
{
    protected static ?string $model = Smtp::class;
    protected static ?string $navigationGroup = 'Kepeminatan';

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationLabel = 'SMPT Setting';

    protected static ?string $recordTitleAttribute = 'smtp';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('modul')->columnSpanFull()->required()->default('kepeminatan')->disabled(),
                TextInput::make('mail_mailer')->required(),
                TextInput::make('mail_host')->required(),
                TextInput::make('mail_port')->required(),
                TextInput::make('mail_username')->required(),
                TextInput::make('mail_password')->required(),
                TextInput::make('mail_encryption')->required(),
                TextInput::make('mail_from_address')->required(),
                TextInput::make('mail_from_name')->required(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('modul', 'kepeminatan');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('mail_mailer')->searchable(),
                TextColumn::make('mail_host')->searchable(),
                TextColumn::make('mail_port')->searchable(),
                TextColumn::make('mail_username')->searchable(),
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
            'index' => Pages\ListSmtps::route('/'),
            'create' => Pages\CreateSmtp::route('/create'),
            'edit' => Pages\EditSmtp::route('/{record}/edit'),
        ];
    }
}
