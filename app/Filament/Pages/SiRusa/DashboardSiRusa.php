<?php

namespace App\Filament\Pages\SiRusa;

use App\Filament\Widgets\SiRusa\DashboardSirusa as SiRusaDashboardSirusa;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;

class DashboardSiRusa extends Page
{
    use HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'Si-Rusa';
    protected static ?string $title = 'Dashboard Si-Rusa';
    protected static string $view = 'filament.pages.si-rusa.dashboard-si-rusa';

    protected function getHeaderWidgets(): array
    {
        return [
            SiRusaDashboardSirusa::class,
        ];
    }
}
