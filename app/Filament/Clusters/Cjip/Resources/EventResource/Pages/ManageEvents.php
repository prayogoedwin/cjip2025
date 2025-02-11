<?php

namespace App\Filament\Clusters\CJIP\Resources\EventResource\Pages;

use App\Filament\Clusters\CJIP\Resources\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEvents extends ManageRecords
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
