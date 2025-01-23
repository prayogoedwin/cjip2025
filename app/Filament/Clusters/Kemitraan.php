<?php

namespace App\Filament\Clusters;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Clusters\Cluster;
use Filament\Resources\Concerns\Translatable;

class Kemitraan extends Cluster
{
    use Translatable, HasPageShield;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Website';

}
