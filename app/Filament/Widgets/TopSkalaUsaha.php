<?php

namespace App\Filament\Widgets;

use App\Models\SiMike\Proyek;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class TopSkalaUsaha extends ApexChartWidget
{
    use HasWidgetShield;

    public $tahun,
        $triwulan,
        $kabkota,
        $sektor,
        $kbli,
        $uraian_skala_usaha,
        $kecamatan_usaha,
        $tanggal_terbit_oss,
        $tanggal, $start, $end;
    protected static ?string $loadingIndicator = 'Loading...';
    protected static bool $deferLoading = true;
    protected $listeners = ['filterUpdated' => 'updateFilter'];

    public function mount(): void
    {
        $this->tahun = now()->year;
        $this->start = Carbon::now()->startOfYear()->format('d M Y');
        $this->end = Carbon::now()->format('d M Y');
        $this->tanggal_terbit_oss = $this->start . ' - ' . $this->end;
    }

    public function updateFilter($tanggal_terbit_oss, $tahun, $triwulan, $kabkota, $sektor, $uraian_skala_usaha, $kecamatan_usaha)
    {
        $this->tanggal_terbit_oss = $tanggal_terbit_oss['tanggal'];
        $this->tahun = $tahun['tahun'];
        $this->triwulan = $triwulan['triwulan'];
        $this->kabkota = $kabkota['kabkota'];
        $this->uraian_skala_usaha = $uraian_skala_usaha['uraian_skala_usaha'];
    }

    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'TopSkalaUsaha';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Uraian Skala Usaha';

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
        $uraianSkalaUsaha = $this->filterFormData['uraian_skala_usaha'] ?? null;

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
        )
            ->select(
                'uraian_skala_usaha',
                DB::raw('count(CASE WHEN dikecualikan = "1" OR is_mapping = "0" THEN nib_count ELSE 0 END) as `project_count`')
            )
            ->groupBy('uraian_skala_usaha')
            ->orderByDesc(DB::raw('COUNT(*)'))
            ->whereIn('uraian_skala_usaha', ['Usaha Kecil', 'Usaha Mikro'])
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

        $uraianSkalaUsaha = $proyekData->pluck('uraian_skala_usaha')->toArray();
        $projectCount = $proyekData->pluck('project_count')->toArray();

        return [
            'chart' => [
                'type' => 'donut',
                'height' => 300,
            ],
            'series' => $projectCount,
            'labels' => $uraianSkalaUsaha,
            'colors' => ['#16a34a', '#f59e0b', '#9333ea', '#e11d48', '#3b82f6'],
        ];
    }
}
