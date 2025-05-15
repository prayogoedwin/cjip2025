<?php

namespace App\Filament\Clusters\Cjip\Resources\ProyekInvestasiResource\Pages;

use App\Filament\Clusters\Cjip\Resources\ProyekInvestasiResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;

class CreateProyekInvestasi extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = ProyekInvestasiResource::class;
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
