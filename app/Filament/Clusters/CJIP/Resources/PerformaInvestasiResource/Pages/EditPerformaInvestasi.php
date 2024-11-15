<?php

namespace App\Filament\Clusters\CJIP\Resources\PerformaInvestasiResource\Pages;

use App\Filament\Clusters\CJIP\Resources\PerformaInvestasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPerformaInvestasi extends EditRecord
{
    protected static string $resource = PerformaInvestasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
