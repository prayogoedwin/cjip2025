<?php

namespace App\Filament\Resources\Sidikaryo\SidikaryoPerusahaanResource\Pages;

use App\Filament\Resources\Sidikaryo\SidikaryoPerusahaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSidikaryoPerusahaans extends ListRecords
{
    protected static string $resource = SidikaryoPerusahaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
