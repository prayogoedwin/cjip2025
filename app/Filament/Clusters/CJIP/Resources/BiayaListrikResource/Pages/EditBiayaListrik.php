<?php

namespace App\Filament\Clusters\Cjip\Resources\BiayaListrikResource\Pages;

use App\Filament\Clusters\Cjip\Resources\BiayaListrikResource;
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
