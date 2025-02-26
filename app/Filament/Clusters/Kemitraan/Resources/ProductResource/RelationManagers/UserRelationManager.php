<?php

namespace App\Filament\Clusters\Kemitraan\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserRelationManager extends RelationManager
{
    protected static string $relationship = 'user';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('User Perusahaan')
            ->recordTitleAttribute('user_id')
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama Pelaku Usaha'),
                Tables\Columns\TextColumn::make('email')->label('Email')->copyable()
                    ->tooltip('klik untuk menyalin email')
                    ->icon('heroicon-s-envelope'),
                Tables\Columns\TextColumn::make('no_hp')->label('No. Hp')
                    ->copyable()
                    ->tooltip('klik untuk menyalin no. hp')
                    ->icon('heroicon-s-phone'),
                Tables\Columns\TextColumn::make('userperusahaan.nama_perusahaan')->label('Nama Perusahaan'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
