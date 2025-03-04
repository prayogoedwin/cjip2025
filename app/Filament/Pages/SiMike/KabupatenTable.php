<?php

namespace App\Filament\Pages\SiMike;

use App\Filament\Widgets\SiMike\KabupatenTable as SiMikeKabupatenTable;
use App\Filament\Widgets\TopProyekChart;
use App\Models\Cjip\Kabkota;
use App\Models\Cjip\Sektor;
use App\Models\SiMike\Proyek;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;

class KabupatenTable extends Page
{
    use HasPageShield;
    protected static ?string $navigationLabel = "Rekap Kabupaten/Kota";
    protected static ?string $label = 'Rekap Kabupaten/Kota';
    protected static ?string $title = 'Rekap Kabupaten/Kota';
    protected static ?string $pluralLabel = 'Rekap Kabupaten/Kota';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = "Si-Mike";
    protected static string $view = 'filament.pages.si-mike.kabupaten-table';

    public $tahun,
        $triwulan,
        $kabkota,
        $sektor,
        $kbli,
        $uraian_skala_usaha,
        $kecamatan_usaha,
        $start, $end, $tanggal_terbit_oss,
        $superadmin;

    protected function getFormSchema(): array
    {
        return [
            \Filament\Forms\Components\Card::make()->schema([
                Grid::make([
                    'sm' => 1,
                    'xl' => 1,
                ])->schema([
                    Select::make('tahun')
                        ->default(now()->year)
                        ->searchable()
                        ->required()
                        ->options(fn() => array_combine(
                            $years = range(now()->year, now()->year - 2),
                            $years
                        )),

                    Fieldset::make('Tanggal Terbit Oss')
                        ->schema([
                            Grid::make()->schema([
                                DatePicker::make('start')
                                    ->label('Tanggal Awal')
                                    ->disableLabel()
                                    ->placeholder('Awal')
                                    ->format('d M Y')
                                    ->native(false)
                                    ->displayFormat('d M Y')
                                    ->default($this->start),
                                DatePicker::make('end')
                                    ->label('Tanggal Akhir')
                                    ->disableLabel()
                                    ->placeholder('Akhir')
                                    ->format('d M Y')
                                    ->native(false)
                                    ->displayFormat('d M Y')
                                    ->default($this->end),
                            ])->columns(2),
                        ]),
                ]),

                Grid::make([
                    'sm' => 2,
                    'xl' => 4,
                ])
                    ->schema([
                        Select::make('uraian_skala_usaha')
                            ->label('Skala Usaha')
                            ->options([
                                'Usaha Mikro' => 'Usaha Mikro',
                                'Usaha Kecil' => 'Usaha Kecil',
                            ])
                            ->default($this->uraian_skala_usaha),

                        Select::make('triwulan')
                            ->options([
                                1 => 'I',
                                2 => 'II',
                                3 => 'III',
                                4 => 'IV',
                            ])
                            ->searchable()
                            ->default(function () {
                                $bulan_ini = Carbon::now()->month;
                                if ($bulan_ini <= 3) {
                                    return 1;
                                } elseif ($bulan_ini >= 3 && $bulan_ini <= 6) {
                                    return 2;
                                } elseif ($bulan_ini >= 6 && $bulan_ini <= 9) {
                                    return 3;
                                } elseif ($bulan_ini >= 9 && $bulan_ini <= 12) {
                                    return 4;
                                }
                                return null;
                            }),

                        Select::make('kabkota')->label('Kabupaten/Kota')
                            ->options(Kabkota::all()->pluck('nama', 'id'))
                            ->searchable()
                            ->visible(function () {
                                if (auth()->user()->hasRole('kabkota')) {
                                    return false;
                                }
                                return true;
                            }),

                        Select::make('kecamatan_usaha')->label('Kecamatan Usaha')
                            ->searchable()
                            ->options(function () {
                                $kec_usahas = Proyek::where('kab_kota_id', auth()->user()->kabkota->id)
                                    ->whereNotNull('kecamatan_usaha')
                                    ->pluck('kecamatan_usaha')
                                    ->filter() 
                                    ->toArray();
                                if (!empty($kec_usahas)) {
                                    $kec_usaha = array_combine($kec_usahas, $kec_usahas);
                                } else {
                                    $kec_usaha = [];
                                }

                                return $kec_usaha;
                            })
                            ->visible(fn() => auth()->user()->hasRole('kabkota')),

                        Select::make('sektor')->label('Kategori')
                            ->options(Sektor::groupBy('sektor')->pluck('sektor', 'id'))
                            ->searchable(),
                    ])
            ])
        ];
    }

    public function mount()
    {
        $this->tahun = now()->year;
        $this->start = Carbon::now()->startOfYear()->format('d M Y');
        $this->end = Carbon::now()->format('d M Y');
        $this->tanggal_terbit_oss = $this->start . ' - ' . $this->end;
    }

    public function submit()
    {
        if ($this->start && $this->end) {
            $this->tanggal_terbit_oss = $this->start . ' - ' . $this->end;
        } else {
            $this->tanggal_terbit_oss = null;
        }
        $this->tahun = $this->form->getState()['tahun'];
        $this->triwulan = $this->form->getState()['triwulan'];
        if (auth()->user()->hasRole('kabkota')) {
            $this->kabkota = auth()->user()->kabkota->id;
        } else {
            $this->kabkota = $this->form->getState()['kabkota'];
        }
        $this->sektor = $this->form->getState()['sektor'];
        $this->uraian_skala_usaha = $this->form->getState()['uraian_skala_usaha'];

        $this->dispatch(
            'filterUpdated',
            ['tanggal' => $this->tanggal_terbit_oss],
            ['tahun' => $this->tahun],
            ['triwulan' => $this->triwulan],
            ['kabkota' => $this->kabkota],
            ['sektor' => $this->sektor],
            ['uraian_skala_usaha' => $this->uraian_skala_usaha],
            ['kecamatan_usaha' => $this->kecamatan_usaha]
        );
    }

    protected function getFooterWidgets(): array
    {
        return [
            SiMikeKabupatenTable::class,
        ];
    }
}
