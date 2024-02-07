<?php

namespace App\Filament\Widgets;

use App\Models\Cjip\Event;
use App\Models\Cjip\Loi;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Illuminate\Support\Facades\URL;

class LoiBySektor extends ApexChartWidget
{
    use HasWidgetShield;
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'LoiBySektor';

    /**
     * Widget Title
     *
     * @var string|null
     */

    public static function canView(): bool
    {
        /*return auth()->user()->hasRole('kabkota');*/
        if (URL::current() == \url('/admin')) {
            return false;
        }
        return true;
    }
    protected static ?string $heading = 'Loi by Sektor';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {

        $kurs = Event::first()->kurs_dollar;

        $data = Loi::where('event_id', 1)
            ->selectRaw("sektor, COUNT(*) as count")
            ->groupBy('sektor')
            ->pluck('count', 'sektor')
            ->toArray();

        return [
            'chart' => [
                'type' => 'pie',
                'height' => 300,
            ],
            'series' => array_values($data),
            'labels' => array_keys($data),
            'legend' => [
                'labels' => [
                    'colors' => '#9ca3af',
                    'fontWeight' => 600,
                ],
            ],
        ];
    }
}
