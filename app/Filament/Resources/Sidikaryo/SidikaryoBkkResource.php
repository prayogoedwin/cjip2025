<?php

namespace App\Filament\Resources\Sidikaryo;

use App\Filament\Resources\Sidikaryo\SidikaryoBkkResource\Pages;
use App\Filament\Resources\Sidikaryo\SidikaryoBkkResource\RelationManagers;
use App\Models\Sidikaryo\SidikaryoBkk;
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
use Filament\Tables\Filters\SelectFilter;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Sidikaryo\SidikaryoPkkExport;

class SidikaryoBkkResource extends Resource
{
    protected static ?string $model = \App\Models\Sidikaryo\SidikaryoBkk::class;

     protected static ?string $modelLabel = 'Data BKK';
    protected static ?string $pluralModelLabel = 'Data BKK';
    protected static ?string $title = 'Data BKK';

    protected static ?string $navigationGroup = 'SIDIKARYO';
    protected static ?string $navigationLabel = 'BKK'; 

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

                TextColumn::make('nama_sekolah')
                ->label('Nama Sekolah')
                ->searchable()
                ->sortable(),

                TextColumn::make('nama_bkk')
                ->label('Nama BKK')
                ->searchable()
                ->sortable(),

                TextColumn::make('telpon')
                ->label('Telp')
                ->searchable()
                ->sortable(),

                TextColumn::make('hp')
                ->label('HP')
                ->searchable()
                ->sortable(),

                TextColumn::make('email')
                ->label('Email')
                ->searchable()
                ->sortable(),

                TextColumn::make('website')
                ->label('Website')
                ->searchable()
                ->sortable(),

                TextColumn::make('contact_person')
                ->label('PJ')
                ->searchable()
                ->sortable(),

                TextColumn::make('jabatan')
                ->label('Jabatan')
                ->searchable()
                ->sortable(),
                
                TextColumn::make('alamat')
                ->label('Alamat')
                ->sortable(),
            ])


           ->filters([
                SelectFilter::make('kota')
                    ->label('Filter Kabupaten/Kota')
                    ->options(function () {
                        // Assuming you're using Eloquent, get unique kota values
                        return BridgingKabkota::query()
                            ->select('nama_kota')
                            ->distinct()
                            ->orderBy('nama_kota')
                            ->pluck('nama_kota', 'nama_kota')
                            ->toArray();
                    })
                    ->searchable() // Optional: makes the filter searchable if there are many options
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
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
            ->get('https://bursakerja.jatengprov.go.id/api_v2/bkk/index');
            
                            
                            if ($response->successful()) {
                                $data = $response->json();
                                
                                // Hapus data hari ini jika sudah ada
                                // SidikaryoBkk::whereDate('created_at', today())->delete();
                                SidikaryoBkk::truncate();
                                
                                foreach ($data as $item) {
                                    $bridging = BridgingKabkota::where('kabkota_id', $item['id_kota'])->first();
                                    
                                    SidikaryoBkk::create([
                                        'nama_sekolah' => $item['nama_sekolah'],
                                        'nama_bkk' => $item['nama_bkk'],
                                        'cjip_kota_id' => $bridging ? $bridging->cjip_kabkota_id : null,
                                        'id_kota' => $item['id_kota'],
                                        'hp' => $item['hp'],
                                        'email' => $item['email'],
                                        'website' => $item['website'],
                                        'contact_person' => $item['contact_person'],
                                        'jabatan' => $item['jabatan'],
                                        'alamat' => $item['alamat'],
                                        'kota' => $item['kota'],
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
                    ->modalHeading('Tarik Data BKK')
                    ->modalSubheading('Data akan diambil dari API Bursa Kerja Jateng')
                    ->modalButton('Proses')
                    ->modalCloseButton(false),

                Action::make('export')
                    ->label('Export Excel')
                    ->action(fn () => Excel::download(
                        new SidikaryoPkkExport(), 
                        'sidikaryo-bkk-export-'.now()->format('Y-m-d').'.xlsx'
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
            $response = Http::get('https://bursakerja.jatengprov.go.id/api_v2/bkk/index');
            
            if ($response->successful()) {
                $data = $response->json();
                
                // Hapus data hari ini jika sudah ada
                //SidikaryoPencaker::whereDate('created_at', today())->delete();
                SidikaryoBkk::truncate();
                
                // Proses setiap item
                foreach ($data as $item) {
                    // Cari mapping kota
                    $bridging = BridgingKabkota::where('kabkota_id', $item['id_kota'])->first();
                    
                    // Simpan data
                     SidikaryoBkk::create([
                        'nama_sekolah' => $item['nama_sekolah'],
                        'nama_bkk' => $item['nama_bkk'],
                        'cjip_kota_id' => $bridging ? $bridging->cjip_kabkota_id : null,
                        'id_kota' => $item['id_kota'],
                        'hp' => $item['hp'],
                        'email' => $item['email'],
                        'website' => $item['website'],
                        'contact_person' => $item['contact_person'],
                        'jabatan' => $item['jabatan'],
                        'alamat' => $item['alamat'],
                        'kota' => $item['kota'],
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
            'index' => Pages\ListSidikaryoBkks::route('/'),
            // 'create' => Pages\CreateSidikaryoBkk::route('/create'),
            //'edit' => Pages\EditSidikaryoBkk::route('/{record}/edit'),
        ];
    }
}
