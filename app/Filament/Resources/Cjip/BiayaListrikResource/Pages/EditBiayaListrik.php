<?php

namespace App\Filament\Resources\Cjip\BiayaListrikResource\Pages;

use App\Filament\Resources\Cjip\BiayaListrikResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBiayaListrik extends EditRecord
{
    protected static string $resource = BiayaListrikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
