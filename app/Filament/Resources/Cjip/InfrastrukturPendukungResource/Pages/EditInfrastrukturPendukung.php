<?php

namespace App\Filament\Resources\Cjip\InfrastrukturPendukungResource\Pages;

use App\Filament\Resources\Cjip\InfrastrukturPendukungResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;

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

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }
}
