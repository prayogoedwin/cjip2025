<?php

namespace App\Filament\Clusters\CJIP\Resources\KawasanIndustriResource\Pages;

use App\Filament\Clusters\CJIP\Resources\KawasanIndustriResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;

class ListKawasanIndustris extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = KawasanIndustriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
