<?php

namespace App\Filament\Resources\Cjip\BiayaAirResource\Pages;

use App\Filament\Resources\Cjip\BiayaAirResource;
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
