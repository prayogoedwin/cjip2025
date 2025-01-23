<?php

namespace App\Filament\Clusters\Cjip\Resources\ProfileKabkotaResource\Pages;

use App\Filament\Clusters\Cjip\Resources\ProfileKabkotaResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;

class EditProfileKabkota extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = ProfileKabkotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
