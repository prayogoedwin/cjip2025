<?php

namespace App\Filament\Resources\Cjip\PertumbuhanEkonomiResource\Pages;

use App\Filament\Resources\Cjip\PertumbuhanEkonomiResource;
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
