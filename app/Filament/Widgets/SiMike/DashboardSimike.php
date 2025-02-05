<?php

namespace App\Filament\Widgets\Simike;

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
    protected static ?string $pollingInterval = null;
    protected static bool $isLazy = false;
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
                        ->default(Carbon::now()->year)
                        ->searchable()
                        ->required()
                        ->options(function () {
                            $currentYear = Carbon::now()->year;
                            $years = range($currentYear, $currentYear - 5);
                            return array_combine($years, $years);
                        }),
                    Fieldset::make('Tanggal Terbit Oss')
                        ->schema([
                            Grid::make()->schema([
                                DatePicker::make('start')
                                    ->label('Tanggal Awal')
                                    ->disableLabel()
                                    ->placeholder('Awal')
                                    ->format('d M Y')
                                    ->displayFormat('d M Y'),
                                DatePicker::make('end')
                                    ->label('Tanggal Akhir')
                                    ->disableLabel()
                                    ->placeholder('Akhir')
                                    ->format('d M Y')
                                    ->displayFormat('d M Y'),
                            ])->columns(2),
                        ])

                ]),
                Grid::make([
                    'sm' => 2,
                    'xl' => 2,
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
                                    ->pluck('kecamatan_usaha')->toArray();
                                $kec_usaha = array_combine($kec_usahas, $kec_usahas);
                                return $kec_usaha;
                            })
                            ->visible(function () {
                                if (auth()->user()->hasRole('kabkota')) {
                                    return true;
                                }
                                return false;
                            }),
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

        if (auth()->user()->hasRole('super_admin')) {
            $this->superadmin = auth()->user('super_admin');
        } else {
            // $this->kecamatan_usaha = $this->form->getState()['kecamatan_usaha'];
        }

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
        // DEAFULT FILTERS TAHUN
        $this->tahun = now()->year;
    }

    public function render(): View
    {
        if (auth()->user()->hasRole('kabkota')) {
            $this->simike = Proyek::filterMikro($this->tanggal_terbit_oss, $this->tahun, $this->triwulan, auth()->user()->kabkota->id, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                ->first();
        } else {
            $this->simike = Proyek::filterMikro($this->tanggal_terbit_oss, $this->tahun, $this->triwulan, $this->kabkota, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                ->first();
        }

        if (auth()->user()->hasRole('kabkota')) {
            $this->nib = Proyek::filterMikro($this->tanggal_terbit_oss, $this->tahun, $this->triwulan, auth()->user()->kabkota->id, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                ->groupBy('nib')
                ->where('dikecualikan', false)
                ->where('is_mapping', true)
                ->get()
                ->count();
        } else {
            $this->nib = Proyek::filterMikro($this->tanggal_terbit_oss, $this->tahun, $this->triwulan, $this->kabkota, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                ->where('dikecualikan', false)
                ->where('is_mapping', true)
                ->groupBy(['nib', 'kab_kota_id'])
                ->get()
                ->count();
        }

        if (auth()->user()->hasRole('kabkota')) {
            $this->nib_anomaly = Proyek::filterMikro($this->tanggal_terbit_oss, $this->tahun, $this->triwulan, auth()->user()->kabkota->id, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                ->groupBy('nib')
                ->where('dikecualikan', true)
                ->where('is_mapping', false)
                ->get()
                ->count();
        } else {
            $this->nib = Proyek::filterMikro($this->tanggal_terbit_oss, $this->tahun, $this->triwulan, $this->kabkota, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                ->where('dikecualikan', false)
                ->where('is_mapping', true)
                ->groupBy(['nib', 'kab_kota_id'])
                ->get()
                ->count();
        }

        $tanggal = $this->tanggal_terbit_oss;
        $tahun = $this->tahun;
        $triwulan = $this->triwulan;
        $simike = $this->simike;
        $nib = $this->nib;

        return view('filament.widgets.simike.dashboard-simike', compact('tanggal', 'tahun', 'triwulan', 'simike', 'nib'));
    }
}
