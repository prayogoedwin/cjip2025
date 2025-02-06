<?php

namespace App\Filament\Clusters\Kemitraan\Resources\PeminatProductResource\Pages;

use App\Filament\Clusters\Kemitraan\Resources\PeminatProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPeminatProducts extends ListRecords
{
    protected static string $resource = PeminatProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
