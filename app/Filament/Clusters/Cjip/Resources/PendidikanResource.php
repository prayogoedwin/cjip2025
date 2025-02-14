<?php

namespace App\Filament\Clusters\Cjip\Resources;

use App\Filament\Clusters\Cjip;
use App\Filament\Clusters\Cjip\Resources\PendidikanResource\Pages;
use App\Filament\Clusters\Cjip\Resources\PendidikanResource\RelationManagers;
use App\Models\Cjip\Pendidikan;
use App\Models\General\Kabkota;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PendidikanResource extends Resource
{
    protected static ?string $model = Pendidikan::class;

    protected static ?string $navigationGroup = 'Cjip';

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $navigationLabel = 'Pendidikan';

    protected static ?int $navigationSort = 8;

    protected static ?string $pluralLabel = 'Pendidikan';

    protected static ?string $cluster = Cjip::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('nama')->label('Nama Sekolah'),
                    Select::make('kab_kota_id')->label('Kabupaten/Kota')
                        ->searchable()
                        ->options(Kabkota::all()->pluck('nama', 'id')),
                    Select::make('jenis_sekolah')->options([
                        'Sekolah Dasar' => 'Sekolah Dasar',
                        'Sekolah Menengah Pertama' => 'Sekolah Menengah Pertama',
                        'Sekolah Menengah Atas' => 'Sekolah Menengah Atas',
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->label('Nama Sekolah')->searchable()->sortable(),
                TextColumn::make('kabkota.nama')->label('Kabupaten/Kota')->searchable()->sortable(),
                TextColumn::make('jenis_sekolah')->label('Jenis Sekolah')->searchable()->sortable(),
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
            'index' => Pages\ListPendidikans::route('/'),
            'create' => Pages\CreatePendidikan::route('/create'),
            'edit' => Pages\EditPendidikan::route('/{record}/edit'),
        ];
    }
}
