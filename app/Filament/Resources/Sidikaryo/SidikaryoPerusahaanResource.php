<?php

namespace App\Filament\Resources\Sidikaryo;

use App\Filament\Resources\Sidikaryo\SidikaryoPerusahaanResource\Pages;
use App\Filament\Resources\Sidikaryo\SidikaryoPerusahaanResource\RelationManagers;
use App\Models\Sidikaryo\SidikaryoPerusahaan;
use App\Models\SiRusa\Nib;
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
use Filament\Tables\Columns\BadgeColumn;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Sidikaryo\SidikaryoPerusahaanExport;
use Illuminate\Support\HtmlString;

class SidikaryoPerusahaanResource extends Resource
{

    protected static ?string $model = \App\Models\Sidikaryo\SidikaryoPerusahaan::class;

    protected static ?string $modelLabel = 'Data Perusahaan';
    protected static ?string $pluralModelLabel = 'Data Perusahaan';
    protected static ?string $title = 'Data Perusahaan';

    protected static ?string $navigationGroup = 'SIDIKARYO';
    protected static ?string $navigationLabel = 'Perusahaan'; 

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
            ->description(
            new HtmlString('
                <ul style="list-style: none; padding: 0; margin: 0; margin-bottom: 1rem;">
                    <li style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                        <span style="width: 12px; height: 12px; border-radius: 50%; background-color: #168E43; display: inline-block;"></span>
                        <span>Terintegrasi Si-Rusa</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="width: 12px; height: 12px; border-radius: 50%; background-color: #FBBF24; display: inline-block;"></span>
                        <span>Daftar Emakaryo via link CJIP</span>
                    </li>
                </ul>
            ')
            )
            ->columns([
                TextColumn::make('kabkota')
                    ->label('Kabupaten/Kota')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nib')
                ->label('NIB')
                ->searchable()
                ->sortable()
                ->formatStateUsing(function ($state) {
                    $existsInSirusa = Nib::where('nib', $state)->exists();
                    
                    if ($existsInSirusa) {
                            return $state . ' ✓'; // Tambahkan centang (✓)
                        }
                        
                        return $state;
                    })
                    ->color(function ($state) {
                        $existsInSirusa = Nib::where('nib', $state)->exists();
                        return $existsInSirusa ? 'primary' : 'gray'; // Biru jika ada, abu-abu jika tidak
                    })
                    ->icon(function ($state) {
                        $existsInSirusa = Nib::where('nib', $state)->exists();
                        return $existsInSirusa ? 'heroicon-o-check-circle' : null; // Icon centang dari Heroicons
                    })
                    ->iconPosition('after'),// Posisi icon di sebelah kanan teks
               TextColumn::make('name')
                    ->label('Nama Perusahaan')
                    ->searchable()
                    ->sortable()
                    ->color(function ($record) {
                        return $record->sumber == 99 ? 'warning' : null; // 'warning' adalah warna kuning di Filament
                    }),
                TextColumn::make('kontak')
                    ->label('No Telp / HP')
                    ->getStateUsing(function ($record) {
                        return trim("{$record->telpon} / {$record->hp}");
                    })
                    ->searchable(['telpon', 'hp']), // agar pencarian tetap bisa pakai telpon atau hp
                TextColumn::make('jumlah_lowongan')
                    ->label('Jumlah Lowongan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kebutuhan_l')
                    ->label('Kebutuhan L')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kebutuhan_p')
                    ->label('Kebutuhan P')
                    ->searchable()
                    ->sortable(),
                // TextColumn::make('sumber')
                //     ->label('Link Daftar')
                //     ->searchable()
                //     ->sortable(query: function (Builder $query, string $direction) {
                //         // Urutkan 99 dulu, baru 0
                //         $query->orderByRaw('sumber DESC'); // DESC agar 99 muncul di atas 0
                //     })
                //     ->formatStateUsing(fn ($state) => $state == 99 ? 'CJIP' : '-'),
                // TextColumn::make('jumlah_lamaran_menunggu')
                //     ->label('Jumlah Lamaran Menunggu')
                //     ->searchable()
                //     ->sortable(),
                // TextColumn::make('jumlah_lamaran_proses')
                //     ->label('Jumlah Lamaran Proses')
                //     ->searchable()
                //     ->sortable(),
                //  TextColumn::make('jumlah_lamaran_diterima')
                //     ->label('Jumlah Lamaran Diterima')
                //     ->searchable()
                //     ->sortable(),
            ])
            ->filters([
                //
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
                        new SidikaryoPerusahaanExport(), 
                        'sidikaryo-perusahaan-emakaryo-export-'.now()->format('Y-m-d').'.xlsx'
                    ))
                    ->color('success')
                    ->icon('heroicon-o-arrow-down-tray')
            ])
            ->actions([
                Action::make('tarikDataDetail')
                    ->label('Update Data')
                    ->requiresConfirmation()
                    ->modalHeading('Tarik Data Jumlah Lowongan')
                    ->modalSubheading('Data akan diambil dari API Bursa Kerja Jateng')
                    ->modalSubmitActionLabel('Ya, Tarik Data')
                    ->icon('heroicon-o-arrow-path')
                    ->color('primary')
                  
                    ->action(function ($record) {
                        $resource = new self(); // Membuat instance dari class saat ini (misalnya Resource class)
                        $resource->tarikDataDetailById($record->id_emakaryo); // Panggil method dengan id_emakaryo
                    }),
            ])
            ->bulkActions([
                //     Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public function tarikData()
    {
        try {
            // Ambil data dari API Penyedia Kerja
            $response = Http::get('https://bursakerja.jatengprov.go.id/api_v2/penyedia/index');
            
            if ($response->successful()) {
                $apiResponse = $response->json();

                // Validasi struktur response
                if (!isset($apiResponse['status']) || !$apiResponse['status'] || !isset($apiResponse['data'])) {
                    throw new \Exception('Format response API tidak valid');
                }

                $dataFromApi = $apiResponse['data'];

                // Pastikan $dataFromApi selalu array (jaga-jaga kalau hanya satu objek dikirim)
                if (isset($dataFromApi['id'])) {
                    // Jika $dataFromApi adalah 1 data (bukan array of data)
                    $dataFromApi = [$dataFromApi];
                }

                $countInserted = 0;
                $countSkipped = 0;
                $countUpdated = 0;

                foreach ($dataFromApi as $item) {
                    // Mapping kode kab/kota
                    $bridging = null;
                    if (isset($item['kabkota_kode'])) {
                        $bridging = BridgingKabkota::where('kabkota_id', $item['kabkota_kode'])->first();
                    }

                    // Cari apakah data sudah ada
                    $existingRecord = SidikaryoPerusahaan::where('id_emakaryo', $item['id'])->first();

                    $newData = [
                        'name' => $item['name'] ?? null,
                        'deskripsi' => $item['deskripsi'] ?? null,
                        'jenis_perusahaan' => $item['jenis_perusahaan'] ?? null,
                        'nib' => $item['nib'] ?? null,
                        'email' => $item['email'] ?? null,
                        'telpon' => $item['telpon'] ?? null,
                        'hp' => $item['hp'] ?? null,
                        'website' => $item['website'] ?? null,
                        'provinsi' => $item['provinsi'] ?? null,
                        'kabkota_kode' => $item['kabkota_kode'] ?? null,
                        'kabkota' => $item['kabkota'] ?? null,
                        'kecamatan' => $item['kecamatan'] ?? null,
                        'alamat' => $item['alamat'] ?? null,
                        'kodepos' => $item['kodepos'] ?? null,
                        'sumber' => $item['sumber'] ?? null,
                        'cjip_kota_id' => $bridging ? $bridging->cjip_kabkota_id : null,
                        'tanggal_daftar' => $item['tanggal_daftar'] ?? null,
                        'updated_at' => now(),
                    ];

                    if ($existingRecord) {
                        // Cek apakah ada perubahan
                        $existingRecord->fill($newData);
                        if ($existingRecord->isDirty()) {
                            $existingRecord->save();
                            $countUpdated++;
                        } else {
                            $countSkipped++;
                        }
                        continue;
                    }

                    // Jika belum ada, insert data baru
                    SidikaryoPerusahaan::create(array_merge([
                        'id_emakaryo' => $item['id'],
                        'created_at' => $item['created_at'] ?? now(),
                    ], $newData));

                    $countInserted++;
                }

                return Notification::make()
                    ->title('Berhasil Tarik Data Penyedia Kerja')
                    ->body("{$countInserted} data baru ditambahkan, {$countUpdated} diperbarui, {$countSkipped} dilewati.")
                    ->success()
                    ->send();
            } else {
                throw new \Exception('Gagal mengambil data dari API. Status: ' . $response->status());
            }
        } catch (\Exception $e) {
            return Notification::make()
                ->title('Error: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }

   public function tarikDataDetailById($id_emakaryo)
    {
        try {
            // Ambil data dari API Penyedia Kerja berdasarkan ID
            $response = Http::get('https://bursakerja.jatengprov.go.id/api_v2/penyedia/detail', [
                'id_emakaryo' => $id_emakaryo
            ]);

            if ($response->successful()) {
                $apiResponse = $response->json();

                // Validasi struktur response
                if (!isset($apiResponse['status']) || !$apiResponse['status'] || !isset($apiResponse['data'][0])) {
                    throw new \Exception('Format response API tidak valid atau data kosong');
                }

                $item = $apiResponse['data'][0];

                // Ambil record yang sudah ada
                $existingRecord = SidikaryoPerusahaan::where('id_emakaryo', $id_emakaryo)->first();

                // Data baru yang ingin diupdate
                $newData = [
                    'posted_by' => $item['posted_by'] ?? null,
                    'jumlah_lowongan' => $item['jumlah_lowongan'] ?? null,
                    'kebutuhan_l' => $item['total_pria'] ?? null,
                    'kebutuhan_p' => $item['total_wanita'] ?? null,
                    'updated_at' => now()
                ];

                if ($existingRecord) {
                    $existingRecord->fill($newData);
                    if ($existingRecord->isDirty()) {
                        $existingRecord->save();
                        $status = "Data berhasil diperbarui.";
                    } else {
                        $status = "Tidak ada perubahan data.";
                    }
                } else {
                    // Jika tidak ditemukan, insert baru
                    SidikaryoPerusahaan::create(array_merge([
                        'id_emakaryo' => $id_emakaryo,
                        'created_at' => now()
                    ], $newData));
                    $status = "Data baru berhasil ditambahkan.";
                }

                return Notification::make()
                    ->title('Sinkronisasi Penyedia Kerja')
                    ->body($status)
                    ->success()
                    ->send();
            } else {
                throw new \Exception('Gagal mengambil data dari API. Status: ' . $response->status());
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
            'index' => Pages\ListSidikaryoPerusahaans::route('/'),
            // 'create' => Pages\CreateSidikaryoPerusahaan::route('/create'),
            // 'edit' => Pages\EditSidikaryoPerusahaan::route('/{record}/edit'),
        ];
    }

    public function updateMasalEmakaryo()
    {
        // Get all perusahaan emakaryo data
        $emakaryo = SidikaryoPerusahaan::all();

        // Check if data exists
        if ($emakaryo->isNotEmpty()) {
            // Process each emakaryo record
            foreach ($emakaryo as $emakaryoItem) {
                $this->tarikDataDetailById($emakaryoItem->id_emakaryo);
            }
            
            return true; // Or you can return a success message
        }
        
        return false; // Or you can return a message indicating no data was found
    }
}
