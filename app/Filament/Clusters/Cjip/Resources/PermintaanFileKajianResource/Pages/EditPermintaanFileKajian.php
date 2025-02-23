<?php

namespace App\Filament\Clusters\Cjip\Resources\PermintaanFileKajianResource\Pages;

use App\Filament\Clusters\Cjip\Resources\PermintaanFileKajianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPermintaanFileKajian extends EditRecord
{
    protected static string $resource = PermintaanFileKajianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
