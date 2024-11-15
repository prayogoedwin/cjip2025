<?php

namespace App\Filament\Clusters\CJIP\Resources\BeritaResource\Pages;

use App\Filament\Clusters\CJIP\Resources\BeritaResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ViewRecord;
use Locale;

class ViewBerita extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;
    protected static string $resource = BeritaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\EditAction::make(),
        ];
    }
}
