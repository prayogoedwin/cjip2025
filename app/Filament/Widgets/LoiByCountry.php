<?php

namespace App\Filament\Widgets;

use App\Models\Cjip\Event;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Illuminate\Support\Facades\URL;
use App\Models\Cjip\Loi;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class LoiByCountry extends ApexChartWidget
{
    use HasWidgetShield;
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'LoiByCountry';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Loi by Country';

    public static function canView(): bool
    {
        /*return auth()->user()->hasRole('kabkota');*/
        if (URL::current() == \url('/admin')) {
            return false;
        }
        return true;
    }
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
            ->selectRaw("asal_negara, COUNT(*) as count")
            ->groupBy('asal_negara')
            ->pluck('count', 'asal_negara')
            ->toArray();
        //dd($lois);


        //dd($data);

        return [
            'chart' => [
                'type' => 'pie',
                'height' => 400,
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
