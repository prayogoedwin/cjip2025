<?php

namespace App\Filament\Clusters\CJIP\Resources\ProyekInvestasiResource\Pages;

use App\Filament\Clusters\CJIP\Resources\ProyekInvestasiResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;

class EditProyekInvestasi extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = ProyekInvestasiResource::class;

    public static function getTranslatableLocales(): array
    {
        return ['en', 'id'];
    }

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
