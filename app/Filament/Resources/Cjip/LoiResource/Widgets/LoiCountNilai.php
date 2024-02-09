<?php

namespace App\Filament\Resources\Cjip\LoiResource\Widgets;

use App\Models\Cjip\Loi;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;

class LoiCountNilai extends BaseWidget
{
    use HasWidgetShield;

    protected static ?string $pollingInterval = '3s';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 1;

    public static function canView(): bool
    {
        if (auth()->user()->hasRole('koordinator lo') or auth()->user()->hasRole('super_admin')) {
            return true;
        }

        return false;
    }


    protected function getCards(): array
    {
        $usd = Loi::sum('nilai_usd');
        $countUsd = Loi::whereNotNull('nilai_usd')->count();
        $rp = Loi::sum('nilai_rp');
        $countRp = Loi::whereNotNull('nilai_rp')->count();

        //dd($usd);

        return [
            Stat::make('Nilai LOI (Rupiah)', 'Rp. ' . number_format($rp))
                ->description(number_format($countRp) . ' Loi')
                ->color('success'),
            Stat::make('Nilai LOI (USD)', 'USD ' . number_format($usd))
                ->description(number_format($countUsd) . ' Loi')
                ->color('primary'),
        ];
    }
}
