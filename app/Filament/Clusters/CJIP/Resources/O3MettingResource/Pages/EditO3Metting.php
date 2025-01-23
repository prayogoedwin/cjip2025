<?php

namespace App\Filament\Clusters\Cjip\Resources\O3MettingResource\Pages;

use App\Filament\Clusters\Cjip\Resources\O3MettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditO3Metting extends EditRecord
{
    protected static string $resource = O3MettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
