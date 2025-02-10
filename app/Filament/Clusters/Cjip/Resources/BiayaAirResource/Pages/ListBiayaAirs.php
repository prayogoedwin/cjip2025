<?php

namespace App\Filament\Clusters\Cjip\Resources\BiayaAirResource\Pages;

use App\Filament\Clusters\Cjip\Resources\BiayaAirResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBiayaAirs extends ListRecords
{
    protected static string $resource = BiayaAirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
