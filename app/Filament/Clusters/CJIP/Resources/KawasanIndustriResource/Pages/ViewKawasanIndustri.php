<?php

namespace App\Filament\Clusters\CJIP\Resources\KawasanIndustriResource\Pages;

use App\Filament\Clusters\CJIP\Resources\KawasanIndustriResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ViewRecord;
use Locale;

class ViewKawasanIndustri extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;
    protected static string $resource = KawasanIndustriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\EditAction::make(),
        ];
    }
}
