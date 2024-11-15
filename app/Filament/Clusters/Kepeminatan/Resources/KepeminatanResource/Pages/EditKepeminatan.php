<?php

namespace App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource\Pages;

use App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKepeminatan extends EditRecord
{
    protected static string $resource = KepeminatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
