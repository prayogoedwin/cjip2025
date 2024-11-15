<?php

namespace App\Filament\Clusters\CJIP\Resources\BiayaAirResource\Pages;

use App\Filament\Clusters\CJIP\Resources\BiayaAirResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBiayaAir extends EditRecord
{
    protected static string $resource = BiayaAirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
