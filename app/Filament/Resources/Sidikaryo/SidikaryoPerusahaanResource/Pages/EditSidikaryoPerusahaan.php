<?php

namespace App\Filament\Resources\Sidikaryo\SidikaryoPerusahaanResource\Pages;

use App\Filament\Resources\Sidikaryo\SidikaryoPerusahaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSidikaryoPerusahaan extends EditRecord
{
    protected static string $resource = SidikaryoPerusahaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
