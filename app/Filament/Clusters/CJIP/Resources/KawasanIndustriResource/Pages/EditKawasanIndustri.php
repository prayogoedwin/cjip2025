<?php

namespace App\Filament\Clusters\Cjip\Resources\KawasanIndustriResource\Pages;

use App\Filament\Clusters\Cjip\Resources\KawasanIndustriResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;

class EditKawasanIndustri extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = KawasanIndustriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
