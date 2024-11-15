<?php

namespace App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource\Pages;

use App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKepeminatans extends ListRecords
{
    protected static string $resource = KepeminatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
