<?php

namespace App\Filament\Clusters\Cjip\Resources\PermintaanFileKajianResource\Pages;

use App\Filament\Clusters\Cjip\Resources\PermintaanFileKajianResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePermintaanFileKajian extends CreateRecord
{
    protected static string $resource = PermintaanFileKajianResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
