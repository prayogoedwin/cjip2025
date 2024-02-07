<?php

namespace App\Filament\Resources\SiRusa\RilisResource\Pages;

use App\Filament\Resources\SiRusa\RilisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRilis extends EditRecord
{
    protected static string $resource = RilisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
