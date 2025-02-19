<?php

namespace App\Filament\Widgets;

use App\Models\SiMike\Proyek;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;

class TopProyekChart extends ApexChartWidget
{
    use HasWidgetShield;
    // public $filter;
    public $tahun,
        $triwulan,
        $kabkota,
        $sektor,
        $kbli,
        $uraian_skala_usaha,
        $kecamatan_usaha,
        $tanggal_terbit_oss,
        $tanggal;
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'topProyekChart';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $loadingIndicator = 'Loading...';

    protected static bool $deferLoading = true;

    protected $listeners = ['filterUpdated' => 'updateFilter'];

    public function updateFilter($tanggal_terbit_oss, $tahun, $triwulan, $kabkota, $sektor, $uraian_skala_usaha, $kecamatan_usaha)
    {
        $this->tanggal_terbit_oss = $tanggal_terbit_oss['tanggal'];
        $this->tahun = $tahun['tahun'];
        $this->triwulan = $triwulan['triwulan'];
        $this->kabkota = $kabkota['kabkota'];
        // $this->sektor = $sektor['sektor'];
        // $this->uraian_skala_usaha = $uraian_skala_usaha['uraian_skala_usaha'];
        // $this->kecamatan_usaha = $kecamatan_usaha['kecamatan_usaha'];
    }

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Top 5 Chart Nilai Investasi';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */

    protected function getOptions(): array
    {
        $tahun = $this->filterFormData['tahun'] ?? null;
        $tanggalTerbitOSS = $this->filterFormData['tanggal_terbit_oss'] ?? null;
        $kabkota = $this->filterFormData['kabkota'] ?? null;
        $sektor = $this->filterFormData['sektor'] ?? null;

        if (is_array($tanggalTerbitOSS) && isset($tanggalTerbitOSS['start'], $tanggalTerbitOSS['end'])) {
            $startDate = \Carbon\Carbon::parse($tanggalTerbitOSS['start'])->format('Y-m-d');
            $endDate = \Carbon\Carbon::parse($tanggalTerbitOSS['end'])->format('Y-m-d');
        } else {
            $startDate = $endDate = null;
        }

        $proyekData = Proyek::filterMikro(
            $this->tanggal_terbit_oss,
            $this->tahun,
            $this->triwulan,
            $this->kabkota,
            $this->sektor,
            $this->uraian_skala_usaha,
            $this->kecamatan_usaha
        )->select(
            'kab_kota_id',
            'kabkotas.nama',
            DB::raw('sum(CASE WHEN dikecualikan = "0" AND is_mapping = "1" THEN jumlah_investasi ELSE 0 END) as `total`'),
            DB::raw('count(CASE WHEN dikecualikan = "1" OR is_mapping = "0" THEN nib_count ELSE 0 END) as `project_count`')
        )
            ->join('kabkotas', 'kabkotas.id', '=', 'proyeks.kab_kota_id')
            ->groupBy('kab_kota_id', 'kabkotas.nama')
            ->orderByDesc(DB::raw('SUM(jumlah_investasi)'))
            ->limit(5)
            ->when($tahun, function ($query, $tahun) {
                return $query->where('tahun', $tahun);
            })
            ->when($kabkota, function ($query, $kabkota) {
                return $query->where('kab_kota_id', $kabkota);
            })
            ->when($sektor, function ($query, $sektor) {
                return $query->where('sektor_id', $sektor);
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('tanggal_terbit_oss', [$startDate, $endDate]);
            })
            ->get();

        $proyekDataArray = $proyekData->map(function ($item) {
            return [
                'kabupaten' => $item->nama,
                'total' => $item->total,
                'project_count' => $item->project_count,  // Include the project count
            ];
        })->sortByDesc('total')->values();

        $kabupatenKota = $proyekDataArray->pluck('kabupaten')->toArray();
        $totalInvestasi = $proyekDataArray->pluck('total')->toArray();
        $projectCount = $proyekDataArray->pluck('project_count')->toArray();

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Jumlah Nilai Investasi',
                    'data' => $totalInvestasi,
                ],
                // [
                //     'name' => 'Jumlah Proyek',
                //     'data' => $projectCount, // Add project count as a second series
                // ],
            ],
            'xaxis' => [
                'categories' => $kabupatenKota,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#16a34a', '#f59e0b'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'vertical' => true,
                ],
            ],
        ];
    }
}
