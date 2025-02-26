<?php

namespace App\Filament\Clusters\Kemitraan\Resources\UserPerusahaanResource\Pages;

use App\Filament\Clusters\Kemitraan\Resources\UserPerusahaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserPerusahaans extends ListRecords
{
    protected static string $resource = UserPerusahaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // ...
        ];
    }
}
