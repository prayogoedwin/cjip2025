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
                                    ->hiddenLabel()
                                    ->placeholder('Awal')
                                    ->format('Y-m-d')
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('Y-m-d'),
                                DatePicker::make('end')
                                    ->label('Tanggal Akhir')
                                    ->hiddenLabel()
                                    ->placeholder('Akhir')
                                    ->format('Y-m-d')
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('Y-m-d')
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
                                $user = auth()->user();
                                if (!$user->hasRole('kabkota') || !$user->kabkota) {
                                    return [];
                                }
                                $kecamatan = Proyek::where('kab_kota_id', $user->kabkota->id)
                                    ->whereNotNull('kecamatan_usaha')
                                    ->pluck('kecamatan_usaha')
                                    ->unique()
                                    ->values()
                                    ->toArray();
                                return collect($kecamatan)->mapWithKeys(fn($val) => [$val => $val])->toArray();
                            })
                            ->visible(fn() => auth()->user()->hasRole('kabkota')),
                        Select::make('sektor')->label('Kategori')
                            ->options(Sektor::select('id', 'sektor')->groupBy('sektor')->distinct()->get()->pluck('sektor', 'id'))
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

        $this->dispatch('filterUpdated', [
            'tanggal' => $this->tanggal_terbit_oss,
            'tahun' => $this->tahun,
            'triwulan' => $this->triwulan,
            'kabkota' => $this->kabkota,
            'sektor' => $this->sektor,
            'uraian_skala_usaha' => $this->uraian_skala_usaha,
            'kecamatan_usaha' => $this->kecamatan_usaha
        ]);
    }

    public function mount()
    {
        $this->tahun = now()->year;
        $this->start = now()->startOfYear()->format('Y-m-d');
        $this->end = now()->format('Y-m-d');
        $this->tanggal_terbit_oss = $this->start . ' - ' . $this->end;
    }

    public function render(): View
    {
        $kabkotaId = auth()->user()->hasRole('kabkota')
            ? auth()->user()->kabkota->id
            : $this->kabkota;

        $this->simike = Proyek::filterMikro(
            $this->tanggal_terbit_oss,
            $this->tahun,
            $this->triwulan,
            $kabkotaId,
            $this->sektor,
            $this->uraian_skala_usaha,
            $this->kecamatan_usaha
        )->first();

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

        $tanggal = $this->tanggal_terbit_oss ?? $this->start . ' - ' . $this->end;
        $tahun = $this->tahun;
        $triwulan = $this->triwulan;
        $sektor = $this->sektor;
        $uraian_skala_usaha = $this->uraian_skala_usaha;
        $kecamatan_usaha = $this->kecamatan_usaha;
        $simike = $this->simike;
        $nib = $this->nib;

        return view('filament.widgets.si-mike.dashboard-simike', compact(
            'tanggal',
            'tahun',
            'triwulan',
            'simike',
            'nib',
        ));
    }
}
