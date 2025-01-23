<?php

namespace App\Filament\Clusters\Cjip\Resources\BiayaListrikResource\Pages;

use App\Filament\Clusters\Cjip\Resources\BiayaListrikResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBiayaListriks extends ListRecords
{
    protected static string $resource = BiayaListrikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
