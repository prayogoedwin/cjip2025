<?php

namespace App\Filament\Resources\Sidikaryo\PenempatanResource\Pages;

use App\Filament\Resources\Sidikaryo\PenempatanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenempatan extends EditRecord
{
    protected static string $resource = PenempatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
