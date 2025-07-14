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
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Carbon;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Sidikaryo\SidikaryoDapodikExport;
use Illuminate\Support\Facades\Http;



class DapodikResource extends Resource
{
    protected static ?string $model = \App\Models\Sidikaryo\SidikaryoDapodik::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
       // Custom labels
    protected static ?string $modelLabel = 'Data Dapodik';
    protected static ?string $pluralModelLabel = 'Data Dapodik';
    protected static ?string $title = 'Data Dapodik Sekolah';

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
                        
                    // TextColumn::make('jumlah_laki_laki')
                    //     ->label('Jumlah Laki-laki')
                    //     ->numeric()
                    //     ->sortable()
                    //     ->alignRight(),
                        
                    // TextColumn::make('jumlah_perempuan')
                    //     ->label('Jumlah Perempuan')
                    //     ->numeric()
                    //     ->sortable()
                    //     ->alignRight(),
                        
                    // TextColumn::make('siswa_laki12')
                    //     ->label('Siswa Laki Kelas 12')
                    //     ->numeric()
                    //     ->sortable()
                    //     ->alignRight(),
                        
                    // TextColumn::make('siswa_perempuan12')
                    //     ->label('Siswa Perempuan Kelas 12')
                    //     ->numeric()
                    //     ->sortable()
                    //     ->alignRight(),
                        
                    // TextColumn::make('siswa_laki13')
                    //     ->label('Siswa Laki Kelas 13')
                    //     ->numeric()
                    //     ->sortable()
                    //     ->alignRight(),
                        
                    // TextColumn::make('siswa_perempuan13')
                    //     ->label('Siswa Perempuan Kelas 13')
                    //     ->numeric()
                    //     ->sortable()
                    //     ->alignRight(),
                   TextColumn::make('bentuk_pendidikan_id')
                    ->label('Jenjang Sekolah')
                    ->formatStateUsing(fn (int $state): string => match ($state) {
                        13 => 'SMA',
                        15 => 'SMK',
                        default => 'Lainnya',
                    })
                    ->searchable()
                    ->sortable(),
                    TextColumn::make('jurusan')
                        ->label('Jurusan')
                        ->searchable()
                        ->sortable(),
                        
                    TextColumn::make('kelulusan_laki')
                        ->label('Kelulusan Laki-laki')
                        ->numeric()
                        ->sortable()
                        ->alignRight(),
                    TextColumn::make('kelulusan_perempuan')
                        ->label('Kelulusan Perempuan')
                        ->numeric()
                        ->sortable()
                        ->alignRight(),
                     TextColumn::make('total_jumlah_potensi')
                        ->label('Total Kelulusan')
                        ->numeric()
                        ->sortable()
                        ->alignRight(),
                        
                    TextColumn::make('cjip_kota_id')
                        ->label('CJIP Kota ID')
                        ->numeric()
                        ->sortable(),
                        
                    TextColumn::make('kabkota_id')
                        ->label('Kab/Kota ID')
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
                    ->modalHeading('Tarik Data Dapodik ')
                    ->modalSubheading('Data akan diambil dari API Dapodik')
                    ->modalSubmitActionLabel('Ya, Tarik Data'),
                Action::make('rekap')
                    ->label('Rekap Data')
                    ->url(static::getUrl('rekap'))
                    ->color('success')
                    ->icon('heroicon-o-document-chart-bar'),

                Action::make('export')
                    ->label('Export Excel')
                    ->action(fn () => Excel::download(
                        new SidikaryoDapodikExport(), 
                        'sidikaryo-dapodik-export-'.now()->format('Y-m-d').'.xlsx'
                    ))
                    ->color('success')
                    ->icon('heroicon-o-arrow-down-tray')
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

    public function tarikData_BAK()
    {
       sleep(5);
       return Notification::make()
                    ->title('Berhasil Tarik Data Dapodik')
                    // ->body("{$countInserted} data baru ditambahkan, {$countUpdated} diperbarui, {$countSkipped} dilewati.")
                    ->success()
                    ->send();
    }

    public function tarikData()
    {
        try {
            // Mendapatkan tahun saat ini
            $tahunSekarang = date('Y');

            // Menentukan semester berdasarkan bulan saat ini
            $bulanSekarang = date('n');
            $semester = ($bulanSekarang >= 1 && $bulanSekarang <= 7) ? $tahunSekarang . '1' : $tahunSekarang . '2';

            $tahunData = $tahunSekarang - 1;

            $response = Http::withOptions([
                'verify' => false, // Nonaktifkan SSL verify (sementara)
                'timeout' => 120, // Timeout 120 detik
            ])
            ->withHeaders([
                'Accept' => 'application/json',
                'User-Agent' => 'Filament-App/1.0',
            ])
            ->retry(3, 5000) // 3x percobaan, interval 5 detik
            ->get('https://mantra.jatengprov.go.id/json/dikbud/rekap_kelulusan', [
                'semester' => $semester,
                'tahun' => $tahunSekarang
            ]);
            
            if ($response->successful()) {
                $responseData = $response->json();
                
                // Pastikan struktur data sesuai
                if (!isset($responseData['response']['data']['rekap_kelulusan'])) {
                    throw new \Exception('Struktur data API tidak sesuai');
                }
                
                $data = $responseData['response']['data']['rekap_kelulusan'];
                $dataperiode = $responseData['response']['dataperiode'] ?? now();
                
                // Hapus data yang ada
                SidikaryoDapodik::truncate();

                foreach ($data as $item) {
                    $kode = '3' . str_pad($item['kode_wilayah'] ?? '', 3, '0', STR_PAD_LEFT);

                    $bridging = null;
                    if (isset($item['kode_wilayah'])) {
                        $bridging = BridgingKabkota::where('kabkota_id', $kode)->first();
                    }

                    if ($item['kode_wilayah'] != '') {

                        $tolkel = $item['kelulusan_laki'] + $item['kelulusan_perempuan'];
                
                        SidikaryoDapodik::create([
                            'tahun_tarik' => $tahunSekarang,
                            'tahun_data' => $tahunData,
                            'semester' => $item['semester_id'],
                            'kode_kabkota' => $item['kode_wilayah'] ?? null,
                            'kab_kota' => $item['nm_rayon'] ?? null,
                            'cjip_kota_id' => $bridging ? $bridging->cjip_kabkota_id : null,
                            'kabkota_id' => $bridging ? $bridging->kabkota_id : null,
                            'bentuk_pendidikan_id' => $item['bentuk_pendidikan_id'],
                            'nama_sma_smk' => $item['nama_sekolah'] ?? null,
                            'jumlah_laki_laki' => $item['jumlah_laki'] ?? 0,
                            'jumlah_perempuan' => $item['jumlah_perempuan'] ?? 0,
                            'siswa_laki12' => $item['jumlah_laki12'] ?? 0,
                            'siswa_perempuan12' => $item['jumlah_perempuan12'] ?? 0,
                            'siswa_laki13' => $item['jumlah_laki13'] ?? 0,
                            'siswa_perempuan13' => $item['jumlah_perempuan13'] ?? 0,
                            'jurusan' => $item['jurusan'] ?? null,
                            'kelulusan_laki' => $item['kelulusan_laki'] ?? 0,
                            'kelulusan_perempuan' => $item['kelulusan_perempuan'] ?? 0,
                            'total_jumlah_potensi' => $tolkel,
                            'dataperiode' => $dataperiode,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                    }
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
}
