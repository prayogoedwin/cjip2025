<?php

namespace App\Filament\Clusters\Cjip\Resources\ProfileKabkotaResource\Pages;

use App\Filament\Clusters\Cjip\Resources\ProfileKabkotaResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;

class CreateProfileKabkota extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = ProfileKabkotaResource::class;

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }
    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
