<?php

namespace App\Filament\Resources\Sidikaryo\SidikaryoBkkResource\Pages;

use App\Filament\Resources\Sidikaryo\SidikaryoBkkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSidikaryoBkks extends ListRecords
{
    protected static string $resource = SidikaryoBkkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
