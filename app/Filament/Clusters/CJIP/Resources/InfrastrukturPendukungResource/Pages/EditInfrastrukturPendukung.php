<?php

namespace App\Filament\Clusters\CJIP\Resources\InfrastrukturPendukungResource\Pages;

use App\Filament\Clusters\CJIP\Resources\InfrastrukturPendukungResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;
use Locale;

class EditInfrastrukturPendukung extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = InfrastrukturPendukungResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
