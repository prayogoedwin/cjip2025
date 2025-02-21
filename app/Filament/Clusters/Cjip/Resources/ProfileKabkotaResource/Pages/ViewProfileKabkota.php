<?php

namespace App\Filament\Clusters\Cjip\Resources\ProfileKabkotaResource\Pages;

use App\Filament\Clusters\Cjip\Resources\ProfileKabkotaResource;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ViewRecord;

class ViewProfileKabkota extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;
    protected static string $resource = ProfileKabkotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            EditAction::make(),
        ];
    }
}
