<?php

namespace App\Filament\Widgets;

use App\Models\SiMike\Proyek;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;

class TopProyekChart extends ApexChartWidget
{
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

    protected $listeners = ['filterUpdated' => 'updateFilter'];

    public function updateFilter($tanggal_terbit_oss, $tahun, $triwulan, $kabkota, $sektor, $uraian_skala_usaha, $kecamatan_usaha)
    {
        $this->tanggal_terbit_oss = $tanggal_terbit_oss['tanggal'];
        $this->tahun = $tahun['tahun'];
        $this->triwulan = $triwulan['triwulan'];
        $this->kabkota = $kabkota['kabkota'];
        $this->sektor = $sektor['sektor'];
        $this->uraian_skala_usaha = $uraian_skala_usaha['uraian_skala_usaha'];
        $this->kecamatan_usaha = $kecamatan_usaha['kecamatan_usaha'];
    }

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Top 10 Jumlah Nilai Investasi';

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
            DB::raw('sum(CASE WHEN dikecualikan = "0" AND is_mapping = "1" THEN jumlah_investasi ELSE 0 END) as `total`')
        )
            ->join('kabkotas', 'kabkotas.id', '=', 'proyeks.kab_kota_id')
            ->groupBy('kab_kota_id', 'kabkotas.nama')
            ->orderByDesc(DB::raw('SUM(jumlah_investasi)'))
            ->limit(10)
            ->when($tahun, function ($query, $tahun) {
                return $query->where('tahun', $tahun);
            })
            // Filter berdasarkan kabkota jika ada
            ->when($kabkota, function ($query, $kabkota) {
                return $query->where('kab_kota_id', $kabkota);
            })
            // Filter berdasarkan sektor jika ada
            ->when($sektor, function ($query, $sektor) {
                return $query->where('sektor_id', $sektor);
            })
            // Filter berdasarkan tanggal jika ada
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('tanggal_terbit_oss', [$startDate, $endDate]);
            })
            ->get();
        $kabupatenKota = $proyekData->pluck('nama')->toArray();
        $totalInvestasi = $proyekData->pluck('total')->toArray();
        // Format data for currency
        $totalInvestasiFormatted = array_map(function ($item) {
            return 'Rp ' . number_format($item, 0, ',', '.');
        }, $totalInvestasi);
        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Total Investasi',
                    'data' => $totalInvestasi,
                ],
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
            'colors' => ['#f59e0b'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => true,
                ],
            ],
        ];
    }
}
