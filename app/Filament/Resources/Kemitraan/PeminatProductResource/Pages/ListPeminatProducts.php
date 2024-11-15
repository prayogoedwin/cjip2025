<?php

namespace App\Filament\Resources\Kemitraan\PeminatProductResource\Pages;

use App\Filament\Resources\Kemitraan\PeminatProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPeminatProducts extends ListRecords
{
    protected static string $resource = PeminatProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
