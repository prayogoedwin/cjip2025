<?php

namespace App\Filament\Clusters\Cjip\Resources\PertumbuhanEkonomiResource\Pages;

use App\Filament\Clusters\Cjip\Resources\PertumbuhanEkonomiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPertumbuhanEkonomi extends EditRecord
{
    protected static string $resource = PertumbuhanEkonomiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
