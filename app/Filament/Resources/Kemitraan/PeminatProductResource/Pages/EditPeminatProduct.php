<?php

namespace App\Filament\Resources\Kemitraan\PeminatProductResource\Pages;

use App\Filament\Resources\Kemitraan\PeminatProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPeminatProduct extends EditRecord
{
    protected static string $resource = PeminatProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
