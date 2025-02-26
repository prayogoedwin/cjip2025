<?php

namespace App\Filament\Clusters\Kemitraan\Resources\UserPerusahaanResource\Pages;

use App\Filament\Clusters\Kemitraan\Resources\UserPerusahaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUserPerusahaan extends ViewRecord
{
    protected static string $resource = UserPerusahaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // ..
        ];
    }
}
