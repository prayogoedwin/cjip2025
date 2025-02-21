<?php

namespace App\Filament\Resources\Pengguna\UserResource\Pages;

use App\Filament\Resources\Pengguna\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use STS\FilamentImpersonate\Pages\Actions\Impersonate;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Impersonate::make(),
        ];
    }
}
