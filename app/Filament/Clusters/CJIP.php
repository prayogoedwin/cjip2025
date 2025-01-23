<?php

namespace App\Filament\Clusters;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Clusters\Cluster;
use Filament\Resources\Concerns\Translatable;

class Cjip extends Cluster
{
    use HasPageShield;
    use Translatable;

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Website';
}
