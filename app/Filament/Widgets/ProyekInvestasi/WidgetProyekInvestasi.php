<?php

namespace App\Filament\Widgets\ProyekInvestasi;

use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\Widget;

class WidgetProyekInvestasi extends Widget
{
    use HasWidgetShield;
    protected static ?int $sort = 2;
    protected static ?string $pollingInterval = null;
    protected static bool $isLazy = false;
    protected int|string|array $columnSpan = 'full';
    protected static string $view = 'filament.widgets.proyek-investasi.widget-proyek-investasi';
}
