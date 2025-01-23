<?php

namespace App\Filament\Clusters\PermohonanInsentif\Resources;

use App\Filament\Clusters\PermohonanInsentif;
use App\Filament\Clusters\PermohonanInsentif\Resources\SmtpResource\Pages;
use App\Filament\Clusters\PermohonanInsentif\Resources\SmtpResource\RelationManagers;
use App\Models\Sinida\Smtp as SinidaSmtp;
use App\Models\Smtp;
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
    protected static ?string $model = SinidaSmtp::class;

    protected static ?string $navigationIcon = 'heroicon-s-cog-8-tooth';

    protected static ?string $navigationGroup = 'Settings ----------------------------';

    protected static ?string $navigationLabel = 'SMTP';

    protected static ?int $navigationSort = 2;

    protected static ?string $pluralLabel = 'SMTP';

    protected static ?string $cluster = PermohonanInsentif::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('modul')->columnSpanFull()->required()->default('sinida')->disabled(),
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
