<?php

namespace App\Filament\Clusters\Cjip\Resources\InfrastrukturPendukungResource\Pages;

use App\Filament\Clusters\Cjip\Resources\InfrastrukturPendukungResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;

class ListInfrastrukturPendukungs extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = InfrastrukturPendukungResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
