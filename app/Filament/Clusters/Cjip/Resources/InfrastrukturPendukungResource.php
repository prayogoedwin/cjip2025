<?php

namespace App\Filament\Clusters\Cjip\Resources;

use App\Filament\Clusters\Cjip;
use App\Filament\Clusters\Cjip\Resources\InfrastrukturPendukungResource\Pages;
use App\Filament\Clusters\Cjip\Resources\InfrastrukturPendukungResource\RelationManagers;
use App\Models\Cjip\InfrastrukturPendukung;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class InfrastrukturPendukungResource extends Resource
{
    use Translatable;
    protected static ?string $model = InfrastrukturPendukung::class;

    protected static ?string $navigationGroup = 'Cjip';

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $navigationLabel = 'Infrastruktur Pendukung';

    protected static ?int $navigationSort = 7;

    protected static ?string $pluralLabel = 'Infrastruktur Pendukung';

    protected static ?string $cluster = Cjip::class;

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    DatePicker::make('tanggal')->label('Tanggal'),
                    TextInput::make('nama')->label('Nama Infrastruktur'),
                    Textarea::make('detail')->label('Detail Infrastruktur'),
                    Toggle::make('status')->label('Status')->inline(),
                ])->columnSpan(1),
                Card::make()->schema([
                    Grid::make()->schema([
                        FileUpload::make('gambar')->directory('infrastruktur/gambar/' . Auth::user()->name . '/' . Carbon::now()->year)
                            ->image()
                            ->maxSize(1024)
                            ->hint('File Maksimal 1 Mb.'),
                        FileUpload::make('icon')->directory('infrastruktur/icon/' . Auth::user()->name . '/' . Carbon::now()->year)
                            ->hint('format icon .png'),
                    ])->columns(1)
                ])->columnSpan(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')->searchable()->sortable(),
                TextColumn::make('nama')->wrap()->searchable()->sortable(),
                TextColumn::make('detail')->wrap()->limit(100)->searchable()->sortable(),
                BooleanColumn::make('status')
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle'),
                ImageColumn::make('gambar')->searchable()->sortable(),
                ImageColumn::make('icon')->searchable()->width(50)->height(50)
                    ->rounded()->sortable(),
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
            'index' => Pages\ListInfrastrukturPendukungs::route('/'),
            'create' => Pages\CreateInfrastrukturPendukung::route('/create'),
            'edit' => Pages\EditInfrastrukturPendukung::route('/{record}/edit'),
        ];
    }
}
