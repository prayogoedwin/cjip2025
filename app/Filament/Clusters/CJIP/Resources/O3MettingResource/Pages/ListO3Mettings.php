<?php

namespace App\Filament\Clusters\CJIP\Resources\O3MettingResource\Pages;

use App\Filament\Clusters\CJIP\Resources\O3MettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListO3Mettings extends ListRecords
{
    protected static string $resource = O3MettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
