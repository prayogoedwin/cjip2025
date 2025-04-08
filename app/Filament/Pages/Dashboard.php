<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ProyekInvestasi\StatsProyekInvestasi;
use App\Filament\Widgets\ProyekInvestasi\WidgetProyekInvestasi;
use App\Filament\Widgets\SiMike\DashboardSimike;
use App\Filament\Widgets\TopProyekChart;
use App\Filament\Widgets\TopTableProyek;
use App\Filament\Widgets\WidgetFeatures;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;

class Dashboard extends Page
{

    // use HasPageShield;    
    protected static ?string $navigationIcon = 'heroicon-s-home';

    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = '';
    protected static ?int $navigationSort = -10;
    protected int | string | array $columnSpan = 'full';
    

    protected function getHeaderWidgets(): array
    {
        return [
            AccountWidget::class,
            FilamentInfoWidget::class,
            WidgetFeatures::class,
            WidgetProyekInvestasi::class,
            DashboardSimike::class,
            // TopProyekChart::class,
            TopTableProyek::class
        ];
    }
    protected static string $view = 'filament.pages.dashboard';
}
