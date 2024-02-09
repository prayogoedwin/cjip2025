<?php

namespace App\Filament\Widgets;

use App\Models\Cjip\Kabkota;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Illuminate\Support\Facades\URL;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class LoiByKabKota extends ApexChartWidget
{
    use HasWidgetShield;
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'loiByKabKota';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Top 5 Kab/Kota';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */

    public static function canView(): bool
    {
        /*return auth()->user()->hasRole('kabkota');*/
        if (URL::current() == \url('/admin')) {
            return false;
        }
        return true;
    }
    protected function getOptions(): array
    {
        $lois = Kabkota::withCount('lois')
            ->orderByDesc('lois_count')
            ->groupBy('nama')
            ->take(5)
            ->pluck('lois_count', 'nama')
            ->toArray();

        //dd($lois);


        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'BasicBarChart',
                    'data' => array_values($lois),
                ],
            ],
            'xaxis' => [
                'categories' => array_keys($lois),
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'colors' => ['#6366f1'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => true,
                ],
            ],
        ];
    }
}
