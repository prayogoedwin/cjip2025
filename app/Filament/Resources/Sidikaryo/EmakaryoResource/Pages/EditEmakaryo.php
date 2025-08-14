<?php

namespace App\Filament\Resources\Sidikaryo\EmakaryoResource\Pages;

use App\Filament\Resources\Sidikaryo\EmakaryoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmakaryo extends EditRecord
{
    protected static string $resource = EmakaryoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
