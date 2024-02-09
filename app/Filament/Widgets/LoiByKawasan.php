<?php

namespace App\Filament\Widgets;

use App\Models\Cjip\KawasanIndustri;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Illuminate\Support\Facades\URL;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class LoiByKawasan extends ApexChartWidget
{
    use HasWidgetShield;
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'loiByKawasan';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Top 5 Kawasan Industri';

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
        $lois = KawasanIndustri::withCount('lois')
            ->orderByDesc('lois_count')
            ->take(5)
            ->groupBy('nama')
            ->pluck('lois_count', 'nama')
            ->map(function ($count, $names) {
                $namesArray = json_decode($names, true); // Convert the JSON string to an array
                $locale = app()->getLocale(); // Get the current locale
    
                // Choose the name based on the current locale
                $name = isset($namesArray[$locale]) ? $namesArray[$locale] : reset($namesArray);

                return [$name => $count];
            })
            ->toArray();

        $lois = array_reduce($lois, function ($carry, $item) {
            return $carry + $item;
        }, []);
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
