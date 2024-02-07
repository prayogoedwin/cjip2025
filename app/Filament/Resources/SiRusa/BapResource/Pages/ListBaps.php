<?php

namespace App\Filament\Resources\SiRusa\BapResource\Pages;

use App\Filament\Resources\SiRusa\BapResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBaps extends ListRecords
{
    protected static string $resource = BapResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
