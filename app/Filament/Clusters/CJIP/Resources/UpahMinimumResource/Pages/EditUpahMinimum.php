<?php

namespace App\Filament\Clusters\Cjip\Resources\UpahMinimumResource\Pages;

use App\Filament\Clusters\Cjip\Resources\UpahMinimumResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUpahMinimum extends EditRecord
{
    protected static string $resource = UpahMinimumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
