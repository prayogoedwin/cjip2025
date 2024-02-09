<?php

namespace App\Filament\Resources\Cjip\LoiResource\Widgets;

use App\Models\Cjip\Event;
use App\Models\Cjip\Loi;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LoiSumNilai extends BaseWidget
{
    use HasWidgetShield;

    public static function canView(): bool
    {
        if (auth()->user()->hasRole('koordinator lo') or auth()->user()->hasRole('super_admin')) {
            return true;
        }

        return false;
    }

    protected static ?string $pollingInterval = '3s';

    protected static ?int $sort = 0;

    protected function getCards(): array
    {
        $kurs = Event::first()->kurs_dollar;
        $usd = Loi::where('event_id', 1)->sum('nilai_usd');
        $countUsd = Loi::where('event_id', 1)->whereNotNull('nilai_usd')->count();
        $rp = Loi::where('event_id', 1)->sum('nilai_rp');
        $countRp = Loi::where('event_id', 1)->whereNotNull('nilai_rp')->count();

        //dd($usd);

        return [
            Stat::make('Total Rencana Nilai Investasi LOI (dalam Rupiah dengan kurs dollar senilai Rp. ' . number_format($kurs) . ')', 'Rp. ' . number_format($rp + ($usd * $kurs)))
                ->description(number_format($countRp + $countUsd) . ' Loi')
                ->color('success'),
        ];
    }
}
