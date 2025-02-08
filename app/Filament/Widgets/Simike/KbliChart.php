<?php

namespace App\Filament\Widgets\SiMike;

use App\Models\SiMike\Proyek;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\URL;

class KbliChart extends ChartWidget
{
    use HasWidgetShield;
    protected static ?string $heading = 'Top 5 Nilai Realisasi Investasi berdasarkan KBLI (dalam Rp. Juta)';
    public $years;
    public $kblis_data;
    public $label_kbli;

    protected static ?string $pollingInterval = null;
    //FILTERS
    protected $tahun,
    $triwulan,
    $kabkota,
    $sektor,
    $kbli,
    $uraian_skala_usaha,
    $kecamatan_usaha;


    protected static ?int $sort = 6;

    protected static bool $isLazy = false;


    protected $listeners = ['filterUpdated' => 'updateFilter'];

    public function updateFilter($tahun, $triwulan, $kabkota, $sektor, $uraian_skala_usaha, $kecamatan_usaha)
    {
        //dd([$tahun, $triwulan, $kabkota, $sektor, $uraian_skala_usaha]);

        $this->tahun = $tahun['tahun'];
        $this->triwulan = $triwulan['triwulan'];
        $this->kabkota = $kabkota['kabkota'];
        $this->sektor = $sektor['sektor'];
        $this->uraian_skala_usaha = $uraian_skala_usaha['uraian_skala_usaha'];
        $this->kecamatan_usaha = $kecamatan_usaha['kecamatan_usaha'];
        // dd(range(Carbon::now()->year, Carbon::now()->subYear(5)->year));

        $this->updateChartData();
    }
    public static function canView(): bool
    {
        /*return auth()->user()->hasRole('kabkota');*/
        if (URL::current() == \url('/admin')) {
            return false;
        }
        return true;
    }
    // public function mount()
    // {
    //     $this->tahun = now()->year;
    //     $this->uraian_skala_usaha = 'Usaha Mikro';
    //     parent::mount();
    // }

    protected function getData(): array
    {
        //dd(auth()->user()->hasRole('super_admin'));
        if (auth()->user()->hasRole('kabkota')) {
            $this->kblis_data = Proyek::filterMikro($this->tahun, $this->triwulan, auth()->user()->kabkota->id, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                ->groupBy('kbli')
                ->selectRaw('sum(jumlah_investasi)/1000000 as sum, kbli')
                ->orderBy('sum', 'desc')
                ->take(5)
                ->pluck('sum', 'kbli');
        } else {
            $this->kblis_data = Proyek::filterMikro($this->tahun, $this->triwulan, $this->kabkota, $this->sektor, $this->uraian_skala_usaha, $this->kecamatan_usaha)
                ->groupBy('kbli')
                ->selectRaw('sum(jumlah_investasi)/1000000 as sum, kbli')
                ->orderBy('sum', 'desc')
                ->take(5)
                ->pluck('sum', 'kbli');
        }
        return [
            'datasets' => [
                [
                    'label' => $this->filter,
                    'data' => array_values($this->kblis_data->toArray()),
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
                        'rgba(255, 205, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                    ],
                    'borderColor' => '#fff',
                    'hoverOffset' => 4
                ],

            ],
            'labels' => array_keys($this->kblis_data->toArray()),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
