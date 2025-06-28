<?php

namespace App\Filament\Resources\Sidikaryo;

use App\Filament\Resources\Sidikaryo\DapodikResource\Pages;
use App\Filament\Resources\Sidikaryo\DapodikResource\RelationManagers;
use App\Models\Sidikaryo\SidikaryoDapodik;
use App\Models\BridgingKabkota;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Carbon;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;


class DapodikResource extends Resource
{
    protected static ?string $model = \App\Models\Sidikaryo\SidikaryoDapodik::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'SIDIKARYO';
    protected static ?string $navigationLabel = 'Dapodik'; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
             ->columns([
                    TextColumn::make('tahun_data')
                        ->label('Tahun Data')
                        ->searchable()
                        ->sortable(),
                    
                    TextColumn::make('kode_kabkota')
                        ->label('Kode Kab/Kota')
                        ->searchable()
                        ->sortable(),
                        
                    TextColumn::make('kab_kota')
                        ->label('Kabupaten/Kota')
                        ->searchable()
                        ->sortable()
                        ->alignRight(),
                        
                    TextColumn::make('nama_sma_smk')
                        ->label('Nama SMA/SMK')
                        ->searchable()
                        ->sortable(),
                        
                    TextColumn::make('jumlah_laki_laki')
                        ->label('Jumlah Laki-laki')
                        ->numeric()
                        ->sortable()
                        ->alignRight(),
                        
                    TextColumn::make('jumlah_perempuan')
                        ->label('Jumlah Perempuan')
                        ->numeric()
                        ->sortable()
                        ->alignRight(),
                        
                    TextColumn::make('siswa_laki12')
                        ->label('Siswa Laki Kelas 12')
                        ->numeric()
                        ->sortable()
                        ->alignRight(),
                        
                    TextColumn::make('siswa_perempuan12')
                        ->label('Siswa Perempuan Kelas 12')
                        ->numeric()
                        ->sortable()
                        ->alignRight(),
                        
                    TextColumn::make('siswa_laki13')
                        ->label('Siswa Laki Kelas 13')
                        ->numeric()
                        ->sortable()
                        ->alignRight(),
                        
                    TextColumn::make('siswa_perempuan13')
                        ->label('Siswa Perempuan Kelas 13')
                        ->numeric()
                        ->sortable()
                        ->alignRight(),
                        
                    TextColumn::make('jurusan')
                        ->label('Jurusan')
                        ->searchable()
                        ->sortable(),
                        
                    TextColumn::make('total_jumlah_potensi')
                        ->label('Total Potensi')
                        ->numeric()
                        ->sortable()
                        ->alignRight(),
                        
                    TextColumn::make('cjip_kota_id')
                        ->label('CJIP Kota ID')
                        ->numeric()
                        ->sortable(),
                        
                    TextColumn::make('kabkota_id')
                        ->label('Kab/Kota ID')
                        ->numeric()
                        ->sortable(),
            ])
            ->filters([
                SelectFilter::make('tahun_data')
                ->label('Tahun Data')
                ->placeholder('Pilih Tahun')
                ->options(function () {
                    // Ambil tahun unik dari database dan urutkan descending
                    return SidikaryoDapodik::query()
                        ->select('tahun_data')
                        ->distinct()
                        ->orderBy('tahun_data', 'desc')
                        ->pluck('tahun_data', 'tahun_data')
                        ->toArray();
                })
                ->searchable() // Opsional: untuk pencarian jika tahun banyak
                ->default(null), 
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
             ->headerActions([
                Action::make('rekap')
                    ->label('Rekap Data')
                    ->url(static::getUrl('rekap'))
                    ->color('success')
                    ->icon('heroicon-o-document-chart-bar'),
            ]);
            // ->contentFooter(view('filament.resources.sidikaryo.dapodik-summary'));
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->can('viewAny', static::getModel());
    // }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('rekap')
                ->label('Rekap Data')
                ->url(static::getResource()::getUrl('rekap'))
                ->color('success')
                ->icon('heroicon-o-document-chart-bar'),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDapodiks::route('/'),
            'rekap' => Pages\RekapDapodik::route('/rekap'),
            // 'rekap' => Pages\DapodikRekap2::route('/dapodik_rekap'),
            // 'create' => Pages\CreateDapodik::route('/create'),
            // 'edit' => Pages\EditDapodik::route('/{record}/edit'),
        ];
    }
}
