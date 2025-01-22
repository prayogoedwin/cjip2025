<?php

namespace App\Filament\Clusters\CJIP\Resources;

use App\Filament\Clusters\Cjip;
use App\Filament\Clusters\CJIP\Resources\O3MettingResource\Pages;
use App\Filament\Clusters\CJIP\Resources\O3MettingResource\RelationManagers;
use App\Models\Cjibf\CjibfRegisterO3m;
use App\Models\Cjip\Kawasan;
use App\Models\General\Kabkota;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class O3MettingResource extends Resource
{
    protected static ?string $model = CjibfRegisterO3m::class;
    protected static ?string $cluster = Cjip::class;

    protected static ?string $navigationGroup = 'CJIBF';

    protected static ?string $navigationLabel = 'Register O3m';

    protected static ?string $pluralLabel = 'Register O3m';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Hidden::make("event_id")->default('1'),
                    TextInput::make('name')
                        ->label('Name / nama')
                        ->required(),
                    TextInput::make('company_name')
                        ->label('Company / Nama Perusahaan')
                        ->required(),
                    TextInput::make('mobile_phone')
                        ->label('WhatsApp Contact (Mobile Phone) / Kontak WhatsApp (Ponsel)')
                        ->required()
                        ->numeric(),
                    Radio::make('o3m_interest_id')
                        ->label('Whom do you wish to meet during the One on One Meeting? / Siapa yang ingin Anda temui pada One on One Meeting?')
                        ->options([
                            '1' => 'Regencial/Municipal Government (Pemerintah Kabupaten/Kota)',
                            '2' => 'Industrial Park Management (Pengelola Kawasan Industri)',
                            '3' => 'PT Geo Dipa Energi (Persero) (Geothermal Energy Potential in Central Java)'
                        ])
                        ->reactive()
                        ->required(),

                    Select::make('kawasan_id')
                        ->label('Industrial Parks / Kawasan Industri')
                        ->options(options: Kawasan::all()->pluck('nama', 'id'))
                        ->searchable()
                        ->preload()
                        ->visible(function (\Closure $get) {
                            if ($get('o3m_interest_id') === 2) {
                                return true;
                            }
                            return false;
                        }),
                    Select::make('kab_kota_id')
                        ->label('Regency/City / Kabupaten/Kota')
                        ->options(options: Kabkota::all()->pluck('nama', 'id'))
                        ->searchable()
                        ->preload()
                        ->visible(function (\Closure $get) {
                            if ($get('o3m_interest_id') === 1) {
                                return true;
                            }
                            return false;
                        }),


                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('company_name')
                    ->label('Company Name'),
                TextColumn::make('mobile_phone')
                    ->copyable()
                    ->label('Mobile Phone'),
                TextColumn::make('interest.interest')
                    ->wrap(),
                TextColumn::make('InterestLocation')
                    ->label('Interest Location')
                    ->color('primary')
                    ->getStateUsing(function ($record) {
                        return $record->InterestLocation;
                    }),
            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make('table')
                        ->fromTable()
                        ->withFilename(date('d-M-Y') . ' - Data O3M')
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX),
                ])
                    ->button()
                    ->color('success')
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
            'index' => Pages\ListO3Mettings::route('/'),
            'create' => Pages\CreateO3Metting::route('/create'),
            'edit' => Pages\EditO3Metting::route('/{record}/edit'),
        ];
    }
}
