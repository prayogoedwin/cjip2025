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

    protected $listeners = ['filterUpdated' => 'updateFilter'];
    protected static ?string $loadingIndicator = 'Loading...';
    protected static bool $deferLoading = true;

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

    protected static ?string $chartId = 'TopSkalaUsaha';
    protected static ?string $heading = 'Jumlah Proyek Per Skala Usaha';

    protected function getOptions(): array
    {
        $tahun = $this->filterFormData['tahun'] ?? $this->tahun;
        $tanggalTerbitOSS = $this->filterFormData['tanggal_terbit_oss'] ?? $this->tanggal_terbit_oss;
        $kabkota = $this->filterFormData['kabkota'] ?? null;
        $sektor = $this->filterFormData['sektor'] ?? null;
        $uraianSkalaUsaha = $this->filterFormData['uraian_skala_usaha'] ?? null;

        if (is_array($tanggalTerbitOSS) && isset($tanggalTerbitOSS['start'], $tanggalTerbitOSS['end'])) {
            $startDate = Carbon::parse($tanggalTerbitOSS['start'])->format('Y-m-d');
            $endDate = Carbon::parse($tanggalTerbitOSS['end'])->format('Y-m-d');
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
            ->select('uraian_skala_usaha')
            ->selectRaw('COUNT(CASE WHEN dikecualikan = "1" OR is_mapping = "0" THEN nib_count ELSE 0 END) as `project_count`')
            ->groupBy('uraian_skala_usaha')
            ->orderByDesc(DB::raw('COUNT(*)'))
            ->whereIn('uraian_skala_usaha', ['Usaha Kecil', 'Usaha Mikro'])
            ->get();

        // Extract data for chart
        $uraianSkalaUsaha = $proyekData->pluck('uraian_skala_usaha')->toArray();
        $projectCount = $proyekData->pluck('project_count')->toArray();

        return [
            'chart' => [
                'type' => 'donut',
                'height' => 300,
            ],
            'series' => $projectCount,
            'labels' => $uraianSkalaUsaha,
            'colors' => ['#16a34a', '#f59e0b'],
        ];
    }
}
