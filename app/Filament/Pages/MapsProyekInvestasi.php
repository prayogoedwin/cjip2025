<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\Cjip;
use Filament\Pages\Page;

class MapsProyekInvestasi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationLabel = 'Peta Proyek Investasi';
    protected static ?string $title = 'Peta Proyek Investasi';
    protected static ?string $cluster = Cjip::class;
    protected static string $view = 'filament.pages.maps-proyek-investasi';
}
