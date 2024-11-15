<?php

namespace App\Filament\Clusters\CJIP\Resources\PendidikanResource\Pages;

use App\Filament\Clusters\CJIP\Resources\PendidikanResource;
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
