<?php

namespace App\Filament\Resources\Cjip\UpahMinimumResource\Pages;

use App\Filament\Resources\Cjip\UpahMinimumResource;
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
