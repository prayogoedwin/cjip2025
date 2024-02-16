<?php

namespace App\Filament\Widgets\SiMike;

use App\Models\Cjip\Kabkota;
use App\Models\Cjip\Sektor;
use App\Models\SiMike\Proyek;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Widgets\StatsOverviewWidget;
use Illuminate\Contracts\View\View;

use Filament\Widgets\Widget;

class DashboardSimike extends StatsOverviewWidget implements HasForms
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
    public $tahun,
    $triwulan,
    $kabkota,
    $sektor,
    $kbli,
    $uraian_skala_usaha,
    $kecamatan_usaha,

    $superadmin,
    $admin;

    public static function canView(): bool
    {
        if (auth()->user()->hasRole(['admin_cjip', 'admin_promosi', 'admin_ki'])) {
            return false;
        }
        return true;
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make()->schema([
                Grid::make([
                    'sm' => 1,
                    'xl' => 1,
                ])->schema([
                            Select::make('uraian_skala_usaha')
                                ->label('Skala Usaha')
                                ->options([
                                    'Usaha Mikro' => 'Usaha Mikro',
                                    'Usaha Kecil' => 'Usaha Kecil',
                                    'Usaha Menengah' => 'Usaha Menengah',
                                    'Usaha Besar' => 'Usaha Besar',
                                ])
                                ->default($this->uraian_skala_usaha)
                                ->required()
                        ]),
                Grid::make([
                    'sm' => 2,
                    'xl' => 2,
                ])
                    ->schema([
                        Select::make('tahun')->default(Carbon::now()->year)
                            ->searchable()
                            ->options(function () {
                                $years = range(Carbon::now()->year, Carbon::now()->subYear(5)->year);
                                //dd($years);
                                return array_combine(array_values($years), array_values($years));
                            })->default(Carbon::now(0)->year)->required(),

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
                        // Select::make('kecamatan_usaha')
                        //     ->label('Kecamatan Usaha')
                        //     ->searchable()
                        //     ->options(function () {
                        //         $kec_usahas = Proyek::where('kab_kota_id', auth()->user()->kabkota->id)
                        //             ->pluck('kecamatan_usaha')->toArray();
                        //         $kec_usaha = array_combine($kec_usahas, $kec_usahas);
                        //         return $kec_usaha;
                        //     })
                        //     ->visible(function () {
                        //         if (auth()->user()->hasRole('kabkota')) {
                        //             return true;
                        //         }
                        //         return false;
                        //     }),
                        Select::make('sektor')->label('Kategori')
                            ->options(Sektor::groupBy('sektor')->pluck('sektor', 'id'))
                            ->searchable()
                    ])
            ])

        ];
    }

    public function submit()
    {
        //dd(range(Carbon::now()->year, Carbon::now()->subYear(5)->year));
        $this->tahun = $this->form->getState()['tahun'];
        $this->triwulan = $this->form->getState()['triwulan'];
        if (auth()->user()->hasRole('kabkota')) {
            $this->kabkota = auth()->user()->kabkota->id;
        } else {
            $this->kabkota = $this->form->getState()['kabkota'];
        }
        $this->sektor = $this->form->getState()['sektor'];
        $this->uraian_skala_usaha = $this->form->getState()['uraian_skala_usaha'];
        $this->kecamatan_usaha = $this->form->getState()['kecamatan_usaha'];


        if (auth()->user()->hasRole('super_admin')) {
            $this->superadmin = auth()->user('super_admin');
        } else {
            // $this->kecamatan_usaha = $this->form->getState()['kecamatan_usaha'];
        }
        //dd($this->uraian_skala_usaha);
        //\dd([is_null($this->triwulan), empty($this->triwulan)]);
        //\dd($this->triwulan);
        // $this->emit(
        //     'filterUpdated',
        //     ['tahun' => $this->tahun],
        //     ['triwulan' => $this->triwulan],
        //     ['kabkota' => $this->kabkota],
        //     ['kabkota' => $this->superadmin],
        //     ['sektor' => $this->sektor],
        //     ['uraian_skala_usaha' => $this->uraian_skala_usaha],
        //     ['kecamatan_usaha' => $this->kecamatan_usaha]
        // );
    }

    public function mount()
    {
        // dd(auth()->user()->kabkota_id);
        //DEAFULT FILTERS
        $this->tahun = now()->year;
        $this->uraian_skala_usaha = 'Usaha Mikro';
    }

    public function render(): View
    {

        /*$kabs = Kabkota::all();
        $kabsNib = [];
        $this->nib = Proyek::where('tahun', 2022)->where('uraian_skala_usaha', 'Usaha Mikro')->where('is_anomaly', false)->groupBy(['nib', 'kab_kota_id'])->get()->count();
        \dd($this->nib);
        $this->nib = Proyek::filterMikro(2022, $this->triwulan, $this->kabkota, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)->groupBy('nib')->get()->count();
        \dd($this->nib);
        foreach ($kabs as $kab){
            $this->nib = Proyek::filterMikro(2022, $this->triwulan, $kab->id, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)->groupBy('nib')->get()->count();
            $kabsNib[] = [
                $kab->nama,
                $this->nib
            ];
        }
        \dd($kabsNib);*/

        //\dd($this->simike->count());
        //DEFAULT DATA
        //admin kabkota
        //DB::enableQueryLog(); // Enable query log
        //dd(auth()->user());

        //\dd($test);
        //\dd($test['PMDN']->proyeks_non_micro_count->proyeks_non_micro_sum_jumlah_investasi);

        //DB::connection()->enableQueryLog();
        if (auth()->user()->hasRole('kabkota')) {
            $this->simike = Proyek::filterMikro($this->tahun, $this->triwulan, auth()->user()->kabkota->id, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                ->first();
        } else {
            $this->simike = Proyek::filterMikro($this->tahun, $this->triwulan, $this->kabkota, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                ->first();
        }
        //\dd($queries);
        //\dd($this->simike);
        if (auth()->user()->hasRole('kabkota')) {
            $this->nib = Proyek::filterMikro($this->tahun, $this->triwulan, auth()->user()->kabkota->id, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                ->groupBy('nib')
                ->where('is_anomaly', false)
                ->get()
                ->count();
        } else {
            $this->nib = Proyek::filterMikro($this->tahun, $this->triwulan, $this->kabkota, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                ->where('is_anomaly', false)
                ->groupBy(['nib', 'kab_kota_id'])
                ->get()
                ->count();
        }

        if (auth()->user()->hasRole('kabkota')) {
            $this->nib_anomaly = Proyek::filterMikro($this->tahun, $this->triwulan, auth()->user()->kabkota->id, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                ->groupBy('nib')
                ->where('is_anomaly', true)
                ->get()
                ->count();
        } else {
            $this->nib = Proyek::filterMikro($this->tahun, $this->triwulan, $this->kabkota, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                ->where('is_anomaly', false)
                ->groupBy(['nib', 'kab_kota_id'])
                ->get()
                ->count();
        }
        //\dd($this->simike);
        $tahun = $this->tahun;
        $triwulan = $this->triwulan;
        $simike = $this->simike;
        $nib = $this->nib;

        return view('filament.widgets.si-mike.dashboard-simike', compact('tahun', 'triwulan', 'simike', 'nib'));
    }
}
