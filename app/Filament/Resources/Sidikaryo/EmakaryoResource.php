<?php

namespace App\Filament\Resources\Sidikaryo;

use App\Filament\Resources\Sidikaryo\EmakaryoResource\Pages;
use App\Filament\Resources\Sidikaryo\EmakaryoResource\RelationManagers;
use App\Models\Sidikaryo\SidikaryoPencaker;
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
use App\Exports\Sidikaryo\SidikaryoPencakerExport;

class EmakaryoResource extends Resource
{
    // protected static ?string $model = Emakaryo::class;
    protected static ?string $model = \App\Models\Sidikaryo\SidikaryoPencaker::class;

    protected static ?string $modelLabel = 'Data Pencari Kerja';
    protected static ?string $pluralModelLabel = 'Data Pencari Kerja';
    protected static ?string $title = 'Data Pencari Kerja';


    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'SIDIKARYO';
    protected static ?string $navigationLabel = 'Pencaker'; 
    // protected static ?string $navigationIcon = 'heroicon-o-document-text'; // Ganti icon sesuai kebutuhan

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
                
            TextColumn::make('l')
                ->label('Laki-laki')
                ->numeric()
                ->sortable()
                ->alignRight(),
                
            TextColumn::make('p')
                ->label('Perempuan')
                ->numeric()
                ->sortable()
                ->alignRight(),
                
            TextColumn::make('lulusan_sma_smk')
                ->label('SMA/SMK')
                ->numeric()
                ->sortable()
                ->alignRight(),
                
            TextColumn::make('lulusan_dibawah_sma_smk')
                ->label('Di Bawah SMA')
                ->numeric()
                ->sortable()
                ->alignRight(),
                
            TextColumn::make('lulusan_sarjana_keatas')
                ->label('Sarjana+')
                ->numeric()
                ->sortable()
                ->alignRight(),
            
            TextColumn::make('jurusan_terbanyak')
                ->label('Jurusan Terbanyak')
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
                    // ->icon('heroicon-o-cloud-arrow-down')
                    ->color('success')
                    ->action(function () {
                    // Create new instance and call the method
                    $resource = new self();
                    $resource->tarikData();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Tarik Data Penyedia Kerja')
                    ->modalSubheading('Data akan diambil dari API Bursa Kerja Jateng')
                    ->modalSubmitActionLabel('Ya, Tarik Data'),

                Action::make('export')
                    ->label('Export Excel')
                    ->action(fn () => Excel::download(
                        new SidikaryoPencakerExport(), 
                        'sidikaryo-pencaker-export-'.now()->format('Y-m-d').'.xlsx'
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
            $response = Http::withOptions([
                'verify' => false, // Nonaktifkan SSL verify (sementara)
                'timeout' => 120, // Timeout 120 detik
            ])
            ->withHeaders([
                'Accept' => 'application/json',
                'User-Agent' => 'Filament-App/1.0',
            ])
            ->retry(3, 5000) // 3x percobaan, interval 5 detik
            ->get('https://bursakerja.jatengprov.go.id/api_v2/rekap/pencaker');
            
            if ($response->successful()) {
                $data = $response->json();
                
                // Hapus data hari ini jika sudah ada
                //SidikaryoPencaker::whereDate('created_at', today())->delete();
                SidikaryoPencaker::truncate();
                
                foreach ($data as $item) {
                    $bridging = BridgingKabkota::where('kabkota_id', $item['id_kota'])->first();
                    
                    SidikaryoPencaker::create([
                        'id_kota' => $item['id_kota'],
                        'kota' => $item['kota'],
                        'cjip_kota_id' => $bridging ? $bridging->cjip_kabkota_id : null,
                        'l' => $item['l'],
                        'p' => $item['p'],
                        'lulusan_sma_smk' => $item['lulusan_sma_smk'],
                        'lulusan_dibawah_sma_smk' => $item['lulusan_dibawah_sma_smk'],
                        'lulusan_sarjana_keatas' => $item['lulusan_sarjana_keatas'],
                        'jurusan_terbanyak' => $item['jurusan_terbanyak'],
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
            'index' => Pages\ListEmakaryos::route('/'),
            // 'create' => Pages\CreateEmakaryo::route('/create'),
            // 'edit' => Pages\EditEmakaryo::route('/{record}/edit'),
        ];
    }
}
