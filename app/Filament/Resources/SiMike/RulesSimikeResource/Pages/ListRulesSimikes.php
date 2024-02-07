<?php

namespace App\Filament\Resources\SiMike\RulesSimikeResource\Pages;

use App\Filament\Resources\SiMike\RulesSimikeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRulesSimikes extends ListRecords
{
    protected static string $resource = RulesSimikeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
