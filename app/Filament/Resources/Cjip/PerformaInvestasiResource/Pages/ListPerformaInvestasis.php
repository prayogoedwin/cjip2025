<?php

namespace App\Filament\Resources\Cjip\PerformaInvestasiResource\Pages;

use App\Filament\Resources\Cjip\PerformaInvestasiResource;
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
