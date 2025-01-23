<?php

namespace App\Filament\Clusters\Cjip\Resources\ProyekInvestasiResource\Pages;

use App\Filament\Clusters\Cjip\Resources\ProyekInvestasiResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;

class ListProyekInvestasis extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = ProyekInvestasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
