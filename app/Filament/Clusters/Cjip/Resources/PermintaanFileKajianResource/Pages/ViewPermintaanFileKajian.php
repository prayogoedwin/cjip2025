<?php

namespace App\Filament\Clusters\Cjip\Resources\PermintaanFileKajianResource\Pages;

use App\Filament\Clusters\Cjip\Resources\PermintaanFileKajianResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPermintaanFileKajian extends ViewRecord
{
    protected static string $resource = PermintaanFileKajianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
