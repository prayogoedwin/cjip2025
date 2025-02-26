<?php

namespace App\Filament\Clusters\Kemitraan\Resources\UserPerusahaanResource\Pages;

use App\Filament\Clusters\Kemitraan\Resources\UserPerusahaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserPerusahaan extends EditRecord
{
    protected static string $resource = UserPerusahaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
