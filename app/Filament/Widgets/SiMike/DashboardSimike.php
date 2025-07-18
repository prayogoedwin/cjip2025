<?php

namespace App\Filament\Widgets\SiMike;

use App\Models\Cjip\Kabkota;
use App\Models\Cjip\Sektor;
use App\Models\SiMike\Proyek;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Widgets\StatsOverviewWidget;
use Illuminate\Contracts\View\View;

use Filament\Widgets\Widget;
use Livewire\Component;

class DashboardSimike extends Widget implements HasForms
{
    use HasWidgetShield;

    use InteractsWithForms;
    protected static ?int $sort = 2;
    protected static bool $isLazy = true;
    protected int|string|array $columnSpan = 'full';

    protected $simike, $sirusa, $nibs;

    public $proyek,
        $tk,
        $nib,
        $nib_anomaly,
        $pma_count,
        $pmdn_count,
        $nonpmapmdn_count,
        $pma,
        $pmdn,
        $nonpmapmdn,
        $kab_proyeks,
        $total_realisasi,
        $kab_realisasi;

    //FILTERS
    public
        $tahun,
        $triwulan,
        $kabkota,
        $sektor,
        $kbli,
        $uraian_skala_usaha,
        $kecamatan_usaha,

        $superadmin,
        $admin;

    public $start, $end, $tanggal_terbit_oss;

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
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('d M Y')
                                    // ->default($this->start)
                                    ,
                                DatePicker::make('end')
                                    ->label('Tanggal Akhir')
                                    ->disableLabel()
                                    ->placeholder('Akhir')
                                    ->format('d M Y')
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('d M Y')
                                    // ->default($this->end),
                            ])->columns(2),
                        ])

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
                            ->searchable()
                    ])
            ])

        ];
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
            ['kabkota' => $this->superadmin],
            ['sektor' => $this->sektor],
            ['uraian_skala_usaha' => $this->uraian_skala_usaha],
            ['kecamatan_usaha' => $this->kecamatan_usaha]
        );
    }

    public function mount()
    {
        $this->tahun = now()->year;
        $this->start = Carbon::now()->startOfYear()->format('d M Y');
        $this->end = Carbon::now()->format('d M Y');
        $this->tanggal_terbit_oss = $this->start . ' - ' . $this->end;
        
    }

    // public function render(): View
    // {
    //     if (auth()->user()->hasRole('kabkota')) {
    //         $this->simike = Proyek::filterMikro($this->tanggal_terbit_oss, $this->tahun, $this->triwulan, auth()->user()->kabkota->id, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
    //             ->first();
    //     } else {
    //         $this->simike = Proyek::filterMikro($this->tanggal_terbit_oss, $this->tahun, $this->triwulan, $this->kabkota, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
    //             ->first();
    //     }

    //     if (auth()->user()->hasRole('kabkota')) {
    //         $this->nib = Proyek::filterMikro($this->tanggal_terbit_oss, $this->tahun, $this->triwulan, auth()->user()->kabkota->id, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
    //             ->groupBy('nib')
    //             ->where('dikecualikan', false)
    //             ->where('is_mapping', true)
    //             ->get()
    //             ->count();
    //     } else {
    //         $this->nib = Proyek::filterMikro($this->tanggal_terbit_oss, $this->tahun, $this->triwulan, $this->kabkota, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
    //             ->where('dikecualikan', false)
    //             ->where('is_mapping', true)
    //             ->groupBy(['nib', 'kab_kota_id'])
    //             ->get()
    //             ->count();
    //     }

    //     if (auth()->user()->hasRole('kabkota')) {
    //         $this->nib_anomaly = Proyek::filterMikro($this->tanggal_terbit_oss, $this->tahun, $this->triwulan, auth()->user()->kabkota->id, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
    //             ->groupBy('nib')
    //             ->where('dikecualikan', true)
    //             ->where('is_mapping', false)
    //             ->get()
    //             ->count();
    //     } else {
    //         $this->nib = Proyek::filterMikro($this->tanggal_terbit_oss, $this->tahun, $this->triwulan, $this->kabkota, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
    //             ->where('dikecualikan', false)
    //             ->where('is_mapping', true)
    //             ->groupBy(['nib', 'kab_kota_id'])
    //             ->get()
    //             ->count();
    //     }

    //     // dd($this->start, $this->end, $this->tanggal_terbit_oss);

    //     $tanggal = $this->tanggal_terbit_oss ?? $this->start . ' - ' . $this->end;
    //     $tahun = $this->tahun;
    //     $triwulan = $this->triwulan;
    //     $sektor = $this->sektor;
    //     $uraian_skala_usaha = $this->uraian_skala_usaha;
    //     $kecamatan_usaha = $this->kecamatan_usaha;
    //     $simike = $this->simike;
    //     $nib = $this->nib;

    //     return view('filament.widgets.si-mike.dashboard-simike', compact('tanggal', 'tahun', 'triwulan', 'simike', 'nib'));
    // }

    public function render(): View
{
    $kabkotaId = auth()->user()->hasRole('kabkota') 
        ? auth()->user()->kabkota->id 
        : $this->kabkota;

    // Query summary utama (yang valid)
    $this->simike = Proyek::filterMikro(
        $this->tanggal_terbit_oss, 
        $this->tahun, 
        $this->triwulan, 
        $kabkotaId, 
        $this->sektor, 
        $this->uraian_skala_usaha, 
        $this->kecamatan_usaha
    )->first();

    // Query jumlah NIB unik valid
    $this->nib = Proyek::query()
        ->when($this->tanggal_terbit_oss, function ($query) {
            $dates = explode(' - ', $this->tanggal_terbit_oss);
            $start = date('Y-m-d', strtotime(str_replace('/', '-', trim($dates[0]))));
            $end = date('Y-m-d 23:59:59', strtotime(str_replace('/', '-', trim($dates[1]))));
            $query->whereBetween('tanggal_terbit_oss', [$start, $end]);
        })
        ->when($this->tahun, fn($q) => $q->where('tahun', $this->tahun))
        ->when($this->triwulan, fn($q) => $q->where('triwulan', $this->triwulan))
        ->when($kabkotaId, fn($q) => $q->where('kab_kota_id', $kabkotaId))
        ->when($this->sektor, fn($q) => $q->where('sektor_id', $this->sektor))
        ->when($this->uraian_skala_usaha, fn($q) => $q->where('uraian_skala_usaha', $this->uraian_skala_usaha))
        ->when($this->kecamatan_usaha, fn($q) => $q->where('kecamatan_usaha', $this->kecamatan_usaha))
        ->where('dikecualikan', 0)
        ->where('is_mapping', 1)
        ->distinct('nib')
        ->count('nib');

    // Query jumlah NIB anomali
    $this->nib_anomaly = Proyek::query()
        ->when($this->tanggal_terbit_oss, function ($query) {
            $dates = explode(' - ', $this->tanggal_terbit_oss);
            $start = date('Y-m-d', strtotime(str_replace('/', '-', trim($dates[0]))));
            $end = date('Y-m-d 23:59:59', strtotime(str_replace('/', '-', trim($dates[1]))));
            $query->whereBetween('tanggal_terbit_oss', [$start, $end]);
        })
        ->when($this->tahun, fn($q) => $q->where('tahun', $this->tahun))
        ->when($this->triwulan, fn($q) => $q->where('triwulan', $this->triwulan))
        ->when($kabkotaId, fn($q) => $q->where('kab_kota_id', $kabkotaId))
        ->when($this->sektor, fn($q) => $q->where('sektor_id', $this->sektor))
        ->when($this->uraian_skala_usaha, fn($q) => $q->where('uraian_skala_usaha', $this->uraian_skala_usaha))
        ->when($this->kecamatan_usaha, fn($q) => $q->where('kecamatan_usaha', $this->kecamatan_usaha))
        ->where('dikecualikan', 1)
        ->where('is_mapping', 0)
        ->distinct('nib')
        ->count('nib');

    $tanggal = $this->tanggal_terbit_oss ?? $this->start . ' - ' . $this->end;
    $tahun = $this->tahun;
    $triwulan = $this->triwulan;
    $sektor = $this->sektor;
    $uraian_skala_usaha = $this->uraian_skala_usaha;
    $kecamatan_usaha = $this->kecamatan_usaha;
    $simike = $this->simike;
    $nib = $this->nib;
    $nib_anomaly = $this->nib_anomaly;

    return view('filament.widgets.si-mike.dashboard-simike', compact(
        'tanggal',
        'tahun',
        'triwulan',
        'simike',
        'nib',
        'nib_anomaly'
    ));
}

}
