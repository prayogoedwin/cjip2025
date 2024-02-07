<?php

namespace App\Filament\Resources\Cjip\InfrastrukturPendukungResource\Pages;

use App\Filament\Resources\Cjip\InfrastrukturPendukungResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInfrastrukturPendukung extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = InfrastrukturPendukungResource::class;
    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
