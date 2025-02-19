<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\Simike\DashboardSimike;
use App\Filament\Widgets\TopProyekChart;
use App\Filament\Widgets\TopTableProyek;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;

class Dashboard extends Page
{

    // use HasPageShield;    
    protected static ?string $navigationIcon = 'heroicon-s-home';
    protected static ?int $navigationSort = -10;
    protected int | string | array $columnSpan = 'full';


    protected function getHeaderWidgets(): array
    {
        return [
            AccountWidget::class,
            FilamentInfoWidget::class,
            DashboardSimike::class,
            // TopProyekChart::class,
            TopTableProyek::class
        ];
    }
    protected static string $view = 'filament.pages.dashboard';
}
