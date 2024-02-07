<?php

namespace App\Filament\Resources\Cjip\ProyekInvestasiResource\Pages;

use App\Filament\Resources\Cjip\ProyekInvestasiResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ViewRecord;

class ViewProyekInvestasi extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;
    protected static string $resource = ProyekInvestasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            // EditAction::make()->icon('heroicon-s-pencil'),
        ];
    }

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }
}
