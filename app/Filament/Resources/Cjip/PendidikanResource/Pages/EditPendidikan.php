<?php

namespace App\Filament\Resources\Cjip\PendidikanResource\Pages;

use App\Filament\Resources\Cjip\PendidikanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendidikan extends EditRecord
{
    protected static string $resource = PendidikanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
