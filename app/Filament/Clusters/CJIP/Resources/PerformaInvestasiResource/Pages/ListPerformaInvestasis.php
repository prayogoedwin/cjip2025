<?php

namespace App\Filament\Clusters\CJIP\Resources\PerformaInvestasiResource\Pages;

use App\Filament\Clusters\CJIP\Resources\PerformaInvestasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPerformaInvestasis extends ListRecords
{
    protected static string $resource = PerformaInvestasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
