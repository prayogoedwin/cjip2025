<?php

namespace App\Filament\Clusters;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Clusters\Cluster;
use Filament\Resources\Concerns\Translatable;

class Cjip extends Cluster
{
    use Translatable, HasPageShield;
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Website';
}
