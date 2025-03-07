<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\Cjip;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;

class MapsProyekInvestasi extends Page
{

    use HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationLabel = 'Peta Proyek Investasi';
    protected static ?string $title = 'Peta Proyek Investasi';
    protected static ?string $cluster = Cjip::class;
    protected static string $view = 'filament.pages.maps-proyek-investasi';
}
