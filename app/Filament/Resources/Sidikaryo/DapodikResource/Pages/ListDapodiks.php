<?php

namespace App\Filament\Resources\Sidikaryo\DapodikResource\Pages;

use App\Filament\Resources\Sidikaryo\DapodikResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDapodiks extends ListRecords
{
    protected static string $resource = DapodikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
