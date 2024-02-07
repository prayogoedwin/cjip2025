<?php

namespace App\Filament\Resources\SiMike\RulesSimikeResource\Pages;

use App\Filament\Resources\SiMike\RulesSimikeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRulesSimike extends EditRecord
{
    protected static string $resource = RulesSimikeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
