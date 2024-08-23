<?php

namespace App\Filament\Resources\Kepeminatan\KepeminatanResource\Pages;

use App\Filament\Resources\Kepeminatan\KepeminatanResource;
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
