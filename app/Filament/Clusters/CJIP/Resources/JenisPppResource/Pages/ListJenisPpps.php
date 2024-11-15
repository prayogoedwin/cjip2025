<?php

namespace App\Filament\Clusters\CJIP\Resources\JenisPppResource\Pages;

use App\Filament\Clusters\CJIP\Resources\JenisPppResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisPpps extends ListRecords
{
    protected static string $resource = JenisPppResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
