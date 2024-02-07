<?php

namespace App\Filament\Resources\SiMike\ProyekResource\Pages;

use App\Filament\Resources\SiMike\ProyekResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProyek extends EditRecord
{
    protected static string $resource = ProyekResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
