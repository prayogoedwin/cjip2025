<?php

namespace App\Filament\Resources\Sidikaryo\DapodikResource\Pages;

use App\Filament\Resources\Sidikaryo\DapodikResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDapodik extends EditRecord
{
    protected static string $resource = DapodikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
