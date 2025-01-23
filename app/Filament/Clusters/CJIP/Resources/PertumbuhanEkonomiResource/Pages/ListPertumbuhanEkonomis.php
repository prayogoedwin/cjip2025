<?php

namespace App\Filament\Clusters\Cjip\Resources\PertumbuhanEkonomiResource\Pages;

use App\Filament\Clusters\Cjip\Resources\PertumbuhanEkonomiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPertumbuhanEkonomis extends ListRecords
{
    protected static string $resource = PertumbuhanEkonomiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
