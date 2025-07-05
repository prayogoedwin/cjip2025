<?php

namespace App\Filament\Resources\Sidikaryo;

use App\Filament\Resources\Sidikaryo\PenempatanResource\Pages;
use App\Filament\Resources\Sidikaryo\PenempatanResource\RelationManagers;
use App\Models\Sidikaryo\SidikaryoPenempatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\BridgingKabkota;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Sidikaryo\SidikaryoPenempatanExport;


class PenempatanResource extends Resource
{
    // protected static ?string $model = Penempatan::class;
    protected static ?string $model = \App\Models\Sidikaryo\SidikaryoPenempatan::class;


    protected static ?string $modelLabel = 'Data Penempatan';
    protected static ?string $pluralModelLabel = 'Data Penempatan';
    protected static ?string $title = 'Data Penempatan';

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'SIDIKARYO';
    protected static ?string $navigationLabel = 'Penempatan'; 

    protected static bool $canCreate = false; // Ini yang paling efektif

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
            TextColumn::make('kota')
                ->label('Kabupaten/Kota')
                ->searchable()
                ->sortable(),
                
            TextColumn::make('jmllaki')
                ->label('Jumlah L')
                ->numeric()
                ->sortable()
                ->alignRight(),
                
            TextColumn::make('jmlperempuan')
                ->label('Jumlah P')
                ->numeric()
                ->sortable()
                ->alignRight(),
                
            TextColumn::make('total')
                ->label('Total')
                ->numeric()
                ->sortable()
                ->alignRight(),
                
            TextColumn::make('created_at')
                ->label('Tanggal Tarik')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: false),
        ])
           ->filters([
            // Filter default hari ini
            // Filter::make('hari_ini')
            //     ->label('Hari Ini')
            //     ->default()
            //     ->query(fn ($query) => $query->whereDate('created_at', today())),
                
            // Filter berdasarkan tanggal spesifik
            // Filter::make('tanggal')
            //     ->form([
            //         Forms\Components\DatePicker::make('tanggal')
            //             ->label('Pilih Tanggal')
            //             ->default(today())
            //             ->displayFormat('d F Y')
            //     ])
            //     ->query(function (Builder $query, array $data) {
            //         return $query
            //             ->when(
            //                 $data['tanggal'],
            //                 fn ($query, $date) => $query->whereDate('created_at', $date)
            //             );
            //     })
            //     ->indicateUsing(function (array $data): ?string {
            //         if (! $data['tanggal']) {
            //             return null;
            //         }
            //         return 'Tanggal: ' . Carbon::parse($data['tanggal'])->format('d F Y');
            //     })
        ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\ViewAction::make(), // Opsional
            ])
            ->headerActions([
                Action::make('tarikData')
                    ->label('Tarik Data')
                    ->action(function () {
                        // Pindahkan logika ke method terpisah atau langsung di sini
                        try {
                            //$response = Http::get('https://bursakerja.jatengprov.go.id/api_v2/rekap/pencaker');
                            $response = Http::withOptions([
                'verify' => false, // Nonaktifkan SSL verify (sementara)
                'timeout' => 120, // Timeout 120 detik
            ])
            ->withHeaders([
                'Accept' => 'application/json',
                'User-Agent' => 'Filament-App/1.0',
            ])
            ->retry(3, 5000) // 3x percobaan, interval 5 detik
            ->get('https://bursakerja.jatengprov.go.id/api_v2/rekap/penempatan');
            
                            
                            if ($response->successful()) {
                                $data = $response->json();
                                
                                // Hapus data hari ini jika sudah ada
                                //SidikaryoPenempatan::whereDate('created_at', today())->delete();
                                SidikaryoPenempatan::truncate();
                                
                                foreach ($data as $item) {
                                    $bridging = BridgingKabkota::where('kabkota_id', $item['id'])->first();
                                    
                                     SidikaryoPenempatan::create([
                                        'id_kota' => $item['id'],
                                        'kota' => $item['nmkabkota'],
                                        'cjip_kota_id' => $bridging ? $bridging->cjip_kabkota_id : null,
                                        'jmllaki' => $item['jmllaki'],
                                        'jmlperempuan' => $item['jmlperempuan'],
                                        'total' => $item['total'],
                                        'created_at' => now(),
                                        'updated_at' => now(),
                                    ]);
                                }
                                
                                Notification::make()
                                    ->title('Data berhasil ditarik')
                                    ->success()
                                    ->send();
                            } else {
                                throw new \Exception('Gagal mengambil data dari API');
                            }
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Error: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Tarik Data Penempatan')
                    ->modalSubheading('Data akan diambil dari API Bursa Kerja Jateng')
                    ->modalButton('Proses')
                    ->modalCloseButton(false),

                Action::make('export')
                    ->label('Export Excel')
                    ->action(fn () => Excel::download(
                        new SidikaryoPenempatanExport(), 
                        'sidikaryo-penempatan-export-'.now()->format('Y-m-d').'.xlsx'
                    ))
                    ->color('success')
                    ->icon('heroicon-o-arrow-down-tray')
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public function tarikData()
    {
        try {
            // Ambil data dari API
            $response = Http::get('http://bursakerja.jatengprov.go.id/api_v2/rekap/penempatan');
            
            if ($response->successful()) {
                $data = $response->json();
                
                // Hapus data hari ini jika sudah ada
                SidikaryoPenempatan::whereDate('created_at', today())->delete();
                
                // Proses setiap item
                foreach ($data as $item) {
                    // Cari mapping kota
                    $bridging = BridgingKabkota::where('kabkota_id', $item['id'])->first();
                    
                    // Simpan data
                    SidikaryoPenempatan::create([
                        'id_kota' => $item['id'],
                        'kota' => $item['nmkabkota'],
                        'cjip_kota_id' => $bridging ? $bridging->cjip_kabkota_id : null,
                        'jmllaki' => $item['jmllaki'],
                        'jmlperempuan' => $item['jmlperempuan'],
                        'total' => $item['total'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                
                return Notification::make()
                    ->title('Data berhasil ditarik')
                    ->success()
                    ->send();
            } else {
                throw new \Exception('Gagal mengambil data dari API');
            }
        } catch (\Exception $e) {
            return Notification::make()
                ->title('Error: ' . $e->getMessage())
                ->danger()
                ->send();
        }
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
            'index' => Pages\ListPenempatans::route('/'),
            // 'create' => Pages\CreatePenempatan::route('/create'),
            // 'edit' => Pages\EditPenempatan::route('/{record}/edit'),
        ];
    }
}
