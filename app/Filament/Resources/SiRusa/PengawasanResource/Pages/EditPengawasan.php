<?php

namespace App\Filament\Resources\SiRusa\PengawasanResource\Pages;

use App\Filament\Resources\SiRusa\PengawasanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengawasan extends EditRecord
{
    protected static string $resource = PengawasanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
