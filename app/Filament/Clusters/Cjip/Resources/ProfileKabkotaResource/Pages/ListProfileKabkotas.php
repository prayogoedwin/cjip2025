<?php

namespace App\Filament\Clusters\Cjip\Resources\ProfileKabkotaResource\Pages;

use App\Filament\Clusters\Cjip\Resources\ProfileKabkotaResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;

class ListProfileKabkotas extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = ProfileKabkotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
